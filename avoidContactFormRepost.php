<?php

session_start();

if(!empty($_POST))
{
    $_SESSION['savedPOST'] = $_POST ;
    
    $currentFile = $_SERVER['PHP_SELF'] ;
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $currentFile .= '?' . $_SERVER['QUERY_STRING'] ;
    }
    
    header('Location: ' . $currentFile);
    exit;
}

if(isset($_SESSION['savedPOST']))
{
    // We use a new variable $_MY_POST instead of using $_POST
    // to prevent contact form multiple submission when refreshing the page
    $_MY_POST = $_SESSION['savedPOST'] ;
    
    unset($_SESSION['savedPOST']);
}