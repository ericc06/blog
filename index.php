<?php
require('controller/frontend.php');

include('avoidContactFormRepost.php');

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
            deletePost($_GET['id']);
        }
        elseif ($_GET['action'] == 'front') {
            $_SESSION['admin'] = false;
            showHomePage();
        }
        elseif ($_GET['action'] == 'saveNewPost') {
            // TODO : vérifier le nombre de paramètre (explode)
            $nb_param = count($_MY_POST);
            if($nb_param != 5) {
                throw new Exception('Nombre de paramètres invalide.');
            }
            saveNewPost($_MY_POST['title'], $_MY_POST['author_first_name'], $_MY_POST['author_last_name'], $_MY_POST['intro'], $_MY_POST['content']);
        }
        elseif ($_GET['action'] == 'saveModifiedPost') {
            // TODO : vérifier le nombre de paramètre (explode de l'URL pour l'URL rewriting)
            $nb_param = count($_MY_POST);
            if($nb_param != 6) {
                throw new Exception('Nombre de paramètres invalide.');
            }
            if (isset($_MY_POST['postId']) && $_MY_POST['postId'] > 0) {
                saveModifiedPost($_MY_POST['postId'], $_MY_POST['title'], $_MY_POST['author_first_name'], $_MY_POST['author_last_name'], $_MY_POST['intro'], $_MY_POST['content']);
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
        //echo "<br><br><br><br><br><br><br>post : "; var_dump($_MY_POST);
        $nb_param = count($_MY_POST);
        if($nb_param != 4) {
            throw new Exception('Nombre de paramètres invalide.');
        }
        sendContactForm($_MY_POST['firstname'], $_MY_POST['lastname'], $_MY_POST['email'], $_MY_POST['message']);
        /*
        else {
            throw new Exception('Something went wrong when submitting contact form.');
        }*/
    }
    else {
        showHomePage();
    }
}
catch(Exception $e) {
    showError('Erreur : ' . $e->getMessage());
    //echo 'Erreur : ' . $e->getMessage();
}
