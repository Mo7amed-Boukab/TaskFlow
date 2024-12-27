<?php require_once 'classes.php';?>
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
<div class='alert error'></div>
<div class="formContainer" id="loginUser" style="display: none;">
    <form action="" method="POST">
        <i class="fa-solid fa-rectangle-xmark close closeU"></i>
        <h1 class="formTitle">Login User</h1>
        
        <input type="text" class="input" name="name" placeholder="name" required>

        <button type="submit" name="login" class="addBtn">Login</button>
    </form>   
</div>

<div class="formContainer" id="formContainer" style="display: none;">
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
</div>
      
    <div class="container">
        <header>
            <div class="header-left">
                <h1>Task Flow</h1>
            </div>
            <div class="header-right">
                <button class="user-btn" id="btnUsers">users</button>
            </div>
        </header>

        <div class="search-section">
            <div class="search-container">
                <input type="search" placeholder="Search">
            </div>
            <button class="add-task-btn" id="btnAddTask">Add Task +</button>
        </div>

        <div class="tasks-grid">
            <!-- To Do Column -->
            <div class="task-column">
                <h2>To do</h2>
                    <div class="task-card">
                        <div class="task-header">
                            <div class="task-type">
                                <span class="dot"></span>
                                <span>TYPE OF TACHE</span>
                            </div>
                            <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                        <h3>Tache Title</h3>
                        <p>User assigne</p>
                    </div>
                
            </div>

            <!-- In Progress Column -->
            <div class="task-column">
                <h2>In progress</h2>
                <!-- Task cards -->
                <div class="task-card">
                    <div class="task-header">
                        <div class="task-type">
                            <span class="dot"></span>
                            <span>TYPE OF TACHE</span>
                        </div>
                        <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                    </div>
                    <h3>Tache Title</h3>
                    <p>User assigne</p>
                </div>
                <div class="task-card">
                        <div class="task-header">
                            <div class="task-type">
                                <span class="dot"></span>
                                <span>TYPE OF TACHE</span>
                            </div>
                            <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                        <h3>Tache Title</h3>
                        <p>User assigne</p>
                    </div>
                    
            </div>

            <!-- Done Column -->
            <div class="task-column">
                <h2>Done</h2>
                <!-- Task cards -->
                <div class="task-card">
                        <div class="task-header">
                            <div class="task-type">
                                <span class="dot"></span>
                                <span>TYPE OF TACHE</span>
                            </div>
                            <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                        <h3>Tache Title</h3>
                        <p>User assigne</p>
                    </div>
                  
            </div>
        </div>
    </div>

    <script>
            let btnAddTask = document.getElementById('btnAddTask');
            let formContainer = document.getElementById('formContainer');
            let closeAddForm = document.querySelector('.closeF');
            let closeUsersForm = document.querySelector('.closeU');

            btnAddTask.addEventListener('click', () => {
              console.log('clicked');
              formContainer.style.display = "block";
          });

          let btnUsers = document.getElementById('btnUsers');
          let loginUser = document.getElementById('loginUser');

          btnUsers.addEventListener('click', () => {
              loginUser.style.display = "block";
          });

          closeUsersForm.addEventListener('click', () => {
            loginUser.style.display = "none";
              });
          closeAddForm.addEventListener('click', () => {
            formContainer.style.display = "none";
              });


    </script>
</body>
</html>