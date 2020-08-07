<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopUpNumbers;
use App\User;

class TopUpNumbersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top_up_numbers = TopUpNumbers::where('published', true)->get();

        return view('topup.index', compact('top_up_numbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('topup.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'phone_number' => 'required|phone:KE',
                'amount' => 'required|numeric|min:10|max:100',
                'top_up_time' => 'required',
                'user_id' => 'required|numeric'
            ]
        );

        $create_fields = $request->only('phone_number', 'amount', 'top_up_time', 'user_id');
        $create_fields['published'] = true;
        $top_up_numbers = new TopUpNumbers($create_fields);
        $top_up_numbers->save();
        return redirect(route("top-up-details.index"))->with('success', 'Top up record saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $top_up_number = TopUpNumbers::find($id);
        $users = User::all();
        return view('topup.edit', compact(['top_up_number', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'phone_number' => 'required|phone:KE',
                'amount' => 'required|numeric|min:10|max:100',
                'top_up_time' => 'required',
            ]
        );
        $update_fields = $request->only('phone_number', 'amount', 'top_up_time');
        $top_up_number = TopUpNumbers::find($id);

        $top_up_number->fill($update_fields);
        $top_up_number->save();
        return redirect(route("top-up-details.index"))->with('success', 'Top up record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $top_up_number = TopUpNumbers::find($id);
        $top_up_number->delete();
        return redirect(route("top-up-details.index"))->with('success', 'Top up record deleted');
    }
}
