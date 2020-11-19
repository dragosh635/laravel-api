<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Poll as PollResource;

class PollsController extends Controller {

    /**
     * Return all polls and paginate by 1
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        return response()->json( Poll::paginate(1), 200 );
    }

    /**
     * Return a single poll by id
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id ) {

        $poll = Poll::with( 'questions' )->findOrFail( $id );

        $response['poll']      = $poll;
        $response['questions'] = $poll->questions;

        $response = new PollResource( $response ); // in the older versions of Laravel this wouldn't work, but now it does

        return response()->json( $response, 200 );
    }

    /**
     * Save a poll
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request ) {

        //validate
        $rules     = [
            'title' => 'required|max:255',
        ];
        $validator = Validator::make( $request->all(), $rules );
        if ( $validator->fails() ) {
            return response()->json( $validator->errors(), 400 );
        }

        //create
        $poll = Poll::create( $request->all() );

        // return 201 - The request created a new resource
        return response()->json( $poll, 201 );
    }

    /**
     * Update a poll
     *
     * @param Request $request
     * @param Poll $poll
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( Request $request, Poll $poll ) {
        $poll->update( $request->all() );

        return response()->json( $poll, 200 );
    }

    /**
     * Delete a poll
     *
     * @param Request $request
     * @param Poll $poll
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete( Request $request, Poll $poll ) {
        $poll->delete();

        return response()->json( null, 204 );
    }

    /**
     * Return custom errors
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errors() {
        return response()->json( [ 'msg' => 'Payment is required' ], 501 );
    }

    /**
     * Reqturn the questions for a specific poll
     *
     * @param Request $request
     * @param Poll $poll
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function questions( Request $request, Poll $poll ) {
        $questions = $poll->questions;

        return response()->json( $questions, 200 );
    }
}
