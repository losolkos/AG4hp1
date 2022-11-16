<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
<form action="" method="post">
        <label for="loginID">Login:</label><br>
        <input type="text" name="Login" id="loginID"><br>
        <label for="passwordID">Hasło:</label><br>
        <input type="password" name="Password" id="passwordID"><br>
        <label for="firstNameID">Imię:</label><br>
        <input type="text" name="FirstName" id="firstNameID"><br>
        <label for="lastNameID">Nazwisko:</label><br>
        <input type="text" name="LastName" id="lastNameID"><br>
        <input type="submit" value="register">
    </form>
<?php
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    require_once('User.class.php');
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    if($user->register()) {
        echo "Zarejestrowano poprawnie";
    } else {
        echo "Błąd rejestracji użytkownika";
    }
}
?>  
    
</body>
</html>