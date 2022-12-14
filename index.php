<?php

use Steampixel\Route;

require_once('config.php');
require_once('class/User.class.php');

session_start();

Route::add('/', function () {
    global $twig;
    $v = array();
    if(isset($_SESSION['auth']))
       if($_SESSION['auth']) {
        $user = $_SESSION['user'];
        $v['user'] = $user;
       }
       $twig->display('home.html.twig', $v);

});

Route::add('/login', function () {
    global $twig;
    $twig->display('login.html.twig');
});

Route::add('/login', function () {
    global $twig;
    if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        if ($user->login()) {
            $_SESSION['auth']=true;
            $_SESSION['user']=$user;
            $v = array(
                'message' => "Zalogowano poprawnie użytkownika: " . $user->getName(),
            );
            $twig->display('message.html.twig', $v);
        } else {
            $twig->display(
                'login.html.twig',
                ['message' => "Błędny login lub hasło"]
            );
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');

Route::add('/register', function () {
    global $twig;
    $twig->display('register.html.twig');
});
Route::add('/register', function () {
    global $twig;
    if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        if (
            empty($_REQUEST['login']) || empty($_REQUEST['password'])
            || empty($_REQUEST['FirstName']) || empty($_REQUEST['lastName'])
        ) {
            $twig->display(
                'register.html.twig',
                ['message' => "Nie podano wymaganej wartości"]
            );
            exit();
        }
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        $user->setFirstName($_REQUEST['FirstName']);
        $user->setLastName($_REQUEST['lastName']);
        if ($user->register()) {
            $twig->display(
                'message.html.twig',
                ['message' => "Zarejestrowano poprawnie"]
            );
        } else {
            $twig->display(
                'register.html.twig',
                ['message' => "Błąd rejestracji użytkownika"]
            );
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');

Route::add('/logout', function() {
   global $twig;
   session_destroy();
   $twig->display('message.html.twig',['message' => "wylogowano poprawnie"]);

});

Route::add('/profile', function() {
    global $twig;
    $user = $_SESSION['user'];
    $fullName = $user->getName();
    $fullName = explode(" ", $fullName);
    $v = array('user' => $user, 'FristName' => $fullName[0], 'LastName' => $fullName[1]);
    $twig->display('profile.html.twig', $v);

});

Route::add('/profile', function() {
    global $twig;
    if(isset($_REQUEST['FirstName']) && isset($_REQUEST['LastName'])) {
        $user = $_SESSION['user'];
        $user->setFirstName($_REQUEST['FirstName']);
        $user->setLastName($_REQUEST['LastName']);
        $user->save();
        $twig->display('message.html.twig', 
        ['message' => "Zapisano zmiany w profilu"]);

    }
    if (isset($_REQUEST['Password']) && isset($_REQUEST['passwordRepeat'])) {
        $Password = $_REQUEST['Password'];
        $passwordRepeat = $_REQUEST['passwordRepeat'];
        if($Password == $passwordRepeat) {
            $user = $_SESSION['user'];
            if($user->changePassword($Password)) {
                $twig->display('message.html.twig', ['message' => "Hasło zostało zmienione"]);
            } else{
                $twig->display('message.html.twig', ['message' => "padane hasła nie są zgodne"]);
            }
        
        }else{
            $twig->display('message.html.twig', ['message' => " Podane hasła nie są zgodne"]);
        }

    }


}, "post");

Route::run('/AG4HP');
?>