<?php
require 'twigInitAdmin.php';

ob_start();

$template = $twig->loadTemplate('postModView.twig');
echo $template->render(array(
    'post' => $post
));

$content = ob_get_clean();

require('template.php');