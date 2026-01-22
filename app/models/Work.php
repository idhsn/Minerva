<?php

class Work
{
    public $id;
    public $title;
    public $description;
    public $class_id;
    public $teacher_id;
    public $created_at;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->class_id = $data['class_id'] ?? null;
            $this->teacher_id = $data['teacher_id'] ?? null;
            $this->created_at = $data['created_at'] ?? null;
        }
    }
}
