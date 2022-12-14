<?php
class User {
    private int $ID;
    private mysqli $db;
    private string $Login;
    private string $Password;
    private string $FirstName;
    private string $LastName;
    
    
    public function __construct(string $Login, string $Password) {
        $this->Login = $Login;
        $this->Password = $Password;
        $this->FirstName = "";
        $this->LastName = "";
        global $db;
        $this->db = &$db;
    }
    
    
    public function __serialize() : array {
        return array(   
                        'ID' => $this->ID,
                        'Login' => $this->Login,
                        'Password' => $this->Password,
                        'FirstName' => $this->FirstName,
                        'LastName' => $this->LastName,
                    );
    }
    public function __unserialize(array $data) {
        $this->ID = $data['ID'];
        $this->Login = $data['Login'];
        $this->Password = $data['Password'];
        $this->FirstName = $data['FirstName'];
        $this->LastName = $data['LastName'];
        global $db;
        $this->db = &$db;
    } 


    public function register() : bool {
        $PasswordHash = password_hash($this->Password, PASSWORD_ARGON2I);
        $q = "INSERT INTO userclass VALUES (NULL, ?, ?, ?, ?)";
        $db = new mysqli ('localhost', 'root', '', 'loginform');
        $preparedQuery = $db->prepare($q);
        $preparedQuery->bind_param('ssss', $this->Login, $PasswordHash, $this->FirstName, $this->LastName);
        $result = $preparedQuery->execute();
        return $result;
    }

    public function Login() : bool {
       $query = "SELECT * FROM userclass WHERE login = ? LIMIT 1";
       $db = new mysqli ('localhost', 'root', '', 'loginform');
       $preparedQuery = $db->prepare($query);
       $preparedQuery->bind_param('s', $this->Login);
       $preparedQuery->execute();
       $result = $preparedQuery->get_result();
       if($result->num_rows ==1) {
        $row = $result->fetch_assoc();
        $PasswordHash = $row['Password'];
        if(password_verify($this->Password, $PasswordHash)){
            $this->ID = $row['ID'];
            $this->FirstName = $row['FirstName'];
            $this->LastName = $row['LastName'];
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
      return $this->FirstName . " " .  $this->LastName;
    }

    public function save() : bool {
        $q = "UBDATE user SET
        FirstName = ?,
        LastName = ?
        WHERE ID = ?";
    $preparedQuery = $this->db->prepare($q);
    $preparedQuery->bind_param("ssi", $this->FirstName,$this->LastName, $this->ID);
    return $preparedQuery->execute();


    }
    
        
    
}
?>