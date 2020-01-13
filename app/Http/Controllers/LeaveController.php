<?php

namespace App\Http\Controllers;

use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:leave-list|leave-create|leave-edit|leave-delete', ['only' => ['index','show']]);
         $this->middleware('permission:leave-create', ['only' => ['create','store']]);
         $this->middleware('permission:leave-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:leave-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // BR 2 , BR 1
        if ( \Auth::user()->hasRole('Admin') ) $leaves = Leave::latest()->paginate(5);
        else if ( \Auth::user()->hasRole('Employee') ) $leaves = \Auth::user()->leaves()->paginate(5);
        else throw new Exception("Error Processing Request", 1);
        
        return view('leaves.index',compact('leaves'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
            1. Date format
            2. Extra validation rule. must be later date.
        **/
        request()->validate([
            'vacation_start' => 'required|date',
            'vacation_end' => 'required|date|after:vacation_start',
            'reason' => 'required',
        ]);

        $leave = new Leave($request->all());
        \Auth::user()->leaves()->save($leave);

        return redirect()->route('leaves.index')
                        ->with('success','Leave created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    // public function show(Leave $leave)
    // {
    //     return view('leaves.show',compact('leave'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('leaves.show',['leave' => Leave::findOrFail($id)]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('leaves.edit',['leave' => Leave::findOrFail($id)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'vacation_start' => 'required|date',
            'vacation_end' => 'required|date|after:vacation_start',
            'reason' => 'required',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $leave = Leave::findOrFail($id);
        $leave->update($request->all());
        return redirect()->route('leaves.index')
                        ->with('success','Leave updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('leaves.index')
                        ->with('success','Leave deleted successfully');
    }
}