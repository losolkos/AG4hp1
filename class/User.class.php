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
        $db = new mysqli ('localhost', 'root', '', 'loginform');
        $preparedQuery = $db->prepare($q);
        $preparedQuery->bind_param('ssss', $this->Login, $PasswordHash, $this->FirstName, $LastName);
    }

    public function Login() {
       $query = "SELECT * FROM userclass WHERE login = ? LIMIT 1";
       $db = new mysqli ('localhost', 'root', '', 'loginform');
       $preparedQuery = $db->prepare($query);
       $preparedQuery->bind_param('s', $this->Login);
       $preparedQuery->execute();
       $result = $preparedQuery->get_result();
       if($result->num_rows ==1) {
        $row = $result->fetch_assoc();
        $PasswordHash = $row['password'];
        if(password_verify($this->password, $PasswordHash)){
            $this->id = $row['id'];
            $this->FirstName = $row['firstName'];
            $this->LastName = $row['lastName'];
            return true; 
        }
        else{
            return false;
        }

       }
       else{
        return false;
       }
    }
    public function setFirstName(string $FirstName){
        $this->FirstName = $FirstName;
    }
    public function setLastName(string $LastName){
        $this->LastName = $LastName;
    }
    public function getName() : string{
      return $this->FirstName . " " .  $this->lastName;
    }
    
        
    
}
?>