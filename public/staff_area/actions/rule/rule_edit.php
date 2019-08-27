<?php

require_once('../../../../private/initialize.php');
//if user not logged in then redirect them to login page
require_login();

//if no id found in get request, redirect them to browse page
if(!isset($_GET['id'])) 
{
    redirect_to(urlFor('/staff_area/pages/rules_pages/rules_browse.php'));
}
$id = $_GET['id'];

if(is_post_request()) 
{
    //build associative array of - to be updated tuple
    $subject = [];
    $subject['Rule_ID'] = $id;
    $subject['Rule'] = $_POST['Rule'] ?? '';
    //execute update
    $result = update_rules($subject);
    if($result === true)
    {
        //update sucessful
        redirect_to(urlFor('/staff_area/actions/rule/rule_show.php?id=' . $id));
    }
    else
    {
        //update failed
        $errors = $result;
    }

}
else 
{
    $subject = find_rule_by_id($id);
}

$page_title = 'Edit Rule';
include(SHARED_PATH . '/staff_header.php');

?>

<div class="container center_div">
    <div class="col-md-8 centered" style="padding-left : 300px; padding-bottom : 40px">
        <div class="form-area">
            <h5><?php echo display_errors($errors)?></h5>
            <form action="<?php echo urlFor('/staff_area/actions/rule/rule_edit.php?id=' . h(u($id))); ?>" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Edit Rule</h3>
                <div class="form-group">
                    <label for="text">Rule:</label>
                    <textarea class="form-control" type="textarea" id="message" placeholder="Rule Message" name="Rule" rows="7" required><?php echo h($subject['Rule']);?></textarea>    
                </div>

                <a href="<?php echo urlFor('/staff_area/pages/rules_pages/rules_browse.php'); ?>" class="btn btn-md active" style="background-color:#2d3246; color :white" role="button " aria-pressed="true">Back To List</a>
                <input type="submit" name="submit" class="btn btn-md active" style="background-color:#2d3246; color :white; width:120px; padding-left:5px;" role="button" aria-pressed="true" value="Save Changes"/>

            </form>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
