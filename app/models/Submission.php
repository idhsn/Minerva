<?php

class Submission
{
    public $id;
    public $work_id;
    public $student_id;
    public $content;
    public $file_path;
    public $grade;
    public $comment;
    public $submitted_at;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->work_id = $data['work_id'] ?? null;
            $this->student_id = $data['student_id'] ?? null;
            $this->content = $data['content'] ?? null;
            $this->file_path = $data['file_path'] ?? null;
            $this->grade = $data['grade'] ?? null;
            $this->comment = $data['comment'] ?? null;
            $this->submitted_at = $data['submitted_at'] ?? null;
        }
    }

    public function isGraded()
    {
        return $this->grade !== null;
    }
}