<?php
require 'twigInit.php';

ob_start();

$template = $twig->loadTemplate('error404.twig');
echo $template->render(array(
));

$content = ob_get_clean();

require('template.php');