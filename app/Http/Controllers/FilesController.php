<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class FilesController
 * Api files controller
 */
class FilesController extends Controller {
    /**
     * Show a file inside the api
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show() {
        return response()->download( storage_path( 'app/GraceHopper.pdf' ), 'Amazing Grace' );
    }

    /**
     * Create a file sent through the api
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create( Request $request ) {
        $path = $request->file( 'photo' )->store( 'testing' );

        return response()->json( [ 'path' => $path ], 200 );
    }
}
