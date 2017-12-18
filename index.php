<?php
require('controller/frontend.php');

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
                throw new Exception('Aucun identifiant de billet envoyé');
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
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    elseif (isset($_POST['firstname'])) {
        //echo "<br><br><br><br><br><br><br>post : "; var_dump($_POST);
        processContactForm($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['message']);
        unset($_POST['firstname']);
        unset($_POST['lastname']);
        unset($_POST['email']);
        unset($_POST['message']);
        /*}
        else {
            throw new Exception('Something went wrong when submitting contact form.');
        }*/
    }
    else {
        showHomePage();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

