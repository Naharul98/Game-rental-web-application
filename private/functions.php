
<?php
//adds the leading path of the root folder
function urlFor($script_path) 
{
    // add the leading '/' if not present
    if($script_path[0] != '/') 
    {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}
//encode url string
function u($string="") 
{
    return urlencode($string);
}
//encode html string
function h($string="") 
{
    return htmlspecialchars($string);
}
//returns true if the request for the php page is POST request, otherwise false
function is_post_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
//returns true if the request for the php page is GET request, otherwise false
function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}
//function used to redirect to a specific page
function redirect_to($location)
{
    header("Location: " . $location);
    exit;
}
//takes a bit representing boolean and returns boolean text
function get_boolean_text($bit)
{
    if($bit == 0)
    {
        return "False";
    }
    else
    {
        return "True";
    }
}
//takes an array representing error messages and returns string representing html code to display the error
function display_errors($errors=array()) 
{
    $output = '';
    if(!empty($errors)) 
    {
        $output .= "<div class=\"errors\">";
        $output .= "There were error in the data you input: </br>";
        $output .= "<ul>";
        foreach($errors as $error) 
        {
            $output .= "<li>" . h($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

?>
