<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Task;
//for API requests
use Illuminate\Http\Response;

//to obtain logged user
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{    

  public function index(Request $request){
    //retrieve the different lists of tasks
    $user = $request->user();
    $tasks = $user->tasks()->get();
    //$completed = $user->tasks()->completed()->get();
    //$pending = $user->tasks()->pending()->get();

    //return JSON with both lists
    return response()->json($tasks, Response::HTTP_OK );
  }


  public function store(Request $request){
    //create new task
    $task = new Task;
    //asign values from view
    $task->name = $request->name;
    $task->description = $request->description;
    $task->completed = false;

    //retrieve user with api guard using api_token
    $user = $request->user();
    //associate user to the new task to fill the user_id column in table
    $task->user()->associate($user);
        //save in database
        $task->save();
    //return new task and http code
    return response()->json([$task], Response::HTTP_CREATED );
  }
  public function complete(Request $request, $id){
    //retrieve user with api guard using api_token
    $user = $request->user();
    //$user = Auth::guard('api')->user();
    //check if task id belongs to the same user before completing it
    $task = $user->tasks()->findOrFail($id);
    $task->completed = true;
    $task->save();
    return response()->json('Task completed!', Response::HTTP_OK );
  }
}
