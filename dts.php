<?php require_once 'classes.php';

  if (isset($_GET['task_id'])) {
    $taskId = $_GET['task_id']; 
    $userTask = new Task($conn);
    $task = $userTask->getTaskById($taskId); 
  } 
?> 


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Tâche</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
  
    <button class="back-button" id="back">
        <i class="fas fa-arrow-left"></i>
        Back to tasks
    </button>

    <div class="task-details-container">
        <div class="taskHeader">
            <div>
                <h1 class="taskTitle"><?php echo $task['title'] ?></h1>
                <span class="taskType"><?php echo $task['type'] ?></span>
            </div>
            <select class="status-selector" name="status" form="statusForm">
                <option value="<?php echo $task['status']; ?>"><?php echo $task['status']; ?></option>
                <option value="To Do">To Do</option>
                <option value="In Progress">In Progress</option>
                <option value="Done">Done</option>
            </select>
            <form id="statusForm" action="" method="POST">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <button type="submit" style="display:none;"></button>
            </form>

        </div>

        <div class="taskInfo">
            <div class="infoItem">
                <i class="far fa-user"></i>
                <div>
                    <span style="color: #999;">Assigne to</span>&nbsp;
                    <strong style="color: #555;"><?php echo $task['name'] ?></strong>
                </div>  
            </div>

            <div class="infoItem">
                <i class="far fa-calendar"></i>
                <div>
                    <span style="color: #999;">Create at </span>&nbsp;
                    <strong style="color: #555;"><?php echo date('Y-m-d', strtotime($task['created_at'])); ?></strong>
                </div>
            </div>
        </div>

        <div class="description-section">
            <h2 class="section-title">Description</h2>
            <div class="description-content">
              <p><?php echo $task['description'] ?></p>
            </div>
        </div>
    </div>

    <script>
            let back = document.getElementById('back');
            back.addEventListener('click',()=>{
              window.location.href='usertask.php';
            })
          let select = document.querySelector('.status-selector');
          let statusForm = document.getElementById('statusForm');
              select.addEventListener('change', ()=> {
                statusForm.submit();
              });
    </script>
</body>
</html>