<?php
class User {
    private int $id;
    private string $Login;
    private string $Password;
    private string $FirstName;
    private string $LastName;

    public function __construct(string $Login, string $Password) {
        $this->Login = $Login;
        $this->Password = $Password;
        $this->FirstName = $FirstName = "";
        $this->LastName = $LastName = "";

    }

    public function register() {
        $PasswordHash = password_hash($this->Password, PASSWORD_ARGON2I);
        $q = "INSERT INTO userclass VALUES (NULL, ?, ?, ?, ?)";
        $db = new mysqli ('localhost', 'root', '', 'loginForm');
        $preparedQuery = $db->prepare($q);
        $preparedQuery->bind_param('ssss', $this->Login, $PasswordHash, $this->FirstName, $LastName);
    }
    
        
    
}
?>