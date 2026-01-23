# Minerva

Minerva is a comprehensive academic management platform built with PHP. It follows a custom MVC (Model-View-Controller) architecture to provide a structured and scalable solution for managing classes, assignments, and communication between teachers and students.

## Key Features

-   **Dual-Role System**: Separate, feature-rich dashboards and functionalities for teachers and students.
-   **Teacher-Specific Features**:
    -   **Class Management**: Create and manage multiple classes.
    -   **Student Enrollment**: Add students to classes. The system automatically generates credentials and sends a welcome email to the new student.
    -   **Assignment Workflow**: Create, assign, update, and delete assignments, with support for file attachments.
    -   **Submission Review**: View and evaluate student submissions.
    -   **Class Communication**: Engage in real-time chat with students in dedicated, class-specific channels.
-   **Student-Specific Features**:
    -   **Dashboard Overview**: Get a quick glance at upcoming assignments and enrolled classes.
    -   **Assignment Submission**: Submit assignments easily with text content and file uploads.
    -   **Class Interaction**: Participate in class discussions through the integrated chat feature.
    -   **Track Progress**: View grades and feedback from teachers on submitted work.

## Technology Stack

-   **Backend**: PHP
-   **Database**: MySQL
-   **Frontend**: HTML, CSS, Font Awesome
-   **Architecture**: Custom Model-View-Controller (MVC)
-   **Web Server**: Apache (with `mod_rewrite` enabled)

## Project Structure

The project is organized using an MVC pattern to ensure a clean separation of concerns:

-   **/app/controllers**: Handles user requests, processes input, and orchestrates business logic.
-   **/app/models**: Manages data structures and interacts directly with the database.
-   **/app/views**: Contains the UI and presentation logic (HTML templates with embedded PHP).
-   **/app/services**: Encapsulates specific business rules and services (e.g., mail sending, authentication logic).
-   **/app/core**: The core components of the custom MVC framework, including the Router, base Controller, and base Model.
-   **/config**: Contains application settings, database credentials (`config.php`), and URL routes (`routes.php`).
-   **/public**: The web server's document root, containing the main entry point (`index.php`), assets (CSS, images), and directories for user uploads.

## Setup and Installation

Follow these steps to set up the Minerva platform on your local environment.

### 1. Clone the Repository

```bash
git clone https://github.com/idhsn/Minerva.git
cd Minerva
```

### 2. Database Setup

1.  Create a MySQL database for the project. For example, `minerva`.
    ```sql
    CREATE DATABASE minerva;
    ```
2.  Import the following SQL schema into your newly created database. This will set up the necessary tables and relationships.

    ```sql
    CREATE TABLE `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `role` enum('teacher','student') NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE `classes` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `teacher_id` int(11) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `teacher_id` (`teacher_id`),
      CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE `class_students` (
      `class_id` int(11) NOT NULL,
      `student_id` int(11) NOT NULL,
      PRIMARY KEY (`class_id`,`student_id`),
      KEY `student_id` (`student_id`),
      CONSTRAINT `class_students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
      CONSTRAINT `class_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE `assignments` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `class_id` int(11) NOT NULL,
      `teacher_id` int(11) NOT NULL,
      `title` varchar(255) NOT NULL,
      `description` text DEFAULT NULL,
      `file_path` varchar(255) DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `class_id` (`class_id`),
      KEY `teacher_id` (`teacher_id`),
      CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
      CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE `submissions` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `assignment_id` int(11) NOT NULL,
      `student_id` int(11) NOT NULL,
      `content` text DEFAULT NULL,
      `file_path` varchar(255) DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `assignment_id` (`assignment_id`),
      KEY `student_id` (`student_id`),
      CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
      CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE `chat_messages` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `class_id` int(11) NOT NULL,
      `sender_id` int(11) NOT NULL,
      `message` text NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `class_id` (`class_id`),
      KEY `sender_id` (`sender_id`),
      CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
      CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ```

### 3. Application Configuration

Open the `config/config.php` file and update the database connection details (`dsn`, `user`, `pass`) to match your local environment.

```php
// config/config.php
return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=minerva;charset=utf8mb4',
        'user' => 'root', // Your database user
        'pass' => '',     // Your database password
        'options' => [
            // ...
        ]
    ]
];
```

### 4. Web Server Configuration

-   Configure your Apache web server to use the `public/` directory as the document root for your project domain.
-   Ensure that Apache's `mod_rewrite` module is enabled. The `.htaccess` file in the root directory will automatically route all requests to the `public/index.php` front controller.

### 5. Access the Application

Navigate to your project's local domain in your web browser. You can begin by registering a new "Enseignant" (Teacher) account to start creating classes.
