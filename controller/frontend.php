<?php

// Classes loading
require_once('model/PostManager.php');
require_once('model/ContactFormManager.php');

// Display the home page
function showHomePage($message_status = '')
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    $twoPosts = $postManager->getTwoPosts()->fetchAll();
    
    $homeMenuURL = '#page-top';
    $blogMenuURL = '#last-posts';
    $contactMenuURL = '#contact';
    $message_status = $message_status;
    
    require('view/frontend/homePageView.php');
}

// Display the Error 404 page (page not found error)
function showError404()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    
    $homeMenuURL = '#page-top';
    $blogMenuURL = '#last-posts';
    $contactMenuURL = '#contact';
    
    require('view/frontend/error404.php');
}

// Display the generic error page
function showError($error_message)
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    
    $homeMenuURL = '#page-top';
    $blogMenuURL = '#last-posts';
    $contactMenuURL = '#contact';

    require('view/frontend/error.php');
}

// Display the blog posts list
function listPosts()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    $posts = $postManager->getPosts()->fetchAll();

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    require('view/frontend/listPostsView.php');
}

// Display a single blog post
function post()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    $post = $postManager->getPost($_GET['id']);

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    require('view/frontend/postView.php');
}

function sendContactForm($firstname, $lastname, $email, $message)
{
    $result = false;

    if (isset($email))
    {
        $emailSender = new \EricCodron\Blog\Model\ContactFormManager();
        $result = $emailSender->controlContactForm($firstname, $lastname, $email, $message);
    }
    
    if($result === true) {
        showHomePage('mail_OK');
    }
    else {
        showHomePage('mail_KO');
    }
}