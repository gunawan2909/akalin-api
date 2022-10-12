<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\answer;
use App\Models\question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $data = $request->validate([
            'description' => 'required',
            'file' => 'image|max:1024'
        ]);

        if ($request('file')) {
            $data['file'] = $request->file('file')->store('file');
        }
        try {

            $data['question_id'] = $id;
            $answer = answer::create($data);
            $request = question::where('id', $id)->update('status', 'complited');
            return response()->json([
                'massage' => 'success',
                'answer' => $answer
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
