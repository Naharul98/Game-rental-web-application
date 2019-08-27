<?php
require_once('../../../../private/initialize.php');
require_login();

//get associative array of overdue rentals
$rentalSet = getCurrentOverdueRentals();

$pageTitle = 'Report - Overdue Items'; 
include(SHARED_PATH . '/staff_header.php');

?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">

                <h2>Overdue Items Report Report</h2>

            </div>
        </div>                      
    </div>

</section>

<?php include(SHARED_PATH . '/display_rental.php'); ?>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
