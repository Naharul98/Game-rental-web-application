<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//get the selected text for filter criteria according to dropdown
$memberID = $_POST['memberID'] ?? '';
$memberName = $_POST['memberName'] ?? '';
//get associatve array of rentals filtered according to criteria
$memberSet = filterMembers($memberID,$memberName);

//set title
$pageTitle = 'Staff Area - Select Member';
include(SHARED_PATH . '/staff_header.php');
?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">

                <h2>Search And Select Member For Rental</h2>

            </div>
        </div>                      
        <form action="<?php echo urlFor('/staff_area/pages/rental_pages/rental_select_member.php');?>" method="POST" class="form-inline" >
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

<div class="container-fluid pb-5">
    <table class="table">
        <thead class="thead" style="background-color:#2d3246; color :white;">
            <tr>
                <!-- Table headers -->
                <th>Member ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Banned Until</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php while($subject = mysqli_fetch_assoc($memberSet)) { ?>
            <tr>
                <td><?php echo h($subject['Member_ID']); ?></td>
                <td><?php echo h($subject['Member_Name']); ?></td>
                <td><?php echo h($subject['Member_Email']); ?></td>
                <td><?php echo h($subject['Member_Contact']); ?></td>
                <!-- populate table with the associative array retrieved from the query -->
                <td><?php
                                                                    if(empty(h($subject['Banned_Until'])))
                                                                    {
                                                                        echo 'Not Banned';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo h($subject['Banned_Until']);
                                                                    }
                    ?>
                </td>
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/rental/rental_member_check.php?id=' . h(u($subject['Member_ID']))); ?>">Select</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>








<?php mysqli_free_result($memberSet);?>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>
