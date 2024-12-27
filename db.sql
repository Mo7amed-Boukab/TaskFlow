CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE tasks (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    type ENUM('basic', 'bug', 'feature') NOT NULL,
    description VARCHAR(255),
    assigned_to INT(11) NOT NULL,
    status ENUM('To Do', 'In Progress', 'Done') DEFAULT 'To Do',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);