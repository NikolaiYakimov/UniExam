<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SuccessfullyRegistrated;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use App\Models\Student;
use App\Services\ExamService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Js;
use PhpParser\Node\Expr\Cast\Double;

use Stripe\Stripe;

class StudentController extends Controller
{

    public function getStudentProfile(): JsonResponse
    {
        $user = Auth::user();
        $student=$user->student->load('faculty','specialty','group');


        return response()->json([
            'user'=>$user,
            'student'=>$student
        ]);

    }

}


