<?php require_once 'classes.php';
      $allTasks = new Task($conn);
      $tasks = $allTasks->getTasks();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <title>Task Flow</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- ____________________________ Login ____________________________ -->
  <div class="formContainer" id="loginUser" style="display: none;">
      <form action="" method="POST">
          <i class="fa-solid fa-rectangle-xmark close closeL"></i>
          <h1 class="formTitle">Login User</h1>
          
          <input type="text" class="input" name="name" placeholder="name" required>

          <button type="submit" name="login" class="addBtn">Login</button>
      </form>   
  </div>
  <!-- ____________________________ Register ____________________________ -->
  <div class="formContainer" id="registerUser" style="display: none;">
      <form action="" method="POST">
          <i class="fa-solid fa-rectangle-xmark close closeR"></i>
          <h1 class="formTitle">Register</h1>
          
          <input type="text" class="input" name="username" placeholder="name" required>

          <button type="submit" name="register" class="addBtn register" >Register</button>
      </form>   
  </div>
  <!-- ____________________________ Form Add Task ____________________________ -->
  <!-- <div class="formContainer" id="formContainer" style="display: none;">
      <form action="" method="POST">
          <i class="fa-solid fa-rectangle-xmark close closeF"></i>
          <h1 class="formTitle">Task Form</h1>
          
          <input type="text" class="input" name="title" placeholder="Title" required>
          
          <select name="taskType" class="input" required>
              <option value="">Task Type</option>
              <option value="basic">Basic</option>
              <option value="bug">Bug</option>
              <option value="feature">Feature</option>
          </select>

          <select name="assignedUser" class="input" required>
              <option value="">Assigne to </option>
              <option value="user1">mohamed</option>
              <option value="user2">salah</option>
          </select>
          
          <textarea name="content" class="textarea" rows="6" placeholder="Write here task description" required></textarea>
          
          <button type="submit" name="add" class="addBtn">Add Task</button>
      </form>   
  </div> -->
      
  <div class="container">
        <header>
            <div class="header-left">
                <h1>Task Flow</h1>
            </div>
            <div class="header-right">
                <button class="user-btn" id="btnLogin">Login</button>
            </div>
        </header>

        <div class="search-section">
            <div class="search-container">
                <input type="search" placeholder="Search">
            </div>
            <button class="add-task-btn" id="btnAddUser">Add User +</button>
        </div>

      <div class="tasks-grid">

            <div class="task-column">
              <h2>To Do</h2>
                <?php foreach ($tasks as $task):
                  if ($task['status'] === 'To Do'): ?>
                  
                              <div class="task-card">
                                  <div class="task-header">
                                      <div class="task-type">
                                        <?php if ($task['type'] === 'Basic'): ?>
                                          <span class="dot yellow"></span>
                                          <span><?php echo $task['type']?></span>
                                        <?php elseif ($task['type'] === 'Bug'): ?>
                                          <span class="dot red"></span>
                                          <span><?php echo $task['type']?></span>
                                        <?php elseif ($task['type'] === 'Feature'): ?>
                                          <span class="dot green"></span>
                                          <span><?php echo $task['type']?></span>
                                        <?php endif; ?>
                                      </div>
                                      <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                                  </div>
                                  <h3><?php echo $task['title'] ?></h3>
                                  <p><span class='assignedto'>Assigned to :</span> <?php echo $task['name'] ?></p>
                              </div>
                    
                <?php endif; 
                endforeach; ?> 
            </div> 
             <!-- End To Do Column________________________________________________________________________________________________________________ -->        
            <div class="task-column">
                <h2>In Progress</h2>  
                <?php foreach ($tasks as $task):
                    if ($task['status'] === 'In Progress'): ?>
                              
                          <div class="task-card">
                              <div class="task-header">
                                  <div class="task-type">
                                    <?php if ($task['type'] === 'Basic'): ?>
                                      <span class="dot yellow"></span>
                                      <span><?php echo $task['type']?></span>
                                    <?php elseif ($task['type'] === 'Bug'): ?>
                                      <span class="dot red"></span>
                                      <span><?php echo $task['type']?></span>
                                    <?php elseif ($task['type'] === 'Feature'): ?>
                                      <span class="dot green"></span>
                                      <span><?php echo $task['type']?></span>
                                    <?php endif; ?>
                                  </div>
                                  <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                              </div>
                              <h3><?php echo $task['title'] ?></h3>
                              <p><span class='assignedto'>Assigned to :</span> <?php echo $task['name'] ?></p>
                          </div>
                  
                <?php endif; 
                endforeach; ?>  
              
            </div>
            <!-- End In Progress Column _______________________________________________________________________________________________________________ -->
            <div class="task-column">
                <h2>Done</h2>
                <?php foreach ($tasks as $task):
                  if ($task['status'] === 'Done'): ?>

                          <div class="task-card">
                              <div class="task-header">
                                  <div class="task-type">
                                    <?php if ($task['type'] === 'Basic'): ?>
                                      <span class="dot yellow"></span>
                                      <span><?php echo $task['type']?></span>
                                    <?php elseif ($task['type'] === 'Bug'): ?>
                                      <span class="dot red"></span>
                                      <span><?php echo $task['type']?></span>
                                    <?php elseif ($task['type'] === 'Feature'): ?>
                                      <span class="dot green"></span>
                                      <span><?php echo $task['type']?></span>
                                    <?php endif; ?>
                                  </div>
                                  <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                              </div>
                              <h3><?php echo $task['title'] ?></h3>
                              <p><span class='assignedto'>Assigned to :</span> <?php echo $task['name'] ?></p>
                          </div>
                    
                <?php endif; 
                endforeach; ?>               
            </div>
            <!-- End Done Column _______________________________________________________________________________________________________________ -->
      </div> <!-- End tasks-grid -->
  </div>

    <script>
          let btnAddUser = document.getElementById('btnAddUser');
          let registerUser = document.getElementById('registerUser');

            btnAddUser.addEventListener('click', () => {
              console.log('clicked');
              
              registerUser.style.display = "block";
            });

          let closeRegisterForm = document.querySelector('.closeR');
              closeRegisterForm.addEventListener('click', () => {
                  registerUser.style.display = "none";
              });

          let btnLogin = document.getElementById('btnLogin');
          let loginUser = document.getElementById('loginUser');

              btnLogin.addEventListener('click', () => {
                console.log('clicked');
                  loginUser.style.display = "block";
              });
          let closeLoginForm = document.querySelector('.closeL');
              closeLoginForm.addEventListener('click', () => {
                  loginUser.style.display = "none";
              });
      

    </script>
</body>
</html>