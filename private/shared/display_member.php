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
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php while($subject = mysqli_fetch_assoc($memberSet)) { ?>
            <tr>
                <!--Display contents of the associative array retrieved from query -->
                <td><?php echo h($subject['Member_ID']); ?></td>
                <td><?php echo h($subject['Member_Name']); ?></td>
                <td><?php echo h($subject['Member_Email']); ?></td>
                <td><?php echo h($subject['Member_Contact']); ?></td>
                <td><?php
                            //display Appropriate text in the banned column
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
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/member/member_edit.php?id=' . h(u($subject['Member_ID']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo urlFor('/staff_area/actions/member/member_delete.php?id=' . h(u($subject['Member_ID']))); ?>">Delete</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>

<?php mysqli_free_result($memberSet);?>