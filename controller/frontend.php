<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/ContactFormManager.php');

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

function listPosts()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    $posts = $postManager->getPosts()->fetchAll();

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    require('view/frontend/listPostsView.php');
}

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
        /*
function controlContactForm($firstname, $lastname, $email, $message)
{
    //...
    processContactForm($firstname, $lastname, $email, $message);
}

function processContactForm($firstname, $lastname, $email, $message)
{
    if (isset($email))
    {
        $from = $firstname . ' ' . $lastname . ' <' . $email . '>';
        $emailSender = new \EricCodron\Blog\Model\ContactFormManager();
        $result = $emailSender->send("eric.codron@gmail.com", "E-mail depuis le formulaire de contact", $message, $from);
    }
    
    if($result === true) {
        showHomePage('mail_OK');
    }
    else {
        showHomePage('mail_KO');
    }
}
*/