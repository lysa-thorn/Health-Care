<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        $message = "Not found material";
        $commentResource = CommentResource::collection($comments);
        if (!$comments) {
            return $message;
        }
        return response()->json(['comments' => $commentResource]);
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
        $message = "Comment was not created";
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = $request->user_id;
        $comment->material_id = $request->material_id;
        $comment->save();
        if($comment) {
            $message = "Comment was created successfully.";
        }
        return response()->json(['Massage' =>  $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $message = "Comment was not updated";
    //     $comment = Comment::find($id);
    //     $comment->comment = $request->comment;
    //     $comment->user_id = $request->user_id;
    //     $comment->material_id = $request->material_id;
    //     $comment->save();
    //     if($comment) {
    //         $message = "Comment was updated successfully.";
    //     }
    //     return response()->json(['Massage' =>  $message]);
    // }
    public function updateComment(Request $request, $id)
    {
        $message = "Comment was not updated";
        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->user_id = $request->user_id;
        $comment->material_id = $request->material_id;
        $comment->save();
        if($comment) {
            $message = "Comment was updated successfully.";
        }
        return response()->json(['Massage' =>  $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = "";
        $comment = Comment::find($id);
        if(!$comment) {
            $message = "Not found comment.";
        } else {
            $comment->delete();
            $message = "Comment was deleted successfully.";
        }
        
        return response()->json(['message' => $message]);
        
    }
}
