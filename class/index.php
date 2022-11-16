<?php
require_once('User.class.php');

$user = new User('jkowalski', 'tajnehasło');
if($user->register()){
    echo "zarajestrowano poprawnie";
} else {
    echo "błąd rejestracji użytkownika"
}

if($user->login()){
    echo "zalogowano poprawnie";
} else {
    echo "błędny login lub hasło";
}

?>