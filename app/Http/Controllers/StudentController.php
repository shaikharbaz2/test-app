<?php

namespace App\Http\Controllers;

use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    public $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'email'        => 'required|email',
            'phone_number' => 'required|min:10',
            'country_code' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $this->studentRepository->createStudent($request->all());
        return response()->json(['message' => "successfully store student data"], 200);

    }

}
