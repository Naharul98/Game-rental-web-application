<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

$id = $_GET['id'] ?? '';

if(is_post_request()) 
{
    //build associative array of - to be inserted tuple
    $subject = [];
    $subject['Game_ID'] = $_POST['Game_ID'] ?? '0';
    $subject['Member_ID'] = $id ?? '';
    $subject['Start_Date'] = $_POST['Start_Date'] ?? '';
    $subject['Return_Date'] = $_POST['Return_Date'] ?? '';
    $subject['Fee'] = $_POST['Fee'] ?? '';
    $subject['Paid'] = $_POST['Paid'] ?? '';
    //execute insert
    $result = insert_rental($subject);
    if($result === true)
    {
        //insert sucessful
        $new_id = mysqli_insert_id($db);
        redirect_to(urlFor('/staff_area/actions/rental/rental_show.php?id=' . $new_id));
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
    $subject["Game_ID"] = '';
    $subject["Member_ID"] = '';
    $subject["Start_Date"] = '';
    $subject["Return_Date"] = '';
    $subject["Fee"] = '';
    $subject["Paid"] = '';
}
//if member id is blank -> ERROR
if($id != "")
{
    
    $sub = find_member_by_id($id);
}
else
{
    //if no memberID in GET< redirect to select member page
    redirect_to(urlFor('/staff_area/pages/rental_pages/rental_select_member.php'));
}
//retrieve array of games
$allGames = find_all_games();

$pageTitle = 'Staff Area - Add Rentals'; 
include(SHARED_PATH . '/staff_header.php');

?>
<!-- Script for the date time picker -->
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
</script>
<!-- Script for the date time picker -->

<div class="container center_div">
    <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 20px">
        <div class="form-area">  
            <h5><?php echo display_errors($errors)?></h5>
            <form action="<?php echo urlFor('/staff_area/actions/rental/rental_new.php?id=' . $id);?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 0px; text-align: center;">Create Rental</h3>
                <div class="form-group">
                    <span class = "label label-default">Member Name: </span>
                    <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Name" value="<?php echo h($sub['Member_Name']);?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="text">Game:</label>
                    <select id="cmbGame" class="form-control pr-3 pl-3" name="Game_ID" onchange="document.getElementById('selected_text_for_game').value=this.options[this.selectedIndex].text">
                        <!-- populate dropdown with game list-->
                        <option selected value="0" style="display:none">Select Game</option>
                        <?php
                        while($subject = mysqli_fetch_assoc($allGames))
                        {                                                 
                            echo "<option value='".$subject['Game_ID']."'".">".$subject['Title']."</option>";

                        }
                        ?>
                    </select>                 
                </div>
                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Rent Start Date</label>
                    <input class="form-control" id="date" name="Start_Date" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d'); ?>" type="text"/>
                </div>
                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Return Date</label>
                    <input class="form-control" id="date" name="Return_Date" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo  $subject["Return_Date"]; ?>" type="text"/>
                </div>


                <div class="form-group">
                    <span class = "label label-default">Total Charge ($): </span>
                    <input type="text" class="form-control" id="Fee" name="Fee" value="<?php echo $subject["Fee"]; ?>" placeholder="Charge" required>
                </div>
                <div class="form-group">
                    <span class = "label label-default">Total Paid ($): </span>
                    <input type="text" class="form-control" id="Paid" name="Paid" value="<?php echo $subject['Paid']; ?>" placeholder="Amount Paid" required>
                </div>
                <a href="<?php echo urlFor('/staff_area/pages/rental_pages/rental_select_member.php'); ?>" class="btn btn-md active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Create Rental"/>
            </form>
        </div>
    </div>
</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>
