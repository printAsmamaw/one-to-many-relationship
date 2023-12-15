<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUserWithPosts(Request $request)
    {
        $user = User::create([
    'name' => $request->input('name'),
    'email'=>$request->input('email'),
    'password'=>$request->input('password')
    ]);
    //    $message=Mesage::create([
    //     'message'=>$request->input('message'),
    //     ''
    //    ])
        // Create posts for the user
        $postsData = $request->input('posts');
        $personaldata= $request->input('asmamaw');

          if($personaldata)
          {
            echo "there is personal data like passion";
          }

          foreach($personaldata as $persondata){
            $data=$persondata;
            
          }
          return response()->json($data);
   
        
        foreach($postsData as $postData) {
            $post = new Post($postData);
            $user->posts()->save($post);
        }
        return response()->json(['message' => 'User created with posts'], 201);
    }

    public function getUserWithPosts($userId)
    {
        $user = User::with('posts')->find($userId);
          
        return response()->json($user);
    }

    public function getpostwithUser($userId)
    {

        // $user=User::find($userId);
        // $post=$user->posts->first();
        // $title=$post->title;
        // return response()->json($title);
        $user=User::find($userId);
        $postTitles = $user->posts->pluck('title')->toArray();
        $postContents=$user->posts->pluck('content')->toArray();

    return [
        // 'user' => $user,
        'post_titles' => $postTitles
    ];
        
        // $post=Post::find($userId);
        // $user=$post->user;
        // $username=$user->name;

        // return response()->json($username);

        

    }

    
}

