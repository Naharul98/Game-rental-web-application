<div class="container-fluid pb-5">
    <table class="table">
        <thead class="thead" style="background-color:#2d3246; color :white;">
            <tr>
                <!-- Table headers -->
                <th>Rental ID</th>
                <th>Game Title</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>Return Date</th>
                <th>Extended Until</th>
                <th>Date Returned</th>
                <th>Outstanding Fee</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php while($subject = mysqli_fetch_assoc($rentalSet)) { ?>
            <tr>
                <!--Display contents of the associative array retrieved from query -->
                <td><?php echo h($subject['Rental_ID']); ?></td>
                <td><?php echo h($subject['Title']); ?></td>
                <td><?php echo h($subject['Member_ID']); ?></td>
                <td><?php echo h($subject['Member_Name']); ?></td>
                <td><?php echo h($subject['Start_Date']); ?></td>
                <td><?php echo h($subject['Return_Date']); ?></td>
                <td><?php if(h($subject['Extended_Until']) == "")
                            {
                                echo 'N/A';
                            }
                            else
                            {
                            echo h($subject['Extended_Until']);
                            }
                    
                    ?>
                
                
                </td>
                <td><?php if(h($subject['Date_Returned']) == "")
                            {
                                echo 'N/A';
                            }
                            else
                            {
                            echo h($subject['Date_Returned']);
                            }
                    
                    ?>
                
                </td>
                <td><?php echo h($subject['Outstanding_Fee']); ?></td>

                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/rental/rental_edit.php?id=' . h(u($subject['Rental_ID']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/rental/rental_delete.php?id=' . h(u($subject['Rental_ID']))); ?>">Delete</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>

<?php mysqli_free_result($rentalSet);?>