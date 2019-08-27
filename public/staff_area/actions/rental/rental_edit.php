<?php

require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//if no id found in get request, redirect them to browse page
if(!isset($_GET['id'])) 
{
    redirect_to(urlFor('/staff_area/pages/rental_pages/rental_browse.php'));
}
$id = $_GET['id'];

if(is_post_request()) 
{
     //build associative array of - to be updated tuple
    $subject = [];
    $subject['Rental_ID'] = $id;
    $subject['Member_ID'] = $_GET['memberid'] ?? '0';
    $subject['Game_ID'] = $_POST['Game_ID'] ?? '';
    $subject['Start_Date'] = $_POST['Start_Date'] ?? '';
    $subject['Return_Date'] = $_POST['Return_Date'] ?? '';
    $subject['Extended_Until'] = $_POST['Extended_Until'] ?? '';
    $subject['Date_Returned'] = $_POST['Date_Returned'] ?? '';
    $subject['Return_Condition'] = $_POST['Return_Condition'] ?? '';
    $subject['Fee'] = $_POST['Fee'] ?? '';
    $subject['Paid'] = $_POST['Paid'] ?? '';
    
    //retrive number of current existing extensions the member has
    $noOfCurrentExtensions = mysqli_fetch_assoc(getNumberOfCurrentExtensions($subject['Member_ID']));
    
    //if member has more than 2 extensions, he wont be able to extend
    if(h($noOfCurrentExtensions['numberOfCurrentExtensions'])>=2 && $subject['Extended_Until'] !="")
    {
        $ret = "This member already has 2 games which he extended which he has not returned yet";
        $boolean = true;
    }
    //execute update
    $result = update_rental($subject);
    if($result === true)
    {
        //update successful
        redirect_to(urlFor('/staff_area/actions/rental/rental_show.php?id=' . $id));
    }
    else
    {
         //update failed
        $errors = $result;
    }
} 
else 
{
    //prepare to display rental info in the text fields
    $subject = find_rental_by_id($id);
}
//retrieve member tuple for display
$memberSubject = find_member_by_id($subject['Member_ID']);
//retrive game list to display in comboBox
$allGames = find_all_games();

$page_title = 'Edit Rental';
include(SHARED_PATH . '/staff_header.php');

?>
<!-- Date time picker scripts -->
<script>
    $(document).ready(function(){
        var date_input=$('input[name="Start_Date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    $(document).ready(function(){
        var date_input=$('input[name="Return_Date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    $(document).ready(function(){
        var date_input=$('input[name="Extended_Until"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    $(document).ready(function(){
        var date_input=$('input[name="Date_Returned"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
<!-- Date time picker scripts -->


<div class="container center_div">
    <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 40px">
        <div class="form-area">  
            <h5><?php echo display_errors($errors)?></h5>
            <form action="<?php echo urlFor('/staff_area/actions/rental/rental_edit.php?id=' . h(u($id))) . "&memberid=" . h(u($subject['Member_ID'])); ?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 0px; text-align: center;">Edit Rental</h3>
                <div class="form-group">
                    <span class = "label label-default">Member Name: </span>
                    <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Name" value="<?php echo h($memberSubject['Member_Name']);?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="text">Game:</label>
                    <select id="cmbGame" class="form-control pr-3 pl-3" name="Game_ID">
                        <?php
                        while($game = mysqli_fetch_assoc($allGames))
                        {                                                 
                            echo "<option value='".$game['Game_ID']."' " . ($game['Game_ID'] == $subject['Game_ID'] ? 'selected' : '').">".$game['Title']."</option>";
                        }
                        ?>
                    </select>                 
                </div>
                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Rent Start Date</label>
                    <input class="form-control" id="date" name="Start_Date" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo $subject['Start_Date']; ?>" type="text"/>
                </div>

                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Return Date</label>
                    <input class="form-control" id="date" name="Return_Date" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo $subject['Return_Date']; ?>" type="text"/>
                </div>
                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Extended Until (blank if unextended)</label>
                    <input class="form-control" id="date" name="Extended_Until" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo $subject['Extended_Until']; ?>" type="text"/>
                </div>
                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Date Returned (blank if unreturned)</label>
                    <input class="form-control" id="date" name="Date_Returned" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo $subject['Date_Returned']; ?>" type="text"/>
                </div>
                <!-- select default selection according to form inputs -->
                <?php
                echo '<span class = "label label-default pr-3 pl-3">Return Condition: </span>
                            <select id="cmb" class="form-control pr-3 pl-3" style="width: 200px;" name="Return_Condition">
                                <option value="Pending" ' . ($subject['Return_Condition'] == 'Pending' ? 'selected' : '') . '>Pending</option>
                                <option value="Good" ' . ($subject['Return_Condition'] == 'Good' ? 'selected' : '') . '>Good</option>
                                <option value="Unsatisfactory" ' . ($subject['Return_Condition'] == 'Unsatisfactory' ? 'selected' : '') . '>Unsatisfactory</option>  
                            </select>'; 
                ?>

                <div class="form-group">
                    <span class = "label label-default">Total Charge ($): </span>
                    <input type="text" class="form-control" id="Fee" name="Fee" value="<?php echo $subject["Fee"]; ?>" placeholder="Charge" required>
                </div>
                <div class="form-group">
                    <span class = "label label-default">Total Paid ($): </span>
                    <input type="text" class="form-control" id="Paid" name="Paid" value="<?php echo $subject['Paid']; ?>" placeholder="Amount Paid" required>
                </div>
                <a href="<?php echo urlFor('/staff_area/pages/rental_pages/rental_browse.php'); ?>" class="btn btn-md active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Save Changes"/>
            </form>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
