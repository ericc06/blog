<?php
require 'twigInit.php';

ob_start();

$template = $twig->loadTemplate('homePageHeaderView.twig');
echo $template->render(array(
    'message_status' => $message_status
));

$template = $twig->loadTemplate('homePagePostsView.twig');
echo $template->render(array(
    'posts' => $twoPosts
));

$template = $twig->loadTemplate('homePageContactFormView.twig');
echo $template->render(array(
));

$content = ob_get_clean();

require('template.php');