<?php

namespace App\libraries\Utility;

use App\ClassWork;
use App\StudentClass;

/**
 * Class ReportUtility
 * @package App\libraries\Utility
 */
class ReportUtility
{
    /**
     * @param $teacherId
     * @return array
     */
    public static function getAssignmentSubmissionGrades ($teacherId)
    {
        $classWorks = ClassWork::with('studentClass', 'studentClass.dateClass')
            ->whereHas('studentClass.dateClass', function ($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            })
            ->get();

        return ClassWorkUtility::calculateGrade($classWorks);
    }

    /**
     * @param $teacherId
     * @return array
     */
    public static function getAttedanceAverage ($teacherId)
    {
        $classrooms = StudentClass::with('dateClass')->whereHas('dateClass', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->get();

        return ClassWorkUtility::calculateAttedance($classrooms);
    }
}