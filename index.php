<?php

use Steampixel\Route;

require_once('class/User.class.php');
require_once('config.php');

Route::add('/', function() {
    echo "strona Główna";
} );

Route::add('/login', function() {
    //echo "strona logowaia"
    global $twig;
    if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        require_once('User.class.php');
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        if($user->login()) {
            echo "zalogowano poprawnie";
        } else{
            echo "błędny login lub hasło";
        }
    $twig->display('login.html.twig');
} );

Route::add('/register', function(){
    //echo "strona rejestracji"
    global $twig;
    $twig->display('register.html.twig');
});


Route::run('/AG4HP');

?>