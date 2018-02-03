<?php
require 'twigInit.php';

ob_start();

$template = $twig->loadTemplate('error.twig');
echo $template->render(array(
    'error_message' => $error_message
));

$content = ob_get_clean();

require('template.php');