<?php

// Classes loading
require_once('model/PostManager.php');

// Display the blog post creation form
function postCreationForm()
{
    $postManager = new \EricCodron\Blog\Model\PostManager();

    $homeMenuURL = 'index.php';
    $blogMenuURL = 'index.php?action=listPosts';
    $contactMenuURL = 'index.php#contact';
    
    require('view/backend/postCreateView.php');
}

// Display the blog post modification form
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

// Save the newly created blog post into the database or display an error message
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

// Save the modified blog post into the database or display an error message
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

// Delete a blog post from the database or display an error message
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
