<?php require_once('../../../../private/initialize.php'); 
//if user not logged in then redirect them to login page
require_login();

//retrieve id of the record to show
$id = $_GET['id'] ?? '0';

if($id == '0')
{
    //no id found in GET, display error message
    echo 'There was an error adding to the database.';
}

//retrieve associative array of the rental info according to id to display in the page
$subject = find_rental_by_id($id);

$page_title = 'Success';
include(SHARED_PATH . '/staff_header.php');

?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">
                <h2>Rental Updated In Database Table As:</h2>
                <br/>
                <h3>Rental ID: <?php echo $subject['Rental_ID'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Member ID: <?php echo $subject['Member_ID'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Game ID: <?php echo $subject['Game_ID'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Rental Start: <?php echo $subject['Start_Date'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Expected Return Date: <?php echo $subject['Return_Date'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Extended: <?php echo $subject['Extended_Until'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Date Returned: <?php echo $subject['Date_Returned'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Return Condition: <?php echo $subject['Return_Condition'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Total Charge: <?php echo $subject['Fee'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Paid: <?php echo $subject['Paid'];?></h3>
            </div>

        </div>                      

            <div class="container-fluid">
                <div class="row">
                    <div class="span6" style="float: none; margin: 0 auto;">
                
                          <a href="<?php echo urlFor('/staff_area/pages/rental_pages/rental_browse.php'); ?>" class="btn btn-lg active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                    </div>
                </div>
            </div>
    </div>

</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
