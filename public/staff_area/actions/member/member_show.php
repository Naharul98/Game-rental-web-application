<?php 
require_once('../../../../private/initialize.php'); 
//if user not logged in then redirect them to login page
require_login();

//retrieve id of the record to show
$id = $_GET['id'] ?? '0'; 

if($id == '0')
{
    //no id found in GET, display error message
    echo 'There was an error adding to the database.';
}

//retrieve associative array of the member info according to id to display in the page
$subject = find_member_by_id($id);

$page_title = 'Success';
include(SHARED_PATH . '/staff_header.php');


?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">
                <h2>Member Updated In Database Table As:</h2>
                <br/>
                <h3>Member ID: <?php echo $subject['Member_ID'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Name: <?php echo $subject['Member_Name'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Email: <?php echo $subject['Member_Email'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Contact: <?php echo $subject['Member_Contact'];?></h3>
            </div>
            <div class="col-lg-12">
                <!-- display appropriate text for ban -->
                <h3>Banned Until: <?php if(empty(h($subject['Banned_Until'])))
                    {
                    echo 'Not Banned';
                    }
                    else
                    {
                        echo h($subject['Banned_Until']);
                    }?></h3>
            </div>
        </div>                      

        <div class="container-fluid">
            <div class="row">
                <div class="span6" style="float: none; margin: 0 auto;">

                    <a href="<?php echo urlFor('/staff_area/pages/member_pages/members_browse.php'); ?>" class="btn btn-lg active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                </div>
            </div>
        </div>
    </div>

</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
