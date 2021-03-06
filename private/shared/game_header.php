<?php
if(!isset($pageTitle))
{
    //Set the page title
    $pageTitle = 'Game Area';
}
?>

<!doctype html>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" media="all" href="<?php echo urlFor('/stylesheets/gamestyles.css'); ?>" />

    </head>

    <body>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="<?php echo urlFor('/images/icon5.png'); ?>" width="35" height="35" class="d-inline-block align-top" alt="">
                Gaming Society
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo urlFor('/game_area/pages/home.php'); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo urlFor('/game_area/pages/browse.php'); ?>">Browse Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo urlFor('/game_area/pages/societyrules.php'); ?>">Society Rules</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a href="<?php echo urlFor('/staff_area/login.php'); ?>" class="btn btn-outline-success my-2 my-sm-0" role="button" aria-pressed="true">Staff Login</a>
                </form>
            </div>
        </nav>
