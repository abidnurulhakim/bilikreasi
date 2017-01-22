<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\IdeaMedia;
use App\Http\Requests\Idea\Media\StoreRequest;
use Illuminate\Http\Request;

class IdeaMediaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, $slug)
    {
        $idea = Idea::where('slug', $slug)->withTrashed()->firstOrFail();
        $media = new IdeaMedia();
        $media->idea()->associate($idea);
        $media->url = $request->file('media');
        if ($media->save()) {
            return response()->json([
                'status' => 200,
                'media' => $media->toArray(),
                'message' => 'OK'
            ]);
        }
        return response()->json([
                'status' => 400,
                'message' => 'ERROR'
            ]);
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

