<?php 
require_once('../../../private/initialize.php');

//get the id of the page passed through GET
$id = isset($_GET['id']) ? $_GET['id'] : '1';

?>

<?php
//get the associative array of the game from the query
$game = find_game_by_id(h($id));
$gameObject;
foreach($game as $g)
{
    $gameObject = $g;
    break;
}
//Set message for whether the game is available for rental or not
$available = "";
$numberOfPendingReturnForGame = mysqli_fetch_assoc(getNumberOfPendingReturnForGame($id));
//Check if game is already rented out or not
if(h($numberOfPendingReturnForGame['numberOfPendingReturns'])>=1)
{
    $available = "Copies Currently Rented Out";
}
else
{
    $available = "Available For Rent";
}

//initialize variables with repective details for game to display in the page
$title = h($gameObject['Title']);
$type = h($gameObject['Game_Type']);
$releaseyear = h($gameObject['Release_Year']);
$platform = h($gameObject['Platform']);
$artwork = h($gameObject['Artwork_Name']);
$price =  h($gameObject['Price']);
$description =  h($gameObject['Description']);


$page_title = 'Game Details';
include(SHARED_PATH . '/game_header.php');
?>


<div class="container pb-0">
    <h1>
        <a href="<?php echo urlFor('/game_area/pages/browse.php'); ?>" class="btn btn-md active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Go Back</a>
    </h1>
</div>

<div class="container pb-5">
    <h1 class="my-4"><?php echo $title;?></h1>
    <div class="row">
        <div class="col-md-8">
            <img class="img-fluid" src="<?php echo urlFor('/artworks/' . $artwork); ?>" alt="">
        </div>
        <div class="col-md-4">
            <h3 class="my-2">Description</h3>
            <p><?php echo $description;?></p>
            <h3 class="my-2">Details</h3>
            <ul>
                <!-- Display contents of the particular game -->
                <li>Type: <?php echo $type; ?></li>
                <li>Release year: <?php echo $releaseyear;?> </li>
                <li>Platform: <?php echo $platform;?></li>
                <li>Price: <?php echo $price;?></li>
                <li><strong><?php echo $available;?></strong></li>
            </ul>
        </div>
    </div>
</div>



<?php include(SHARED_PATH . '/game_footer.php'); ?>
