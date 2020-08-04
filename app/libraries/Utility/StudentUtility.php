<?php

namespace App\libraries\Utility;

use App\Http\Helpers\CommonHelper;
use App\Models\Student;
use App\Models\StudentCourseInvitation;
use App\StudentClass;

/**
 * Class StudentUtility
 * @package App\libraries\Utility
 */
class StudentUtility
{
    public static function createStudent ($parameters)
    {
        $student = new Student();
        foreach ( $parameters as $key => $value ) {
            $student->$key = $value;
        }
        $student->save();

        return $student;
    }

    public static function removeStudentsFromClassroom ($students)
    {
        $token = CommonHelper::varify_Admintoken();
        foreach ( $students as $student ) {
            $courseInvitations = StudentCourseInvitation::where('student_email',$student->email)->get();

            foreach ($courseInvitations as $courseInvitation){
                CommonHelper::teacher_invitation_delete($token, $courseInvitation->invitation_code);
                $courseInvitation->delete();
            }

            $studentClasses = StudentClass::where('class_name', $student->class_name)->where('section_name', $student->section_name)->get();

            foreach ( $studentClasses as $studentClass ) {
                $inv_responce = CommonHelper::student_course_delete($token, $student->email, $studentClass->g_class_id);
            }

            $student->delete();
        }
    }

}