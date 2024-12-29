
<?php require_once 'classes.php';
  $userTask = new Task($conn);
  $userId = $_SESSION['userId'];
  $userName = $_SESSION['userName'];
  $tasks = $userTask->getTasksByUser($userId,$userName);

  $AllUsers = new users($conn);
  $users = $AllUsers->getUsers();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <title>Document</title>
</head>
<body>


  <div class="container">
        <header>
            <div class="header-left">
                <h1>Task Flow</h1>
            </div>
            <div class="header-right">
                <button class="user-btn" id="logout">Logout</button>
            </div>
        </header>

        <div class="search-section">
            <div class="search-container">
                <input type="search" placeholder="Search">
            </div>
            <button class="add-task-btn" id="btnAddTask">Add Task +</button>
        </div>
  <!-- ____________________________ Form Add Task ____________________________ -->
  <div class="formContainer" id="formContainer" style="display: none;">
      <form action="" method="POST">
          <i class="fa-solid fa-rectangle-xmark close closeF"></i>
          <h1 class="formTitle">Task Form</h1>
          
          <input type="text" class="input" name="title" placeholder="Title" required>
          
          <select name="taskType" class="input" required>
              <option value="" disabled>Task Type</option>
              <option value="basic">Basic</option>
              <option value="bug">Bug</option>
              <option value="feature">Feature</option>
          </select>

          <select name="assignedUser" class="input" required>
              <option value="" disabled >Assigne to </option>
              <?php foreach ($users as $user) : ?>
              <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
              <?php endforeach; ?>  
          </select>
          
          <textarea name="content" class="textarea" rows="6" placeholder="Write here task description" required></textarea>
          
          <button type="submit" name="add" class="addBtn">Add Task</button>
      </form>   
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
                                <a href='dts.php?task_id=<?php echo $task['id']; ?>' class="more-btn seeMore"><i class="fas fa-ellipsis-h"></i></a>
                            </div>
                            <h3><?php echo $task['title'] ?></h3>
                            <p><span class='statUser'>To do</span> </p>
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
                            <a href='dts.php?task_id=<?php echo $task['id']; ?>' class="more-btn seeMore"><i class="fas fa-ellipsis-h"></i></a>
                        </div>
                        <h3><?php echo $task['title'] ?></h3>
                        <p><span class='statUser'>In doing</span></p>
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
                            <a href='dts.php?task_id=<?php echo $task['id']; ?>' class="more-btn seeMore"><i class="fas fa-ellipsis-h"></i></a>
                        </div>
                        <h3><?php echo $task['title'] ?></h3>
                        <p><span class='statUser'>Complated</span> </p>
                    </div>
              
          <?php endif; 
          endforeach; ?>               
      </div>
      <!-- End Done Column _______________________________________________________________________________________________________________ -->
    </div> <!-- End tasks-grid -->  
</div>

<script>
    let logout = document.getElementById('logout');

        logout.addEventListener('click', function() {
            window.location.href = 'logout.php';
        });

    let btnAddTask = document.getElementById('btnAddTask');
    let formContainer = document.getElementById('formContainer');
    let closeAddForm = document.querySelector('.closeF');

        btnAddTask.addEventListener('click', () => {
            formContainer.style.display = "block";
        });

        closeAddForm.addEventListener('click', () => {
          formContainer.style.display = "none";
            });

    // let seeMore = document.querySelectorAll('.seeMore');
    // seeMore.forEach(btn =>{
    //     btn.addEventListener('click',()=>{
    //         window.location.href = 'dts.php';
    //     }) 
    // })
          
</script>
</body>
</html>