<?php

namespace App\Http\Controllers;

use App\Models\Exam_Master;
use App\Models\Question_Master;
use App\Models\Result;
use App\Models\Student;
use App\Models\Student_Exam;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student')->except(['showLoginForm', 'login']);
    }

    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('student')->attempt($credentials)) {
            $student = Auth::guard('student')->user();
            $request->session()->put('student_id', $student->id);
            return redirect()->intended(route('student.dashboard'));
        }
        return $this->dashboard();
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login');
    }


    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));


        Session::put('student_id',$user->id);

        // return redirect(RouteServiceProvider::HOME);
        return redirect('student/login');
    }


    public function dashboard()
    {

        $data['portal_exams'] = exam_master::select(['exam_masters.*', 'categories.name as cat_name'])
            ->join('categories', 'exam_masters.category', '=', 'categories.id')
            ->orderBy('id', 'desc')->where('exam_masters.status', '1')->get()->toArray();
        return view('student.dashboard', $data);
    }


    //Exam page
    public function exam()
    {


        $student_info = Student_Exam::select(['student_exams.*', 'students.name', 'exam_masters.title', 'exam_masters.exam_date'])
            ->join('students', 'students.id', '=', 'student_exams.student_id')
            ->join('exam_masters', 'student_exams.exam_id', '=', 'exam_masters.id')->orderBy('student_exams.exam_id', 'desc')
            ->where('student_exams.student_id', Session::get('student_id'))
            ->where('student_exams.std_status', '1')
            ->get()->toArray();

        return view('student.exam', ['student_info' => $student_info]);
    }


    //join exam page
    public function join_exam($id)
    {

        $question = Question_Master::where('exam_id', $id)->get();

        $exam = Exam_Master::where('id', $id)->get()->first();
        return view('student.join_exam', ['question' => $question, 'exam' => $exam]);
    }



    //On submit
    public function submit_questions(Request $request)
    {


        $yes_ans = 0;
        $no_ans = 0;
        $data = $request->all();
        $result = array();
        for ($i = 1; $i <= $request->index; $i++) {

            if (isset($data['question' . $i])) {
                $q = question_master::where('id', $data['question' . $i])->get()->first();

                if ($q->ans == $data['ans' . $i]) {
                    $result[$data['question' . $i]] = 'YES';
                    $yes_ans++;
                } else {
                    $result[$data['question' . $i]] = 'NO';
                    $no_ans++;
                }
            }
        }

        $std_info = Student_Exam::where('student_id', Session::get('student_id'))->where('exam_id', $request->exam_id)->get()->first();
        $std_info->exam_joined = 1;
        $std_info->update();


        $res = new Result();
        $res->exam_id = $request->exam_id;
        $res->student_id = Session::get('student_id');
        $res->yes_ans = $yes_ans;
        $res->no_ans = $no_ans;
        $res->result_json = json_encode($result);

        echo $res->save();
        return redirect(url('student/exam'));
    }



    //Applying for exam
    public function apply_exam($id)
    {

        $checkuser = Student_Exam::where('student_id', Session::get('student_id'))->where('exam_id', $id)->get()->first();

        if ($checkuser) {
            $arr = array('status' => 'false', 'message' => 'Already applied, see your exam section');
        } else {
            $exam_student = new Student_Exam();

            $exam_student->student_id = Session::get('student_id');
            $exam_student->exam_id = $id;
            $exam_student->std_status = 1;
            $exam_student->exam_joined = 0;

            $exam_student->save();

            $arr = array('status' => 'true', 'message' => 'applied successfully', 'reload' => url('student/dashboard'));
        }

        echo json_encode($arr);
    }


    //View Result
    public function view_result($id)
    {

        $data['result_info'] = result::where('exam_id', $id)->where('student_id', Session::get('student_id'))->get()->first();

        $data['student_info'] = Student::where('id', Session::get('student_id'))->get()->first();

        $data['exam_info'] = exam_master::where('id', $id)->get()->first();

        return view('student.view_result', $data);
    }


    //View answer
    public function view_answer($id)
    {

        $data['question'] = question_master::where('exam_id', $id)->get()->toArray();

        return view('student.view_amswer', $data);
    }



    // Add more methods for other routes
}
