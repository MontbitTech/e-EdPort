<?php

namespace App\Jobs;

use App\Admin;
use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\libraries\Classroom;
use App\libraries\Utility\RemoteRequest;
use App\Models\ClassSection;
use App\StudentClass;
use App\StudentSubject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateClassroomsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    private $token;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $token)
    {
        $this->data  = $data;
        $this->token = decrypt($token);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(0);
        $rowCount = 1;
        foreach($this->data as $row){
            $subjects = explode('|', $row['subjects']);

            foreach ( $subjects as $subject ) {
                $response = $this->createClassroom($row, $subject);
                Log::info($subject);
                if ( !$response['success'] ) {
                    Log::error($response['data'].' at row :'.$rowCount);
                }
            }
        }
        $rowCount++;
        Log::info('job finished');
    }


    public function createClassroom($row, $subjectName)
    {
        $classroomsExist = StudentClass::with('studentSubject')->where('class_name', $row['division'])
            ->where('section_name', $row['section'])
            ->whereHas('studentSubject', function ($q) use ($subjectName) {
                $q->where('subject_name', $subjectName);
            })
            ->first();

        if ( $classroomsExist )
            return failure_message('Classroom already Exist :' . $row['division'] . ' ' . $row['section'] . ' ' . $subjectName);

        $subject = StudentSubject::firstOrCreate(['subject_name' => $subjectName]);

        $class = ClassSection::firstOrCreate([
            'class_name'   => $row['division'],
            'section_name' => $row['section'],
        ]);
        $response = $this->createGoogleClassroom($row['division'], $row['section'], $subjectName);

        if ( !$response['success'] )
            return failure_message($response['data']->message);

        $classroom = Classroom::createClassroom([
                'class_name'   => $row['division'],
                'section_name' => $row['section'],
                'subject_id'   => $subject->id,
                'g_class_id'   => $response['data']->id,
                'g_link'       => $response['data']->alternateLink,
                'g_response'   => serialize($response['data']),
            ]);

        $this->inviteMainAdminToTheClassroom($response['data']->id, $this->token['access_token']);

        return success_message($classroom);
    }

    public function createGoogleClassroom ($className, $sectionName, $subjectName)
    {
        $data = array(
            "name"               => $className . ' ' . $subjectName,
            "section"            => $sectionName,
            "descriptionHeading" => "",
            "description"        => "",
            "room"               => "",
            "ownerId"            => "me",
            "courseState"        => "ACTIVE",

        );
        $data = json_encode($data);

        $response = Classroom::createClassInGoogleClassroom($this->token, $data); // access Google api craete Cource

        if ( !$response['success'] ) {
            if ( $response['data']->status == 'UNAUTHENTICATED' ) {
                Log::error($response['data']->message);

                return failure_message('UNAUTHENTICATED');
            }
            Log::error($response['data']->message);

            return $response;
        }

        return $response;
    }

    public function inviteMainAdminToTheClassroom($googleCourseId, $token)
    {
        $inv_data = array(
            "courseId" => $googleCourseId,
            "role"     => "TEACHER",
            "userId"   => Admin::find(1)->email,

        );
        $inv_data = json_encode($inv_data);
        $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // Invite teacher  
        $inv_resData = array('error' => '');

        if ($inv_responce == 101) {
            Log::error('Something went wrong, Please try again.');
        } else {
            $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));

            if ($inv_resData['error'] != '') {
                if ($inv_resData['error']['status'] == 'FAILED_PRECONDITION') {
                    Log::error('The requested user\'s account is disabled or if the user already has this role');
                } else {
                    Log::error($inv_resData['error']['message']);
                }
            }
        }
    }
}
