<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $question = question::filter(request(['kind', 'university', 'course', 'study_program', 'status', 'customer_id', 'consultant_id']))->get();
            return response()->json([
                'massage' => 'success',
                'question' => $question
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'kind' => 'required',
            'date' => 'date',
            'university' => 'required',
            'course' => 'required',
            'file' => 'image|max:1024'
        ]);
        $data['customer_id'] = $request->user()->id;

        if ($request->file('file')) {
            $data['file'] = $request->file('file')->store('file');
        }

        if ($data['kind'] == 'quizz') {
            $data['status'] = 'request';
            if ($request->user()->pont > 100) {
                try {

                    $question = question::create($data);
                    return response()->json([
                        'massage' => 'success',
                        'question' => $question
                    ], 200);
                } catch (Exception $e) {
                    return response()->json([
                        'message' => 'error',
                        'message_error' => $e->getMessage(),
                    ], 401);
                    exit;
                }
            } else {
                return response()->json([
                    'massage' => 'error',
                    'massage_error' => 'your point is insufficient',

                ], 201);
            }
        } elseif ($data['kind'] == 'assignment') {
            $data['status'] = 'request';
            try {

                $question = question::create($data);
                return response()->json([
                    'massage' => 'success',
                    'question' => $question
                ], 200);
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'error',
                    'message_error' => $e->getMessage(),
                ], 401);
                exit;
            }
        } elseif ($data['kind'] == 'showcase') {
            $data['status'] = 'finish';
            try {

                $question = question::create($data);
                return response()->json([
                    'massage' => 'success',
                    'question' => $question
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */   
    public function show($id)
    {
        try {

            $question = question::where('id', $id)->get();
            return response()->json([
                'massage' => 'success',
                'question' => $question
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
