<?php
class User
{
    public $id;
    public $email;
    public $password;
    public $role;
    public $first_name;
    public $last_name;
    public $class_id;
    public $created_at;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->email = $data['email'] ?? null;
            $this->password = $data['password'] ?? null;
            $this->role = $data['role'] ?? null;
            $this->first_name = $data['first_name'] ?? null;
            $this->last_name = $data['last_name'] ?? null;
            $this->class_id = $data['class_id'] ?? null;
            $this->created_at = $data['created_at'] ?? null;
        }
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}
