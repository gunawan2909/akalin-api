<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $user = User::filter(request(['access']))->get();
            return response()->json([
                'massage' => 'success',
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'message_error' => $e->getMessage(),
            ], 401);
            exit;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeconsultant(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'university' => 'required',
            'phone' => 'required',
            'study_program' => 'required',
            'cv' => 'required|image|max:5024',
            'affidavit' => 'required|image|max:5024',

        ]);
        $data = array_merge($data, [
            'avatar' => ' ',
            'point' => 0,
            'access' => 'consulant_applicants ',
            'cv' => $request->file('cv')->store('cv'),
            'affidavit' => $request->file('affidavit')->store('affidavit'),
        ]);
        $data['password'] = bcrypt($data['password']);

        try {

            $user = User::create($data);
            return response()->json([
                'massage' => 'success',
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'message_error' => $e->getMessage(),
            ], 401);
            exit;
        }
    }
    public function storecustomer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'university' => 'required',
            'phone' => 'required',
            'study_program' => 'required',


        ]);
        $data = array_merge($data, [
            'avatar' => ' ',
            'point' => 0,
            'access' => 'customer',

        ]);
        $data['password'] = bcrypt($data['password']);

        try {

            $user = User::create($data);
            return response()->json([
                'massage' => 'success',
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'message_error' => $e->getMessage(),
            ], 401);
            exit;
        }
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
        try {

            $user = User::where('id', $id)->first();
            return response()->json([
                'massage' => 'success',
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'message_error' => $e->getMessage(),
            ], 401);
            exit;
        }
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
        $datavalidate = $request->validate([
            'name' => 'required',
            'university' => 'required',
            'phone' => 'required',
            'study_program' => 'required',
            'access' => 'required'
            // 'cv_old' => 'required',
            // 'affidavit_old' => 'required',
        ]);
        $data = [
            'name' => $datavalidate['name'],
            'university' => $datavalidate['university'],
            'phone' => $datavalidate['phone'],
            'study_program' => $datavalidate['study_program'],
            'access' => $datavalidate['access'],
            // 'avatar' => ' ',

        ];
        // if ($request->file('cv')) {
        //     $data['cv'] = $request->file('cv')->store('cv');
        // } else {
        //     $data['cv'] = $request->cv_old;
        // }
        // if ($request->file('affidavit')) {
        //     $data['affidavit'] = $request->file('affidavit')->store('affidavit');
        // } else {
        //     $data['affidavit'] = $request->cv_old;
        // }



        try {
            User::where('id', $id)->update($data);

            $user = User::where('id', $id)->first();
            return response()->json([
                'massage' => 'success',
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'message_error' => $e->getMessage(),
            ], 401);
            exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            User::destroy($id);

            return response()->json([
                'massage' => 'success',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'message_error' => $e->getMessage(),
            ], 401);
            exit;
        }
    }
}
