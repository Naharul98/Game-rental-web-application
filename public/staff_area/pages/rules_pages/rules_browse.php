<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//query and get associative array for all the rules in the database table
$ruleSet = get_all_rules();

//set title
$pageTitle = 'Staff Area - Rules';
include(SHARED_PATH . '/staff_header.php');

?>

<section class="search-banner bg-light text-black py-2" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-2">
            <div class="col-lg-12">
                <h1>Edit Rules</h1>
            </div>
        </div>                      
    </div>
</section>

<div class="container-fluid pb-5">
    <table class="table">
        <thead class="thead" style="background-color:#2d3246; color :white;">
            <tr>
                <!-- Table headers -->
                <th>ID</th>
                <th>Rule</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
             <!-- populate table with the associative array retrieved from the query -->
            <?php while($subject = mysqli_fetch_assoc($ruleSet)) { ?>
            <tr>
                <td><?php echo h($subject['Rule_ID']); ?></td>
                <td><?php echo h($subject['Rule']); ?></td>
                
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/rule/rule_edit.php?id=' . h(u($subject['Rule_ID']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/rule/rule_delete.php?id=' . h(u($subject['Rule_ID']))); ?>">Delete</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>




<?php mysqli_free_result($ruleSet);?>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>
