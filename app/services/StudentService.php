<?php

require_once __DIR__ . '/../repositories/UserRepository.php';

class StudentService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function createStudent($email, $firstName, $lastName, $classId)
    {
        // Validate
        if (empty($email) || empty($firstName) || empty($lastName)) {
            return ['success' => false, 'message' => 'All fields are required'];
        }

        // Check if email already exists
        $existingUser = $this->userRepository->findByEmail($email);
        if ($existingUser) {
            return ['success' => false, 'message' => 'Email already exists'];
        }

        // Generate random password
        $randomPassword = $this->generateRandomPassword();
        $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);

        // Create student
        $studentId = $this->userRepository->create($email, $hashedPassword, 'student', $firstName, $lastName, $classId);

        return [
            'success' => true,
            'student_id' => $studentId,
            'password' => $randomPassword,
            'message' => 'Student created successfully'
        ];
    }

    public function getStudentsByClassId($classId)
    {
        return $this->userRepository->findByClassId($classId);
    }

    public function getAllStudents()
    {
        return $this->userRepository->findAllStudents();
    }

    private function generateRandomPassword($length = 8)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }
}
