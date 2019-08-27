<?php
if(!isset($pageTitle))
{
    $pageTitle = 'Staff Area';
}
?>

<!doctype html>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="utf-8">
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        <link rel="stylesheet" media="all" href="<?php echo urlFor('/stylesheets/staffstyles.css'); ?>" />
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="<?php echo urlFor('/images/icon5.png'); ?>" width="35" height="35" class="d-inline-block align-top" alt="">
                Staff Area
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Rentals
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/rental_pages/rental_browse.php'); ?>">Browse Rentals</a>
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/rental_pages/rental_select_member.php'); ?>">Add Rentals</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Members
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/member_pages/members_browse.php'); ?>">Browse Members</a>
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/actions/member/member_new.php');?>">Add Members</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reports
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/report_pages/report_bannedmembers.php'); ?>">Banned Members</a>
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/report_pages/report_overdueitems.php'); ?>">Overdue Items</a>
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/report_pages/report_outstandingfees.php'); ?>">Outstanding Fees</a>
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if($_SESSION['Privilege'] != 'Secretary') {echo 'disabled';} ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Rules
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/actions/rule/rule_new.php');?>">Add Rules</a>
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/rules_pages/rules_browse.php'); ?>">Change Rules</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if($_SESSION['Privilege'] != 'Secretary') {echo 'disabled';} ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/actions/admin/admin_new.php');?>">Add New Admin</a>
                            <a class="dropdown-item" href="<?php echo urlFor('/staff_area/pages/admin_pages/admin_browse.php'); ?>">Change Admin</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">

                    <a href="<?php echo urlFor('/game_area/pages/home.php'); ?>" class="btn btn-outline-success my-2 my-sm-0" role="button" aria-pressed="true">Log Out</a>
                </form>
            </div>
        </nav>





