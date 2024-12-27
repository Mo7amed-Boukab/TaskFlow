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
    <button class="back-button">
        <i class="fas fa-arrow-left"></i>
        Back to tasks
    </button>

    <div class="task-details-container">
        <div class="taskHeader">
            <div>
                <h1 class="taskTitle">Title of the task</h1>
                <span class="taskType basic">Basic</span>
            </div>
            <select class="status-selector">
                <option value="todo">To do</option>
                <option value="in-progress">In doing </option>
                <option value="done">Completed</option>
            </select>
        </div>

        <div class="taskInfo">
            <div class="info-item">
                <i class="far fa-user"></i>
                <div>
                    <span style="color: #999;">Assigne to</span>&nbsp;
                    <strong style="color: #555;">Mohamed</strong>
                </div>  
            </div>

            <div class="infoItem">
                <i class="far fa-calendar"></i>
                <div>
                    <span style="color: #999;">Create at </span>&nbsp;
                    <strong style="color: #555;">25, Dec 2024</strong>
                </div>
            </div>
        </div>

        <div class="description-section">
            <h2 class="section-title">Description</h2>
            <div class="description-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <br>
                <p>Points clés :</p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Consectetur adipiscing elit.</li>
                    <li>Sed do eiusmod tempor incididunt.</li>
                </ul>
            </div>
        </div>
    </div>

    
</body>
</html>