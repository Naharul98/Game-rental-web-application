<?php

require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//if no id found in get request, redirect them to browse page
if(!isset($_GET['id'])) 
{
    redirect_to(urlFor('/staff_area/pages/member_pages/members_browse.php'));
}
$id = $_GET['id'];

if(is_post_request()) 
{
    //build associative array of - to be updated tuple
    $subject = [];
    $subject['Member_ID'] = $id;
    $subject['Member_Name'] = $_POST['member_name'] ?? '';
    $subject['Member_Email'] = $_POST['member_email'] ?? '';
    $subject['Member_Contact'] = $_POST['member_contact'] ?? '';
    $subject['Banned_Until'] = $_POST['Banned_Until'] ?? '';

    //execute update
    $result = update_member($subject);
    if($result === true)
    {
        //update successful
        redirect_to(urlFor('/staff_area/actions/member/member_show.php?id=' . $id));
    }
    else
    {
        //update unsuccessful
        $errors = $result;
    }


} 
else 
{
    //prepare to display details of the member in the page
    $subject = find_member_by_id($id);
}

$page_title = 'Edit Member';
include(SHARED_PATH . '/staff_header.php');
?>

<!-- Script for the date time picker -->
<script>
    $(document).ready(function(){
        var date_input=$('input[name="Banned_Until"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>

<div class="container center_div">
    <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 40px">
        <div class="form-area">  
            <h5><?php echo display_errors($errors)?></h5>
            <form action="<?php echo urlFor('/staff_area/actions/member/member_edit.php?id=' . h(u($id))); ?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Edit Member</h3>
                <div class="form-group">
                    <label for="text">Name:</label>
                    <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Name" value="<?php echo h($subject['Member_Name']); ?>" required>                 
                </div>

                <div class="form-group">
                    <label for="text">Email:</label>
                    <input type="text" class="form-control" id="member_email" name="member_email" placeholder="Email" value="<?php echo h($subject['Member_Email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="text">Contact:</label>
                    <input type="text" class="form-control" id="member_contact" name="member_contact" placeholder="Contact Number" value="<?php echo h($subject['Member_Contact']); ?>" required>
                </div>
                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Banned Until (Blank If Not Banned)</label>
                    <input class="form-control" id="date" name="Banned_Until" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo $subject['Banned_Until']; ?>" type="text"/>
                </div>

                <a href="<?php echo urlFor('/staff_area/pages/member_pages/members_browse.php'); ?>" class="btn btn-md active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Save Changes"/>

            </form>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
