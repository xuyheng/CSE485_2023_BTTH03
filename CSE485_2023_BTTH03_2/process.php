<?php
require_once 'vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.twig', array('thuyhang' => 'hahaa'));
?>