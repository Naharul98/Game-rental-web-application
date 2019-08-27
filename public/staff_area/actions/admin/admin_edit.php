<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();
//if no id found in get request, redirect them to browse admin page
if(!isset($_GET['id'])) 
{
    redirect_to(urlFor('/staff_area/pages/admin_pages/admin_browse.php'));
}
$id = $_GET['id'];

if(is_post_request()) 
{
    //build associative array of - to be updated tuple
    $subject = [];
    $subject['Staff_ID'] = $id;
    $subject['Staff_Name'] = $_POST['Staff_Name'] ?? '';
    $subject['Username'] = $_POST['Username'] ?? '';
    $subject['Hashed_Password'] = $_POST['Hashed_Password'] ?? '';
    $subject['Privilege'] = $_POST['Privilege'] ?? '';
    //execute update
    $result = update_admin($subject);
    if($result === true)
    {
        //update sucessful
        redirect_to(urlFor('/staff_area/actions/admin/admin_show.php?id=' . $id));
    }
    else
    {
        //update unsuccessful
        $errors = $result;
    }


}
else 
{
    //prepare to display details of the admin
    $subject = find_admin_by_id($id);
}
$page_title = 'Edit Admin';
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
            <form action="<?php echo urlFor('/staff_area/actions/admin/admin_edit.php?id=' . h(u($id))); ?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Edit Staff</h3>
                <div class="form-group">
                    <label for="text">Name:</label>
                    <input type="text" class="form-control" id="Staff_Name" name="Staff_Name" placeholder="Name" value="<?php echo h($subject['Staff_Name']); ?>" required>                 
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="Username" name="Username" placeholder="Email" value="<?php echo h($subject['Username']); ?>" hidden required>
                </div>
                <div class="form-group">
                    <input type="Password" class="form-control" id="Hashed_Password" name="Hashed_Password" placeholder="Password" value="<?php echo h($subject['Hashed_Password']); ?>" hidden required>
                </div>
                <div class="form-group">
                    <label for="text">Privilege:</label>
                    <!-- Select appropriate option in combobox/dropdown -->
                    <?php echo '
                    <select id="cmbPrivilege" class="form-control pr-3 pl-3" name="Privilege">
                        <option value="Secretary" ' . ($subject["Privilege"] == 'Secretary' ? 'selected' : '') . '>Secretary</option>
                        <option value="Volunteer" ' . ($subject["Privilege"] == 'Volunteer' ? 'selected' : '') . '>Volunteer</option></select>';
                        ?>
                                     
                </div>
                <a href="<?php echo urlFor('/staff_area/pages/admin_pages/admin_browse.php'); ?>" class="btn btn-md active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Save Changes"/>

            </form>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
