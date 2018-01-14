<?php
require 'twigInitAdmin.php';

ob_start();

$template = $twig->loadTemplate('postCreateView.twig');
echo $template->render(array(
));

$content = ob_get_clean();

require('template.php');