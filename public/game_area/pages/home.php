<?php
require_once('../../../private/initialize.php');
$pageTitle = 'Game Rental - Home Page';
include(SHARED_PATH . '/game_header.php');

?>

<!-- Masthead -->
<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1 class="mb-5">Video Game Rentals Made Easy</h1>

            </div>
        </div>
    </div>
</header>
<section class="features-icons bg-light text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="features-icons-icon d-flex">
                    <i class="icon-screen-desktop m-auto text-primary"></i>
                </div>
                <h3>Easy Renting</h3>
                <p class="lead mb-0">Only Takes a few minutes to sign up and order rentals!</p>
            </div>
            <div class="col-lg-4">
                <div class="features-icons-icon d-flex">
                    <i class="icon-layers m-auto text-primary"></i>
                </div>
                <h3>Cheap</h3>
                <p class="lead mb-0">Subscriptions from as little as £3.99 a month</p>
            </div>
            <div class="col-lg-4">
                <div class="features-icons-icon d-flex">
                    <i class="icon-check m-auto text-primary"></i>
                </div>
                <h3>Open 24/7</h3>
                <p class="lead mb-0">Members can drop in any time at the society</p>
            </div>
        </div>
    </div>
</section>
<!-- Image Showcases -->
<section class="showcase">
    <div class="container-fluid p-0">
        <div class="row no-gutters">

            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url(<?php echo urlFor('/images/showcase-1.jpg');?>);"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>Latest Games Available</h2>
                <p class="lead mb-0">We offer latest games available immedietly for renting, SIgn up today!</p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url(<?php echo urlFor('/images/showcase-2.jpg');?>);"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>Become a Pro!</h2>
                <p class="lead mb-0">Test your gaming skills with other society members and get started on your way to become a pro!</p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url(<?php echo urlFor('/images/showcase-3.jpg');?>);"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>Competetive Gaming</h2>
                <p class="lead mb-0">Our soceity organizes gaming competition every now and then. Join to compete!</p>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials -->
<section class="testimonials text-center bg-light">
    <div class="container">
        <h2 class="mb-5">What people are saying...</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="<?php echo urlFor('/images/testimonials-1.jpg');?>" alt="">
                    <h5>Sarah</h5>
                    <p class="font-weight-light mb-0">"Very easy to rent new games"</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="<?php echo urlFor('/images/testimonials-2.jpg');?>" alt="">
                    <h5>Fred</h5>
                    <p class="font-weight-light mb-0">"This gaming society is amazing. Lots of new like minded people to meet"</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="<?php echo urlFor('/images/testimonials-3.jpg');?>" alt="">
                    <h5>Iggy</h5>
                    <p class="font-weight-light mb-0">"Cheap and within my budget too"</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(SHARED_PATH . '/game_footer.php'); ?>
