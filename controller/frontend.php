<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/ContactFormManager.php');

function showHomePage()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    $twoPosts = $postManager->getTwoPosts()->fetchAll();
    
    $homeMenuURL = '#page-top';
    $blogMenuURL = '#last-posts';
    $contactMenuURL = '#contact';
    
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

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

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
        $emailSender->send("eric.codron@gmail.com", "Email from your website", $message, $from);
    }

    showHomePage();
}