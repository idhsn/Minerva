-- Minerva Educational Management System Database Schema

-- Create Users Table (Base Class)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    role ENUM('student', 'teacher') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    INDEX idx_email (email)
);

-- Create Teachers Table (Extends Users)
CREATE TABLE teachers (
    teacher_id INT PRIMARY KEY,
    department VARCHAR(100),
    hire_date DATE,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create Classes Table
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    subject VARCHAR(100),
    description TEXT,
    academic_year VARCHAR(20),
    teacher_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    join_code VARCHAR(20) UNIQUE NOT NULL,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id) ON DELETE CASCADE,
    INDEX idx_join_code (join_code)
);

-- Create Students Table (Extends Users, Enrolled in Class)
-- Note: Assuming a student belongs to one main class/cohort as per requirements (Class 1 -> 1.. Student)
CREATE TABLE students (
    student_id INT PRIMARY KEY,
    enrollment_date DATE DEFAULT (CURRENT_DATE),
    class_id INT,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE SET NULL
);

-- Create Assignments Table
CREATE TABLE assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    instructions TEXT,
    deadline DATETIME,
    max_score FLOAT DEFAULT 100.0,
    type ENUM('document', 'lesson', 'exercise', 'quiz') NOT NULL,
    teacher_id INT NOT NULL,
    class_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    attachment_path VARCHAR(255),
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE
);

-- Create Submissions Table
CREATE TABLE submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    assignment_id INT NOT NULL,
    student_id INT NOT NULL,
    submitted_text TEXT,
    attachment_path VARCHAR(255),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('draft', 'submitted', 'late') DEFAULT 'draft',
    FOREIGN KEY (assignment_id) REFERENCES assignments(id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
);

-- Create Grades Table
CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    submission_id INT NOT NULL UNIQUE,
    score FLOAT,
    max_score FLOAT DEFAULT 100.0,
    feedback TEXT,
    graded_by INT NOT NULL,
    graded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_published BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (submission_id) REFERENCES submissions(id) ON DELETE CASCADE,
    FOREIGN KEY (graded_by) REFERENCES teachers(teacher_id) ON DELETE CASCADE
);

-- Create Attendance Table
CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    class_id INT NOT NULL,
    date DATE NOT NULL,
    status ENUM('present', 'absent', 'late', 'excused') NOT NULL,
    recorded_by INT NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
    FOREIGN KEY (recorded_by) REFERENCES teachers(teacher_id) ON DELETE CASCADE,
    UNIQUE KEY unique_attendance (student_id, class_id, date)
);

-- Create ChatMessages Table
CREATE TABLE chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    attachment_path VARCHAR(255),
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_edited BOOLEAN DEFAULT FALSE,
    edited_at TIMESTAMP NULL,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
