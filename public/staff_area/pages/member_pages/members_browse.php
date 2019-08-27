<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//get the selected text for filter criteria according to dropdown
$memberID = $_POST['memberID'] ?? '';
$memberName = $_POST['memberName'] ?? '';

//get associatve array of members filtered according to criteria
$memberSet = filterMembers($memberID,$memberName);

$pageTitle = 'Staff Area - Members'; 
include(SHARED_PATH . '/staff_header.php');

?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">

                <h2>Member Search</h2>

            </div>
        </div>                      
        <form action="<?php echo urlFor('/staff_area/pages/member_pages/members_browse.php');?>" method="POST" class="form-inline" >
            <div class="container-fluid">
                <div class="row">
                    <div class="span6" style="float: none; margin: 0 auto;">
                        <span class = "label label-default pr-3 pl-3">Member ID: </span>
                        <input type="text" class="form-control" name="memberID" id="memberID" placeholder="Enter ID" value= "<?php echo $memberID;?>">
                        <span class = "label label-default pr-3 pl-3">Name: </span>
                        <input type="text" class="form-control" name="memberName" id="memberName" placeholder="Enter Name" value="<?php echo $memberName;?>">

                        <input type="submit" name="search" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Search"/>
                    </div>
                </div>
            </div>
        </form>
    </div>

</section>

<?php 
include(SHARED_PATH . '/display_member.php'); 
include(SHARED_PATH . '/staff_footer.php');


?>

