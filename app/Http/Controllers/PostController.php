<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Validator;


class PostController extends Controller
{
    public function index()
    {
       $post = Post::all();
       $data = [
           'status'=>200,
           'post'=>$post

       ];
       return response()->json($data,200);
    }





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
[
            'name'=>'required',
            'email'=>'required'
        ]);
            if ($validator->fails())
            {
                $data = [
                        "status"=>422,
                        "message"=>$validator->messages()

                ];
                return response()->json($data,422);

            }
            else
            {
                $post= new Post;
                $post->name = $request->name;
                $post->email = $request->email;
                $post->phone = $request->phone;

                $post->save();

                $data =
                [
                    'status'=>200,
                    'message'=>'Data uploaded successfull'

                ];
                return response()->json($data,200);

            }

    }


    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        [
                    'name'=>'required',
                    'email'=>'required'
                ]);
                    if ($validator->fails())
                    {
                        $data = [
                                "status"=>422,
                                "message"=>$validator->messages()

                        ];
                        return response()->json($data,422);

                    }
                    else
                    {
                        $post= Post::find( $id );
                        $post->name = $request->name;
                        $post->email = $request->email;
                        $post->phone = $request->phone;

                        $post->save();

                        $data =
                        [
                            'status'=>200,
                            'message'=>'Data updated successfull'

                        ];
                        return response()->json($data,200);
                    }


    }

    public function delete($id)
    {

        $post= Post::find($id);
        $post->delete();
        $data =
        [

            'status'=> 200,
            'message'=> 'Deleted'
        ];
        return response()->json($data,200);

    }

}
