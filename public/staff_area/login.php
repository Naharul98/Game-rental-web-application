<?php
require_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request())
{
    //retrive username posted in form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    //query username in database
    $admin = find_admin_by_username($username);

    if($admin)
    {
        //username found
        if(password_verify($password,$admin['Hashed_Password']))
        {
            //password is verified to be correct
            log_in_admin($admin);
            redirect_to(urlFor('/staff_area/pages/rental_pages/rental_browse.php'));
        }
        else
        {
            //password is incorrect
            $errors[] = "username or password was incorrect";
        }
    }
    else
    {
        //username doesnt exist
        $errors[] = "The username doesnt exist";
    }
}

$pageTitle = 'Staff Area - Login'; 

?>
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
        <div class="container center_div">
            <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 40px">
                <div class="form-area">  
                    <form action="<?php echo urlFor('/staff_area/login.php');?>" method="POST">
                        <br style="clear:both">
                        <h3 style="margin-bottom: 25px; text-align: center;">Login</h3>
                        <div class="form-group">
                            <label for="text">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="" required>                 
                        </div>
                        <div class="form-group">
                            <label for="text">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;padding-bottom:5px;" role="button" aria-pressed="true" value="Login"/>
                        <?php echo display_errors($errors); ?>
                    </form>
                </div>
            </div>
        </div>
    </body>

