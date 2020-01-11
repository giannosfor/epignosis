<?php


namespace App\Http\Controllers;


use App\Product;

use Illuminate\Http\Request;


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

        $leaves = Leave::latest()->paginate(5);

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

        request()->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);


        Leave::create($request->all());


        return redirect()->route('leaves.index')

                        ->with('success','Leave created successfully.');

    }


    /**

     * Display the specified resource.

     *

     * @param  \App\Leave  $leave

     * @return \Illuminate\Http\Response

     */

    public function show(Leave $leave)

    {

        return view('leaves.show',compact('leave'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Leave  $leave

     * @return \Illuminate\Http\Response

     */

    public function edit(Leave $leave)

    {

        return view('leaves.edit',compact('leave'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Leave  $leave

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Leave $leave)

    {

         request()->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);


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