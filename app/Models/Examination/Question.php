<?php

namespace App\Models\Examination;

use App\StudentSubject;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'ex_questions';

    public function subject ()
    {
        return $this->hasOne(StudentSubject::class, 'id', 'subject_id');
    }

    public function examinationQuestionMappings ()
    {
        return $this->hasMany(ExaminationQuestionMapping::class);
    }

    public function setOptionsAttribute ($value)
    {
        $this->attributes['options'] = json_encode($value);
    }

    public function getOptionsAttribute ($value)
    {
        return json_decode($value);
    }
}