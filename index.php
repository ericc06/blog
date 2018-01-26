<?php
require('controller/frontend.php');
require('controller/backend.php');

session_start();
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
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
            $nb_param = count($_POST);
            if($nb_param != 5) {
                throw new Exception('Nombre de paramètres invalide.');
            }
            saveNewPost($_POST['title'], $_POST['author_first_name'], $_POST['author_last_name'], $_POST['intro'], $_POST['content']);
        }
        elseif ($_GET['action'] == 'saveModifiedPost') {
            // TODO : vérifier le nombre de paramètre (explode de l'URL pour l'URL rewriting)
            $nb_param = count($_POST);
            if($nb_param != 6) {
                throw new Exception('Nombre de paramètres invalide.');
            }
            if (isset($_POST['postId']) && $_POST['postId'] > 0) {
                saveModifiedPost($_POST['postId'], $_POST['title'], $_POST['author_first_name'], $_POST['author_last_name'], $_POST['intro'], $_POST['content']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        }
        else {
            showError404();
        }
    }
    else {
        showHomePage();
    }
}
catch(Exception $e) {
    showError('Erreur : ' . $e->getMessage());
    //echo 'Erreur : ' . $e->getMessage();
}

