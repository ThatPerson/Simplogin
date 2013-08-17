<?php
/* 
    Simplogin example
    
    By Giovanni Kosman
    www.kreativeweb.nl
    
    Modified by Ben Tatman
    http://www.bentatman.co.uk
*/

// Load the class

require 'simplogin/simplogin.class.php';

/* This is how you would initialize the class
    $simplogin = new Simplogin('db_host', 'db_user', 'db_password', 'db', 'Hash', 'salt');
*/

$simplogin = new Simplogin('localhost', 'root', 'root', 'database', 'SHA512', 'my_salt');

/*
    This is how you would use the class, you can use POST, GET information etc
    
    $simplogin->check('username', 'password');
    $simplogin->check($_POST['username'], $_POST['password']);
*/
$simplogin->create("username", "password");
// Just use an if statement to check if the credentials are valid
if ($simplogin->check('username', 'password') == true)
{
    echo 'Credentials were valid!';
}
else
{
    echo 'I\'m sorry, but the credentials are invalid.';
}
