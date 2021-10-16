<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\TicketAdmin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TicketAdminController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    protected $department;
   // protected $ticketAdmin;
    public function __construct(Department $department)
    {
        $this->middleware('guest:web');
        $this->middleware('guest:ticket_admin');
        $this->department = $department;
      //  $this->ticketAdmin = $ticketAdmin;
    }

    public function showRegistrationForm()
    {
        $departments = $this->department->get(['fa_name','id']);

       return view('admin.register',compact('departments'));
    }

    public function register(Request $request)
    {
        $this->validateRegister($request);
        $ticketAdmin = $this->create($request->all());

        $this->guard()->login($ticketAdmin);
        return redirect($this->redirectTo);

    }


    private function validateRegister($request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'department_id'=> ['required']
        ]);

    }


    public function showLoginForm()
    {
        return view('admin.login');
    }


    private function guard()
    {
        return Auth::guard('ticket_admin');
    }

    private function create(array $data)
    {

        return TicketAdmin::create([
            'name'=> $data['name'],
            'email'=> $data['email'],
            'password' => Hash::make($data['password']),
            'department_id' => $data['department_id']
        ]);

    }

    public function logout(Request $request)
    {
        session()->invalidate();

        Auth::logout();

        return redirect('ticket-admin/login');
    }
}
