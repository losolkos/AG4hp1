<?php
require_once('User.class.php');

$user = new User('jkowalski', 'tajneHasło');

echo '<pre>';
var_dump($user);
?>