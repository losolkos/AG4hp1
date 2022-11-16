<?php
require_once('User.class.php');

$user = new User('jkowalski', 'tajneHasło');
$user->register();

echo '<pre>';
var_dump($user);
?>