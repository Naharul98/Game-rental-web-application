<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//if no id found in get request, redirect them to browse page
if(!isset($_GET['id'])) 
{
    redirect_to(urlFor('/staff_area/pages/rules_pages/rules_browse.php'));
}
$pageTitle = 'Delete Rule'; 

$id = $_GET['id'];

//retrieve associative array of Rule according to id in the GET
$subject = find_rule_by_id($id);

if(is_post_request()) 
{
    //execute delete
    $result = delete_rule($id);
    if($result)
    {
        //delete sucessful
        redirect_to(urlFor('/staff_area/pages/rules_pages/rules_browse.php'));
    }
    else
    {
        //delete failed
        $subject = find_rule_by_id($id);
    }
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
        <link rel="stylesheet" media="all" href="<?php echo urlFor('/stylesheets/staffstyles.css'); ?>" />
    </head>
    <body>
        <section class="search-banner bg-light text-black py-5" id="search-banner">    
            <div class="container pt-0 my-0">
                <div class="row text-center pb-4">
                    <div class="col-lg-12">
                        <h2>Are you sure you want to delete the following Rule?</h2>
                        <br/>
                        <h3><?php echo $subject['Rule'];?></h3>
                    </div>
                </div>                      
                <form action="<?php echo urlFor('/staff_area/actions/rule/rule_delete.php?id=' . h(u($subject['Rule_ID']))); ?>" method="POST" class="form-inline" >
                    <div class="container-fluid">
                        <div class="row">
                            <div class="span6" style="float: none; margin: 0 auto;">

                                <input type="submit" name="search" class="btn btn-lg active" style="background-color:#2d3246; color :white;" role="button" aria-pressed="true" value="Yes"/>

                                <a href="<?php echo urlFor('/staff_area/pages/rules_pages/rules_browse.php'); ?>" class="btn btn-lg active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">No</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </section>
    </body>
</html>
<?php
db_disconnect($db);
?>
