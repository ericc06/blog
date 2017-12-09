<?php
require 'twigInit.php';

ob_start();

$template = $twig->loadTemplate('postView.twig');
echo $template->render(array(
    'post' => $post
));

$content = ob_get_clean();

require('template.php');