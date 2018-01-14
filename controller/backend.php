<?php

// Chargement des classes
require_once('model/PostManager.php');


function listPostsAdmin()
{
    $_SESSION['admin'] = true;
    
    $postManager = new \EricCodron\Blog\Model\PostManager();
    $posts = $postManager->getPosts()->fetchAll();

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    //require('view/backend/listPostsAdminView.php');
    require('view/frontend/listPostsView.php');
}

function postAdmin()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    $post = $postManager->getPost($_GET['id']);

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    //require('view/backend/postAdminView.php');
    require('view/frontend/postView.php');
}

function postCreationForm()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    require('view/backend/postCreateView.php');
}

function postModifyForm()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();
    // TODO : vérifier que le paramètre est bien présent, sinon page 404
    $post = $postManager->getPost($_GET['id']);

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    require('view/backend/postModView.php');
}

function saveNewPost($title, $author_first_name, $author_last_name, $intro, $content)
{
    $postManager = new \EricCodron\Blog\Model\PostManager();

    $lastId = $postManager->postNewPost($title, $author_first_name, $author_last_name, $intro, $content);

    if ($lastId === false) {
        throw new Exception('Impossible de créer le billet !');
    }
    else {
        $SESSION['create_OK'] = true;
        header('Location: index.php?action=post&id=' . $lastId);
    }    
}

function saveModifiedPost($postId, $title, $author_first_name, $author_last_name, $intro, $content)
{
    $postManager = new \EricCodron\Blog\Model\PostManager();

    $affectedLines = $postManager->postModifiedPost($postId, $title, $author_first_name, $author_last_name, $intro, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le billet !');
    }
    else {
        $SESSION['modif_OK'] = true;
        header('Location: index.php?action=post&id=' . $postId);
    }    
}

function deletePost($postId)
{
    $postManager = new \EricCodron\Blog\Model\PostManager();

    $affectedLines = $postManager->postDeletedPost($postId);

    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le billet !');
    }
    else {
        $SESSION['delete_OK'] = true;
        header('Location: index.php?action=listPosts');
    }    
}

/*
function addComment($postId, $author, $comment)
{
    $commentManager = new \EricCodron\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
*/