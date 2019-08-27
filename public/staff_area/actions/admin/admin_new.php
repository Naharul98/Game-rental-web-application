<?php

require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

if(is_post_request()) 
{
    //build associative array of - to be inserted tuple
    $subject = [];
    $subject['Staff_Name'] = $_POST['Staff_Name'] ?? '';
    $subject['Username'] = $_POST['Username'] ?? '';
    $subject['Hashed_Password'] = $_POST['Hashed_Password'] ?? '';
    $subject['Privilege'] = $_POST['Privilege'] ?? '';
    //execute insert
    $result = insert_admin($subject);
    if($result === true)
    {
        //insert sucessful
        $new_id = mysqli_insert_id($db);
        redirect_to(urlFor('/staff_area/actions/admin/admin_show.php?id=' . $new_id));
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
    $subject["Staff_Name"] = '';
    $subject["Username"] = '';
    $subject["Hashed_Password"] = '';
    $subject["Privilege"] = '';
}

$pageTitle = 'Staff Area - Add Admin'; 
include(SHARED_PATH . '/staff_header.php'); ?>

<div class="container center_div">
    <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 40px">
        <div class="form-area">  
            <h5><?php echo display_errors($errors)?></h5>
            <form action="<?php echo urlFor('/staff_area/actions/admin/admin_new.php');?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Add Admin</h3>
                <div class="form-group">
                     <label for="text">Name:</label>
                    <input type="text" class="form-control" id="Staff_Name" name="Staff_Name" placeholder="Name" value="<?php echo $subject['Staff_Name']; ?>" required>                 
                </div>
                <div class="form-group">
                     <label for="text">Username:</label>
                    <input type="text" class="form-control" id="Username" name="Username" placeholder="Username" value="<?php echo $subject['Username']; ?>" required>
                </div>
                <div class="form-group">
                     <label for="text">Password:</label>
                    <input type="password" class="form-control" id="Hashed_Password" name="Hashed_Password" placeholder="Password" value="<?php echo $subject['Hashed_Password']; ?>" required>
                </div>
                <div class="form-group">
                     <label for="text">Privilege:</label>
                    <select id="cmbPrivilege" class="form-control pr-3 pl-3" name="Privilege">
                        <!-- Select appropriate option in combobox/dropdown -->
                        <?php echo '<option selected value="0" style="display:none">Select Privilege</option>
                        <option value="Secretary" ' . ($subject["Privilege"] == 'Secretary' ? 'selected' : '') . '>Secretary</option>
                        <option value="Volunteer" ' . ($subject["Privilege"] == 'Volunteer' ? 'selected' : '') . '>Volunteer</option>';
                        ?>
                    </select>                 
                </div>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Create Member"/>
            </form>
        </div>
    </div>
</div>




<?php include(SHARED_PATH . '/staff_footer.php'); ?>