<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller {
    /**
     * Display a listing of questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json( Question::get(), 200 );
    }

    /**
     * Create a question
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        return response()->json( Question::create( $request->all() ), 201 );
    }

    /**
     * Return a specific question
     *
     * @param \App\Models\Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function show( Question $question ) {
        return response()->json( $question, 200 );
    }

    /**
     * Update the specified question in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Question $question ) {
        return response()->json( $question->update( $request->all() ), 200 );
    }

    /**
     * Remove the specified question from storage.
     *
     * @param \App\Models\Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( Question $question ) {
        return response()->json( $question->delete(), 204 );
    }
}
