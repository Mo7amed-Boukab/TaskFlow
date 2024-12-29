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
// ------------------------ Start connection with database -----------------------
$db = new Database();
$conn = $db->get_connection();
// --------------------------------- Register ------------------------------------
if(isset($_POST['register'])){
  $nameNewUser = $_POST['username'];
  $user = new Users($conn);
  $user->addUser($nameNewUser);
}
// --------------------------------- Login user -----------------------------------
session_start();
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
            $sql = "SELECT 
                          t.id, t.type, t.title, t.status, t.assigned_to, u.id, u.name
                    FROM 
                          tasks  AS t
                    LEFT JOIN 
                          users AS u
                    ON 
                          t.assigned_to = u.id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        }
      public function getTasksByUser($userId,$username) {
            $sql = "SELECT 
                        t.id, t.type, t.title, t.status, t.assigned_to, u.name 
                    FROM 
                        tasks AS t
                    LEFT JOIN 
                        users AS u
                    ON 
                        t.assigned_to = u.id
                    WHERE 
                        t.assigned_to = ?
                        AND 
                        u.name = ?
                    ";
        
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(1, $userId, PDO::PARAM_INT);
            $stmt->bindValue(2, $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

      public function getTaskById($taskId) {
            $sql = "SELECT 
                        t.id, t.type, t.title, t.status, t.description, t.created_at, u.name
                    FROM 
                        tasks AS t
                    LEFT JOIN 
                        users AS u
                    ON 
                        t.assigned_to = u.id
                    WHERE 
                        t.id = ?";
        
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(1, $taskId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }
      public function updateTaskStatus($taskId, $newStatus) {
            $sql = "UPDATE tasks SET status = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(1, $newStatus, PDO::PARAM_STR);
            $stmt->bindValue(2, $taskId, PDO::PARAM_INT);
            return $stmt->execute();
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
};

// -------------------------------------- Add new Task -----------------------------------

if(isset($_POST['add'])){
  $taskTitle = $_POST['title'];
  $taskDescription = $_POST['content'];
  $assignedTo = $_POST['assignedUser'];
  $taskType = $_POST['taskType'];
  if($taskType === 'basic'){
    $task = new BasicTask($conn);
    $task->addTask($taskTitle, $assignedTo, $taskDescription );
  }
  elseif($taskType === 'bug'){
    $task = new BugTask($conn);
    $task->addTask($taskTitle, $assignedTo, $taskDescription );
  }
  else{
    $task = new FeatureTask($conn);
    $task->addTask($taskTitle, $assignedTo, $taskDescription );
  }

}
// ------------------------------------- Update status -----------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['status'])) {
  $taskId = $_POST['task_id'];
  $newStatus = $_POST['status'];

  $userTask = new Task($conn);
  $updateResult = $userTask->updateTaskStatus($taskId, $newStatus);

  if ($updateResult) {
      header("Location: dts.php?task_id=" . $taskId);
      exit();
  }
}
