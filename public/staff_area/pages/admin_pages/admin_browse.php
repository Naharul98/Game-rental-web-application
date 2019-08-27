<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//get the selected text for filter criteria according to dropdown
$staffID = $_POST['Staff_ID'] ?? '';
$staffName = $_POST['Staff_Name'] ?? '';

//get associatve array of admins filtered according to criteria
$adminSet = filterAdmin($staffID,$staffName);

$pageTitle = 'Staff Area - Admin';
include(SHARED_PATH . '/staff_header.php');
?>




<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">
                <h2>Staff Browse</h2>
            </div>
        </div>                      
        <form action="<?php echo urlFor('/staff_area/pages/admin_pages/admin_browse.php');?>" method="POST" class="form-inline" >
            <div class="container-fluid">
                <div class="row">
                    <div class="span6" style="float: none; margin: 0 auto;">
                        <span class = "label label-default pr-3 pl-3">ID: </span>
                        <input type="text" class="form-control" name="Staff_ID" id="Staff_ID" placeholder="Enter ID" value= "<?php echo $staffID;?>">
                        <span class = "label label-default pr-3 pl-3">Name: </span>
                        <input type="text" class="form-control" name="Staff_Name" id="Staff_Name" placeholder="Enter Name" value="<?php echo $staffName;?>">

                        <input type="submit" name="search" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Search"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="container-fluid pb-5">
    <table class="table">
        <thead class="thead" style="background-color:#2d3246; color :white;">
            <tr>
                <!-- Table headers -->
                <th>Staff ID</th>
                <th>Name</th>
                <th>Privilege</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php while($subject = mysqli_fetch_assoc($adminSet)) { ?>
            <tr>
                <!-- populate table with the associative array retrieved from the query -->
                <td><?php echo h($subject['Staff_ID']); ?></td>
                <td><?php echo h($subject['Staff_Name']); ?></td>
                <td><?php echo h($subject['Privilege']); ?></td>
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/admin/admin_edit.php?id=' . h(u($subject['Staff_ID']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/admin/admin_delete.php?id=' . h(u($subject['Staff_ID']))); ?>">Delete</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>








<?php mysqli_free_result($adminSet);?>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>
