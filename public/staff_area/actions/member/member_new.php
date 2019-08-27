<?php

require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();


if(is_post_request()) 
{
    //build associative array of - to be inserted tuple
    $subject = [];
    $subject['Member_Name'] = $_POST['member_name'] ?? '';
    $subject['Member_Email'] = $_POST['member_email'] ?? '';
    $subject['Member_Contact'] = $_POST['member_contact'] ?? '';
    //execute insert
    $result = insert_member($subject);
    if($result === true)
    {
        //insert sucessful
        $new_id = mysqli_insert_id($db);
        redirect_to(urlFor('/staff_area/actions/member/member_show.php?id=' . $new_id));
    }
    else
    {
        //insert failed
        $errors = $result;
    }


} 
else 
{
    //build empty associative array to fill content of fields in the page
    $subject = [];
    $subject["Member_Name"] = '';
    $subject["Member_Email"] = '';
    $subject["Member_Contact"] = '';
}

$pageTitle = 'Staff Area - Add Members'; 
include(SHARED_PATH . '/staff_header.php'); 
?>

<div class="container center_div">
    <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 40px">
        <div class="form-area">  
            <h5><?php echo display_errors($errors)?></h5>
            <form action="<?php echo urlFor('/staff_area/actions/member/member_new.php');?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Member Add</h3>
                <div class="form-group">
                    <label for="text">Name:</label>
                    <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Name" value="<?php echo $subject['Member_Name']; ?>" required>                 
                </div>
                <div class="form-group">
                    <label for="text">Email:</label>
                    <input type="text" class="form-control" id="member_email" name="member_email" placeholder="Email" value="<?php echo $subject['Member_Email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="text">Contact Number:</label>
                    <input type="text" class="form-control" id="member_contact" name="member_contact" placeholder="Contact Number" value="<?php echo $subject['Member_Contact']; ?>" required>
                </div>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Create Member"/>
            </form>
        </div>
    </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
