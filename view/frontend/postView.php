<?php
require 'twigInit.php';

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $admin_links = '<a href="index.php?action=postMod&id=' . $post['id'] . '" class="admin-link">{modifier}</a> <a href="index.php?action=postDel&id=' . $post['id'] . '" class="admin-link">{supprimer}</a>';
}
else {
    $admin_links = '';
} 

if(isset($_SESSION['modif_OK']) && $_SESSION['modif_OK'] == true) {
    $admin_message = '<p><span>Vos modifications ont bien été sauvegardées.</span></p>';
    unset($_SESSION['modif_OK']);
}
else {
    $admin_message = '';
}

ob_start();

$template = $twig->loadTemplate('postView.twig');
echo $template->render(array(
    'post' => $post,
    'admin_message' => $admin_message,
    'admin_links' => $admin_links
));

$content = ob_get_clean();

require('template.php');