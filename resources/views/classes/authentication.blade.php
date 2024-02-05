 <?php
class Authentication{
    private $connection;
    public $name = null;
    public $username = null;
    public $table = 'users';

    public function __construct($database){
        $this->connection = $database;
    }

    public function login($request){
        $username = $this->validate($request['username']);
        // $password = password_hash($this->validate($request['password']), PASSWORD_BCRYPT);
        $password = $this->validate($request['password']);

        $querystring = "SELECT * FROM $this->table WHERE username = '{$username}'";
        $statement = $this->connection->query($querystring);
        $credentials = $statement->fetch();

        if(password_verify($password, $credentials['password'])){
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $request['username'];
            $_SESSION['password'] = $request['password'];
            header('refresh:3; url=index.php');
            return 'Successfully logged in';
        }else{
            return "You provided wrong credentials!";
        }
        
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('refresh:1; url=login.php');
    }

    public function checkloggedin($page){
        session_start();
        if(empty($_SESSION['loggedIn'])){
            header('url=login.php');
        }else{
            if($page == 'login.php'){
                header("refresh:0;url=index.php");
            }
        }
        // return $_SESSION['loggedIn'];
    }

    public function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>