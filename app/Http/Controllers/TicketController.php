<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    protected $ticket;
    protected $department;

    public function __construct(Department $department,Ticket $ticket)
    {
        $this->middleware('auth:web,ticket_admin');
        $this->department = $department;
        $this->ticket = $ticket;
    }

    public function index()
    {
        $tickets = auth()->user()->tickets;
        return view('tickets.tickets',compact('tickets'));
    }

    public function showTicket(Ticket $ticket)
    {
       return view('tickets.ticket',compact('ticket'));
    }

    public function closeTicket(Ticket $ticket)
    {
        $ticket->close();
        return back();
    }

    public function newTicket()
    {
        $priorities = $this->ticket->getPriority();
        $departments = $this->department->get(['fa_name','id']);
        return view('tickets.new',compact('departments','priorities'));
    }

    public function storeTicket(Request $request)
    {
        $this->validateTicket($request);

       $ticket =  auth()->user()->tickets()->create(
            $request->all() + ['file_path' => $this->uploadFile($request)]
        );
        return redirect()->back()->with('success','پیام شما با موفقیت ثبت شد.');
    }

    private function validateTicket($request)
    {
        return $request->validate([
            'message' => ['required', 'string'],
            'title' => ['required', 'string'],
            'department_id' => ['required'],
        ]);

    }

    private function uploadFile($request){
        return ($request->hasFile('file'))
                 ?$request->file->store('public')
                    :null;
    }


}
