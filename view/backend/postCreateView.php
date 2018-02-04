<?php
require 'twigInitAdmin.php';

// Generating secret token to prevent CSRF attacks
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

$_SESSION['token'] = $token;

ob_start();

$template = $twig->loadTemplate('postCreateView.twig');
echo $template->render(array(
    'token' => $token
));

$content = ob_get_clean();

require('template.php');