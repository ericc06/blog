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
    if (isset($_GET['id']) AND !empty($_GET['id'])) {
        $postManager = new \EricCodron\Blog\Model\PostManager();
        $post = $postManager->getPost($_GET['id']);

        $homeMenuURL = 'index.php';
        $blogMenuURL = 'index.php?action=listPosts';
        $contactMenuURL = 'index.php#contact';
        
        require('view/backend/postModView.php');
    }
    else {
        showError404();
    }
}

// Save the newly created blog post into the database or display an error message
function saveNewPost($token, $title, $author_first_name, $author_last_name, $intro, $content)
{
    // CSRF prevention: We check if all the expected tokens exist
    if (isset($_SESSION['token']) AND isset($token) AND !empty($_SESSION['token']) AND !empty($token)) {

        // We check that both tokens are the same
        if ($_SESSION['token'] == $token) {

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
        else {
            throw new Exception('Impossible de créer le billet !');
        }
    }
    else {
        throw new Exception('Impossible de créer le billet !');
    }
}

// Save the modified blog post into the database or display an error message
function saveModifiedPost($token, $postId, $title, $author_first_name, $author_last_name, $intro, $content)
{
    // CSRF prevention: We check if all the expected tokens exist
    if (isset($_SESSION['token']) AND isset($token) AND !empty($_SESSION['token']) AND !empty($token)) {

        // We check that both tokens are the same
        if ($_SESSION['token'] == $token) {

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
        else {
            throw new Exception('Impossible de modifier le billet !');
        }
    }
    else {
        throw new Exception('Impossible de modifier le billet !');
    }
}

// Delete a blog post from the database or display an error message
function deletePost($token, $postId)
{
    // CSRF prevention: We check if all the expected tokens exist
    if (isset($_SESSION['token']) AND isset($token) AND !empty($_SESSION['token']) AND !empty($token)) {

        // We check that both tokens are the same
        if ($_SESSION['token'] == $token) {

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
        else {
            throw new Exception('Impossible de supprimer le billet !');
        }
    }
    else {
        throw new Exception('Impossible de supprimer le billet !');
    }
}
