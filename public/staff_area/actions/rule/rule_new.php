<?php
require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

if(is_post_request()) 
{
    //build associative array of - to be inserted tuple
    $subject = [];
    $subject['Rule'] = $_POST['rule'] ?? '';
    //execute insert
    $result = insert_rule($subject);

    if($result === true)
    {
        //insert sucessful
        $new_id = mysqli_insert_id($db);
        redirect_to(urlFor('/staff_area/actions/rule/rule_show.php?id=' . $new_id));
    }
    else
    {
        //insert failed
        $errors = $result;
    }
}
else 
{
    $subject = [];
    $subject["Rule"] = '';
}

$pageTitle = 'Staff Area - Add Rule'; 
include(SHARED_PATH . '/staff_header.php');
?>

<div class="container center_div">
    <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 40px">
        <div class="form-area">  
            <h5><?php echo display_errors($errors)?></h5>
            <form action="<?php echo urlFor('/staff_area/actions/rule/rule_new.php');?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Add New Rule</h3>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" id="message" placeholder="Rule Message" name="rule" rows="7" required> <?php echo $subject["Rule"] ?></textarea>         
                </div>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Create Rule"/>
            </form>
        </div>
    </div>
</div>
