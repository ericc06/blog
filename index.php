<?php
require('controller/frontend.php');
require('controller/backend.php');

include('avoidContactFormRepost.php');

$_SESSION['admin'] = ((isset($_SESSION['admin']) && $_SESSION['admin'] == true) ? true : false);


// Note: Here we use a custom $_MY_POST variable instead of $_POST
// to prevent contact form multiple submission when refreshing the page
// (see avoidContactFormRepost.php).

// session_start() is done in avoidContactFormRepost.php

$_SESSION['admin'] = ((isset($_SESSION['admin']) && $_SESSION['admin'] == true) ? true : false);
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_MY_POST['author']) && !empty($_MY_POST['comment'])) {
                    addComment($_GET['id'], $_MY_POST['author'], $_MY_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        }
        elseif ($_GET['action'] == 'admin') {
            $_SESSION['admin'] = true;
            listPosts();
        }
        elseif ($_GET['action'] == 'postAdmin') {
            $_SESSION['admin'] = true;
            post();
        }
        elseif ($_GET['action'] == 'postAdd') {
            postCreationForm();
        }
        elseif ($_GET['action'] == 'postMod') {
            postModifyForm();
        }
        elseif ($_GET['action'] == 'postDel') {
            // Generating secret token to prevent CSRF attacks
            $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
            $_SESSION['token'] = $token;
            deletePost($token, $_GET['id']);
        }
        elseif ($_GET['action'] == 'front') {
            $_SESSION['admin'] = false;
            showHomePage();
        }
        elseif ($_GET['action'] == 'saveNewPost') {
            // TODO : vérifier le nombre de paramètre (explode)
            $nb_param = count($_MY_POST);
            if($nb_param != 6) {
                throw new Exception('Nombre de paramètres invalide.');
            }
            saveNewPost($_MY_POST['token'], $_MY_POST['title'], $_MY_POST['author_first_name'], $_MY_POST['author_last_name'], $_MY_POST['intro'], $_MY_POST['content']);
        }
        elseif ($_GET['action'] == 'saveModifiedPost') {
            // TODO : vérifier le nombre de paramètre (explode de l'URL pour l'URL rewriting)
            $nb_param = count($_MY_POST);
            if($nb_param != 7) {
                throw new Exception('Nombre de paramètres invalide.');
            }
            if (isset($_MY_POST['postId']) && $_MY_POST['postId'] > 0) {
                saveModifiedPost($_MY_POST['token'], $_MY_POST['postId'], $_MY_POST['title'], $_MY_POST['author_first_name'], $_MY_POST['author_last_name'], $_MY_POST['intro'], $_MY_POST['content']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        }
        else {
            showError404();
        }
    }
    elseif (isset($_MY_POST['firstname'])) {
        $nb_param = count($_MY_POST);
        if($nb_param != 4) {
            throw new Exception('Nombre de paramètres invalide.');
        }
        sendContactForm($_MY_POST['firstname'], $_MY_POST['lastname'], $_MY_POST['email'], $_MY_POST['message']);
    }
    else {
        showHomePage();
    }
}
catch(Exception $e) {
    showError('Erreur : ' . $e->getMessage());
}
