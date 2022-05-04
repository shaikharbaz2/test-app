<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('home', compact('users'));

    }
    /**
     * Show the application dashboard.
     *
     * @return $response
     */
    public function create(Request $request)
    {
        return view('user.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'password' => 'required',
            'email'    => 'required|email|unique:users',
            'image'    => 'required|image|mimes:jpeg,jpg,png',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $this->userRepository->createUser($request->all());
        return response()->json("data store successfully", 200);

    }

    /**
     * edit user function
     *
     * @param [int] $userId
     * @return view
     */
    public function edit($userId)
    {
        $user = User::find($userId);
        return view('user.edit', compact('user'));

    }

    public function destroy($userId)
    {
        $this->userRepository->deleteUser($userId);
        return redirect('/home');
    }

    public function update(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $this->userRepository->updateUser($userId, $request->all());
        return response()->json("data update successfully", 200);
    }

    public function searchUser(Request $request)
    {
        $users = User::orWhere('users.email', 'LIKE', '%' . $request->search . '%')
            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%')
            ->paginate(20);
        return view('home', compact('users'));
    }

}
