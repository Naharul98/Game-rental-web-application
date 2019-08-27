<?php

require_once('db_credentials.php');
//Connects to the database using the credentials
function db_connect() 
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}
//terminates connection to database
function db_disconnect($connection) 
{
    if(isset($connection)) 
    {
        mysqli_close($connection);
    }
}
//prevents sql injection
function db_escape($connection, $string) 
{
    return mysqli_real_escape_string($connection, $string);
}

?>
