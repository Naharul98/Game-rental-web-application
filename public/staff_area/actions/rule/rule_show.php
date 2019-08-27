<?php 
require_once('../../../../private/initialize.php'); 
//if user not logged in then redirect them to login page
require_login();

//retrieve id of the record to show
$id = $_GET['id'] ?? '0'; // PHP > 7.0

if($id == '0')
{
    //no id found in GET, display error message
    echo 'There was an error adding to the database.';
}

//retrieve associative array of the member info according to id to display in the page
$subject = find_rule_by_id($id);
//set page title
$page_title = 'Success';

include(SHARED_PATH . '/staff_header.php');

?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">
                <h2>Rule Updated In Database As:</h2>
                <br/>
                <h3>Rule ID: <?php echo $subject['Rule_ID'];?></h3>
            </div>
            <div class="col-lg-12">
                <h3>Rule: <?php echo $subject['Rule'];?></h3>
            </div>
        </div>                      

            <div class="container-fluid">
                <div class="row">
                    <div class="span6" style="float: none; margin: 0 auto;">
                
                          <a href="<?php echo urlFor('/staff_area/pages/rules_pages/rules_browse.php'); ?>" class="btn btn-lg active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                    </div>
                </div>
            </div>
    </div>

</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
