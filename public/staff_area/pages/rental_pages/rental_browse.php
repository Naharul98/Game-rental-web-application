<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//get the selected text for filter criteria according to dropdown
$gameInCombo = $_POST['selected_text_for_game'] ?? 'Any';
$rentalInCombo = $_POST['Rental_ID'] ?? '';
$memberInCombo = $_POST['Member_ID'] ?? '';

//retrive associative array of all games in database to display in combobox
$allGames = find_all_games();

//get associatve array of rentals filtered according to criteria
$rentalSet = filterRentals($rentalInCombo,$memberInCombo,$gameInCombo);

$pageTitle = 'Staff Area - Rental Browse';
include(SHARED_PATH . '/staff_header.php');
?>



<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">
                <h2>Rental Search</h2>
            </div>
        </div>                      
        <form action="<?php echo urlFor('/staff_area/pages/rental_pages/rental_browse.php');?>" method="POST" class="form-inline" >
            <div class="container-fluid">
                <div class="row">
                    <div class="span6" style="float: none; margin: 0 auto;">
                        <span class = "label label-default pr-3 pl-3">Rental ID: </span>
                        <input type="text" class="form-control" name="Rental_ID" id="rentalID" placeholder="Rental ID" value= "<?php echo $rentalInCombo;?>">
                        <span class = "label label-default pr-3 pl-3">Member ID: </span>
                        <input type="text" class="form-control" name="Member_ID" id="memberName" placeholder="Member ID" value="<?php echo $memberInCombo;?>">
                        <span class = "label label-default pr-3 pl-3">Game: </span>
                        <select id="cmbGame" class="form-control pr-3 pl-3" style="width: 150px;" name="cmbGame" onchange="document.getElementById('selected_text_for_game').value=this.options[this.selectedIndex].text">
                            <!-- Populate dropdown and select appropriate option-->
                            <?php echo '<option value="0" ' . ($gameInCombo == 'Any' ? 'selected' : '') . '>Any</option>';?>
                            <?php
                            while($subject = mysqli_fetch_assoc($allGames))
                            {                                                 
                                echo "<option value='".$subject['Game_ID']."'".($gameInCombo == $subject['Title'] ? 'selected' : '').">".$subject['Title']."</option>";

                            }
                            ?>
                        </select>

                        <input type="hidden" name="selected_text_for_game" id="selected_text_for_game" value="<?php echo $gameInCombo;?>";/>
                        <input type="submit" name="search" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Search"/>
                    </div>
                </div>
            </div>
        </form>
    </div>

</section>

<?php 
include(SHARED_PATH . '/display_rental.php'); 
include(SHARED_PATH . '/staff_footer.php');

?>

