<?php

class ClassModel
{
    public $id;
    public $name;
    public $teacher_id;
    public $created_at;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->teacher_id = $data['teacher_id'] ?? null;
            $this->created_at = $data['created_at'] ?? null;
        }
    }
}
