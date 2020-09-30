<?php

namespace App\Http\Controllers\Examination;

use App\HelpTicketCategory;
use App\Http\Controllers\Controller;
use App\libraries\Utility\ExaminationUtility;
use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\Examination;
use App\Models\Examination\ExaminationQuestionMapping;
use App\Models\Examination\Question;
use App\Models\Student;
use App\StudentClass;
use App\StudentSubject;
use App\SupportVideo;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class ExaminationController
 * @package App\Http\Controllers\Examination
 */
class ExaminationController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index (Request $request)
    {
        $loggedTeacher = Session::get('teacher_session');

        return Examination::where('created_by', $loggedTeacher['teacher_id'])->get();
    }

    public function show (Request $request, $id)
    {
        $loggedTeacher = Session::get('teacher_session');

        $examination = Examination::where('created_by', $loggedTeacher['teacher_id'])->find($id);

        return $examination ? $examination : 'No record found';
    }

    public function store (Request $request)
    {
        $request->validate([
            'title'        => 'required',
        ],
        [
            'title.required'  => 'Exam name is required',
        ]);
        
        $loggedTeacher = Session::get('teacher_session');

        $examination = new Examination();
        $examination->title = $request->title;
        $examination->created_by = $loggedTeacher['teacher_id'];
        $examination->save();

        return $examination;

//        return Response::json(['success' => true, 'response' => $examination]);
    }

    public function destroy (Request $request, $id)
    {
        $loggedTeacher = Session::get('teacher_session');
        $examination = Examination::where('created_by', $loggedTeacher['teacher_id'])->find($id);

        if ( $examination )
            $examination->delete();
    }

    public function createExamination (Request $request)
    {
        $helpCategories = HelpTicketCategory::get();
        $videos = SupportVideo::all();

        $classroomExaminationMapping = ClassroomExaminationMapping::with('examination', 'classroom')->get();

        $questionClasses = Question::groupBy('class')->pluck('class');
        $classes = StudentClass::groupBy('class_name')->pluck('class_name');
        $subjects = StudentSubject::get();
        $classrooms = StudentClass::with('studentSubject')->get();

        return view('teacher.examination.index', compact('videos', 'helpCategories', 'classroomExaminationMapping', 'questionClasses', 'classes', 'subjects', 'classrooms'));
    }


    public function takeExamination (Request $request, $id)
    {
        return ClassroomExaminationMapping::with('examination', 'classroom')->find($id);
    }

    public function getQuestions (Request $request)
    {
        $classroomExaminationMapping = ClassroomExaminationMapping::with('examination', 'classroom')->find($request->classroom_examiation_mapping_id);

        $student = Student::whereHas('class', function ($q) use ($classroomExaminationMapping) {
            $q->where('class_name', $classroomExaminationMapping->classroom->class_name);
            $q->where('section_name', $classroomExaminationMapping->classroom->section_name);
        })->where('email', $request->email)->first();

        if ( !$student )
            return false;

        $questions = ExaminationQuestionMapping::with('questions')->where('examination_id', $classroomExaminationMapping->examination_id)
            ->where('classroom_id', $classroomExaminationMapping->classroom_id)->get();
    }

    public function calculateEndTime (Request $request)
    {
        $dateTime                 = (strtotime($request->start_time));
        $date                     = date('Y.m.d', $dateTime);
        $timeInHours              = date('H', $dateTime);
        $timeInMin                = date('i', $dateTime);
        $durationInHours          = date('H', mktime(0, $request->duration));
        $durationInMin            = date('i', mktime(0, $request->duration));
        $durationPercentage       = number_format((16/100)*$request->duration,0);
        $endTimeMin               = $timeInMin+$durationInMin+$durationPercentage;
        $durationPercentageHours  = date('H', mktime(0, $endTimeMin));
        $durationPercentageMins   = date('i', mktime(0, $endTimeMin));
        $endTimeHours             = $timeInHours+$durationInHours+$durationPercentageHours;
        $endTime                  = $date.'T'.$endTimeHours.':'.$durationPercentageMins;

        return $endTime;
    }


    public function setExamination (Request $request)
    {
        $request->validate([
            'classroom_id'  => 'required',
            'duration'      => 'required',
            'start_time'    => 'required',
        ],
        [
            'classroom_id.required'  => 'Select Classroom',
            'duration.required'      => 'Duration is required',
            'start_time.required'    => 'Start time is required',
        ]);

        $examination = $this->store($request);
        $endTime     = $this->calculateEndTime($request);

        ExaminationUtility::createClassroomExaminationMapping([
            'examination_id'         => $examination->id,
            'classroom_id'           => $request->classroom_id,
            'duration'               => date('H:i', mktime(0, $request->duration)),
            'start_time'             => $request->start_time,
            'end_time'               => $endTime,
            'examination_properties' => json_encode($request->properties),
        ]);

        $examinationQuestionMappings = array();
        foreach ( $request->questions as $questionId ) {
            $examinationQuestionMappings[] = ['examination_id' => $examination->id,
                                              'classroom_id'   => $request->classroom_id,
                                              'question_id'    => $questionId,
                                              'marks'          => $request->marks[ $questionId ]];
        }

        ExaminationQuestionMapping::insert($examinationQuestionMappings);

        return redirect()->route('examination')->with('success', 'added successfully');
    }
}