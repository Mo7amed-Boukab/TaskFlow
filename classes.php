<?php

// ------------------------- Class of database connection ----------------------------
class Database {
  private $dsn = "mysql:host=localhost;dbname=taskflow";
  private $user = "root";
  private $pass = "";

  public function connect() {
      try {
          $pdo = new PDO($this->dsn, $this->user, $this->pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
          echo "You are connect";
          return $pdo;
      } catch (PDOException $e) {
          die("Connexion failed: " . $e->getMessage());
      }
  }
  public function get_connection() {
      return $this->connect();
  }
}

// --------------------------------- Class of users ----------------------------------
class Users{
  private $connection;
  public function __construct($conn) {
      $this->connection = $conn;
  }

  public function addUser($name) {
      $sql = "INSERT INTO users (name) VALUES (:name) ";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute(['name' => $name]);
      return $stmt;
  }
  public function getUsers() {
      $sql = "SELECT * FROM users";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
  }
  public function loginUser($name) {
        try {
            $sql = "SELECT id, name FROM users WHERE name = :name";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['name' => $name]);
            
            if($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                return [
                    'verify' => true,
                    'message' => "Bienvenue " . $user['name'],
                    'user_id' => $user['id']
                ];
            } else {
                return [
                    'verify' => false,
                    'message' => "This user is not found"
                ];
            }
            
        } catch(Exception $e) {
            return [
                'message' => "Error: " . $e->getMessage()
            ];
        }
  }
}

// --------------------------------- Insert users ----------------------------------
// $user = new Users($conn);
// $user->addUser('mohamed');
// $user->addUser('omar');
// $user->addUser('souhail');

// --------------------------------- Login user -----------------------------------

session_start();

$db = new Database();
$conn = $db->get_connection();

$message = '';

if(isset($_POST['login'])) {
  $user = new Users($conn);
  $result = $user->loginUser($_POST['name']);
  
  if($result['verify']) {
      $_SESSION['userId'] = $result['user_id'];
      $_SESSION['userName'] = $_POST['name'];
      header('Location: usertask.php');
  } 
  else {
      echo $message = $result['message'];
  }
}

// --------------------------------- Class of tasks ----------------------------------
class Task {
  private $connection;
  protected $taskType;

  public function __construct($conn){
      $this->connection = $conn;
  }

  public function addTask($title, $assigned_to, $description) {
    try {
        $checkUser = "SELECT id FROM users WHERE id = :assigned_to";
        $stmt = $this->connection->prepare($checkUser);
        $stmt->execute(['assigned_to' => $assigned_to]); 
        
        if ($stmt->rowCount() == 0) {
            throw new Exception("user assigned not found");
        }
        $sql = "INSERT INTO tasks (title,type, assigned_to, description, created_at) 
                VALUES (:title,:type, :assigned_to, :description, NOW())";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'type' => $this->taskType,
            'assigned_to' => $assigned_to,    
            'description' => $description
        ]);

        return true;

    } catch (Exception $e) {
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}
  public function getTasks() {
      $sql = "SELECT * FROM tasks";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
  }
}


// --------------------------------- Classes tasks by types ----------------------------------

class BasicTask extends Task {
  protected $taskType = 'Basic';

}

class BugTask extends Task {
  protected $taskType = 'Bug';
}

class FeatureTask extends Task {
  protected $taskType = 'Feature';
}

// ------------------ Insert tasks by class of the type of task that we want ---------------------

// $task1 = new BasicTask($conn);
// $task1->addTask('task 1 basic', 40, 'Lorem ipsum dolor sit amet consectetur adipisicing elit.');

// $task2 = new BugTask($conn);
// $task2->addTask('task 2 bug', 41, 'Lorem ipsum dolor sit amet consectetur adipisicing elit.');

// $task3 = new FeatureTask($conn);
// $task3->addTask('task 3 feature', 42, 'Lorem ipsum dolor sit amet consectetur adipisicing elit.');





