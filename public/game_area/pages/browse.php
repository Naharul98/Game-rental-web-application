<?php
require_once('../../../private/initialize.php');

//get the selected text for filter criteria according to combobox
$platform = $_POST['selected_text_for_platform'] ?? 'Any';
$year = $_POST['selected_text_for_year'] ?? 'Any';
$type = $_POST['selected_text_for_type'] ?? 'Any';

//get associatve array of games filtered according to criteria
$game_set = filterGames($platform,$year,$type);
//set title
$pageTitle = 'Browse Game Collection';
include(SHARED_PATH . '/game_header.php');

?>


<section class="search-banner bg-light text-black py-5" id="search-banner">
    <div class="container pt-3 my-0">
        <div class="row text-center pb-4">
            <div class="col-md-12">
                <h2>Browse The Latest Game Collection!</h2>
            </div>
        </div>                      
        <form action="<?php echo urlFor('/game_area/pages/browse.php');?>" method="POST" class="form-inline" >
            <div class="container-fluid">

                <div class="row">
                    <div class="span6" style="float: none; margin: 0 auto;">
                        <?php
                        //restore the selected item in the combobox after the POST request
                        //so that whatever was selected in the combobox, it remains the same
                        echo '<span class = "label label-default pr-3 pl-3">Platform: </span>
                            <select id="cmb" class="form-control pr-3 pl-3" style="width: 150px;" name="Platform"     onchange="document.getElementById(\'selected_text_for_platform\').value=this.options[this.selectedIndex].text">
                                <option value="0" ' . ($platform == 'Any' ? 'selected' : '') . '>Any</option>
                                <option value="1" ' . ($platform == 'PC' ? 'selected' : '') . '>PC</option>
                                <option value="2" ' . ($platform == 'XBOX' ? 'selected' : '') . '>XBOX</option>  
                                 <option value="3" ' . ($platform == 'PS4' ? 'selected' : '') . '>PS4</option> 
                            </select>'; 

                        echo '<span class = "label label-default pr-3 pl-3">Year: </span>
                            <select id="cmb" class="form-control" style="width: 150px;" name="Year"     onchange="document.getElementById(\'selected_text_for_year\').value=this.options[this.selectedIndex].text">
                                <option value="0" ' . ($year == 'Any' ? 'selected' : '') . '>Any</option>
                                <option value="1" ' . ($year == '2018' ? 'selected' : '') . '>2018</option>
                                <option value="2" ' . ($year == '2017' ? 'selected' : '') . '>2017</option>  
                                 <option value="3" ' . ($year == '2016' ? 'selected' : '') . '>2016</option> 
                                 <option value="4" ' . ($year == '2015' ? 'selected' : '') . '>2015</option> 
                                 <option value="5" ' . ($year == '2014' ? 'selected' : '') . '>2014</option> 
                                 <option value="6" ' . ($year == '2013' ? 'selected' : '') . '>2013</option> 
                            </select>'; 

                        echo '<span class = "label label-default pr-3 pl-3">Type: </span>
                            <select id="cmb" class="form-control" style="width: 150px;" name="Type"   onchange="document.getElementById(\'selected_text_for_type\').value=this.options[this.selectedIndex].text">
                                <option value="0" ' . ($type == 'Any' ? 'selected' : '') . '>Any</option>
                                <option value="1" ' . ($type == 'Action' ? 'selected' : '') . '>Action</option>
                                <option value="2" ' . ($type == 'Adventure' ? 'selected' : '') . '>Adventure</option>  
                                 <option value="3" ' . ($type == 'Racing' ? 'selected' : '') . '>Racing</option> 
                            </select>';
                        ?>
                        <input type="hidden" name="selected_text_for_year" id="selected_text_for_year" value="<?php echo $year?>" />
                        <input type="hidden" name="selected_text_for_platform" id="selected_text_for_platform" value="<?php echo $platform?>" />
                        <input type="hidden" name="selected_text_for_type" id="selected_text_for_type" value="<?php echo $type?>" />
                        <input type="submit" name="search" class="btn btn-md active" style="background-color:#2d3246; color :white; width:150px; padding-left:5px;" role="button" aria-pressed="true" value="Search"/>
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
                <th>Game ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Release Year</th>
                <th>Platform</th>
                <th>Price</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php while($subject = mysqli_fetch_assoc($game_set)) { ?>
            <tr>
                <!-- populate table with the associative array retrieved from the query -->
                <td><?php echo h($subject['Game_ID']); ?></td>
                <td><?php echo h($subject['Title']); ?></td>
                <td><?php echo h($subject['Game_Type']); ?></td>
                <td><?php echo h($subject['Release_Year']); ?></td>
                <td><?php echo h($subject['Platform']); ?></td>
                <td><?php echo h($subject['Price']); ?></td>
                <td><a class="action" href="<?php echo urlFor('/game_area/records/show.php?id=' . h(u($subject['Game_ID']))); ?>">View</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>








<?php mysqli_free_result($game_set);?>

<?php include(SHARED_PATH . '/game_footer.php'); ?>
