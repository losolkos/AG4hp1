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

    }
    
        
    
}
?>