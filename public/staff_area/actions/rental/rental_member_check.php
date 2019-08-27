<?php 
require_once('../../../../private/initialize.php'); 
//if user not logged in then redirect them to login page
require_login();
?>
<?php

//member Id from GET
$id = $_GET['id'] ?? '';

//flag indicating if member is eligible for rental
$boolean = false;

//message to return in case member is ineligible for rental
$ret= "";
//if no member ID, set to display a error
if($id == "")
{
    $ret = "There was an error";
    $boolean = true;
}
else
{
    $subject = find_member_by_id($id);
    //Queries for checking if member is eligible for renting
    $noOfCurrentRentals = mysqli_fetch_assoc(getNumberOfCurrentRental($id));
    $noOfCurrentExtensions = mysqli_fetch_assoc(getNumberOfCurrentExtensions($id));
    $noOfFailedReturnsWithinLast12Months = mysqli_fetch_assoc(getNumberOfFailedReturnsWithinLast12Months($id));
    $numberOfDamagedGameWhichHasNotBeenSettled = mysqli_fetch_assoc(getNumberOfDamagedGameWhichHasNotBeenSettled($id));

    //Checks to ensure member is eligible for renting
    if(empty(h($subject['Banned_Until'])) == false)
    {
        $bannedUntilDate = DateTime::createFromFormat('Y-m-d', h($subject['Banned_Until']))->format('Y-m-d');
        $currentDate = date('Y-m-d');
        if($bannedUntilDate > $currentDate)
        {
            $ret = "This Member has Ban Imposed Upon Him";
            $boolean = true;
        }
    }
    if(h($noOfCurrentRentals['numberOfCurrentRentals'])>=2)
    {
        $ret = "This member already has 2 rentals pending return";
        $boolean = true;
    }
    if(h($noOfCurrentExtensions['numberOfCurrentExtensions'])>=2)
    {
        $ret = "This member already has 2 games which he extended which he has not returned yet";
        $boolean = true;
    }
    if(h($noOfFailedReturnsWithinLast12Months['numberOfFailedReturns'])>=3)
    {
        $ret = "This member has failed to return games on time for 3 or more times in the last 12 months";
        $boolean = true;
    }
    if(h($numberOfDamagedGameWhichHasNotBeenSettled['numberOfDamagedGameWhichHasNotBeenSettled'])>=1)
    {
        $ret = "This member has returned a damaged game before and has not paid for the damage";
        $boolean = true;
    }
    if($boolean == false)
    {
        //member is confirmed to be eligible for renting
        redirect_to(urlFor('/staff_area/actions/rental/rental_new.php?id=' . $id));
    }
}

$page_title = 'Failure';
include(SHARED_PATH . '/staff_header.php');


?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">
                <h2>This Member Cannot Rent at the moment:</h2>
                <br/>
                <h3>Reason: <?php echo $ret;?></h3>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="span6" style="float: none; margin: 0 auto;">
                    <a href="<?php echo urlFor('/staff_area/pages/rental_pages/rental_select_member.php'); ?>" class="btn btn-lg active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                </div>
            </div>
        </div>
    </div>

</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>