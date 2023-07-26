<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth:api') ->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();

        return response() -> json([
            'data' => $members
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request -> all(), [
            'member_name' => 'required',
            'id_binusian' => 'required',
            'major' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'pts' => 'required|max:50',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required|same:password',

        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();
        $input['password'] = bcrypt($request -> password);
        unset($input['confirm_password']);
        $member = Member::create($input);

        return response() -> json([
            'data' => $member
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return response() -> json([
            'data' => $member
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validator = Validator::make($request -> all(), [
            'member_name' => 'required',
            'id_binusian' => 'required',
            'major' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required | email',
            'pts' => 'required | max:50',
            'password' => 'required | same:confirm_password',
            'confirm_password' => 'required | same:password',
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();

        $member -> update($input);

        return response() -> json ([
            'message' => 'Member Updated',
            'data' => $member
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member -> delete();

        return response() -> json([
            'message' => 'Member Deleted'
        ]);
    }
}
