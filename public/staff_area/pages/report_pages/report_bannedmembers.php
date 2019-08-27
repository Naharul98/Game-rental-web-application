<?php
require_once('../../../../private/initialize.php');
require_login();

//get associative array of banned members to display in table
$memberSet = getBannedMembers();

$pageTitle = 'Report - Banned Members'; 
include(SHARED_PATH . '/staff_header.php');

?>

<section class="search-banner bg-light text-black py-5" id="search-banner">    
    <div class="container pt-0 my-0">
        <div class="row text-center pb-4">
            <div class="col-lg-12">
                <h2>Banned Members Report</h2>
            </div>
        </div>                      
    </div>
</section>

<?php 
include(SHARED_PATH . '/display_member.php'); 
include(SHARED_PATH . '/staff_footer.php');

?>
