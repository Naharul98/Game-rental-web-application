<?php
require_once('../../../private/initialize.php');
//retrieve associative array of all rules from the database table to display in the page
$rule_set = get_all_rules();

//set page title
$pageTitle = 'Society Rules';
include(SHARED_PATH . '/game_header.php');

?>


<body>
    <div class = "container pt-4 pb-4">
        <section class = "content" id = "Rules">
            <h1 class = "text-uppercase" class ="text-left">Our Rules And Regulations</h1>
            <p class = "text-lead-justify"class ="text-center">
                Our Community grows larger and larger by the day and we are more than happy to welcome anyone and everyone into our large family. With that being said, we have set some rules and regulations for our customers.
            </p>  

            <h3 class = "text-uppercase">Rules:</h3>

            <ul style="list-style-type:disc; margin-left:25px;">
                <!-- Display rule cotents from the associative array in the table -->
                <?php while($subject = mysqli_fetch_assoc($rule_set)) { ?>

                <li><?php echo h($subject['Rule']); ?></li>
                <?php } ?>
            </ul>  


        </section>

    </div>



    <?php include(SHARED_PATH . '/game_footer.php'); ?>

