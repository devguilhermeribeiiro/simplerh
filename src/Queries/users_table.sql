CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(11) UNIQUE NOT NULL,
    position VARCHAR(50) NOT NULL,
    department VARCHAR(50) NOT NULL,
    role ENUM('admin', 'human resources', 'employee') NOT NULL DEFAULT 'employee',
    ec VARCHAR(8) UNIQUE NOT NULL COMMENT 'Employee code'
);
