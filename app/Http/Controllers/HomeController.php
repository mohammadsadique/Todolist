<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Models\Todotask;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id; 
        $todoData = Todotask::where('user_id' , $id)->orderBy('id','desc')->paginate(10);
        return view('home' , compact('todoData'));
    }
    public function deleteTodoList(Request $request)
    {
        try {
            $input = $request->all();
            $todolist_id = $input['todolist_id'];
            Todotask::where('id' , $todolist_id)->delete();
            return redirect()->back()->with('success','Todo list deleted successfully!');
        } catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
    }
    public function submitAddTodo(Request $request)
    {
        try {
            $input = $request->all();
            $todolist_id = $input['todolist_id'];
            $title = $input['title'];
            $description = $input['description'];
            $id = Auth::user()->id; 

            if(!empty($todolist_id)){
                $data = Todotask::find($todolist_id);
                $msg = 'Todo list updated successfully!';
            } else {
                $data = new Todotask;
                $msg = 'Todo list created successfully!';
            }
            $data->user_id = $id;
            $data->title = $title;
            $data->description = $description;
            $data->save();
            return redirect()->back()->with('addsuccess', $msg);
        } catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
    }
    public function completeTodoList(Request $request)
    {
        try {
            $input = $request->all();
            $todolist_id = $input['todolist_id'];
            $getTodod = Todotask::where('id' , $todolist_id)->first();
            if($getTodod->status == 1){
                Todotask::where('id' , $todolist_id)->update([ 'status' => 0 ]);
                $msg = 'The task is revert back successfully.';
            } else {
                Todotask::where('id' , $todolist_id)->update([ 'status' => 1 ]);
                $msg = 'The task is assign to be completed successfully.';
            }
            return redirect()->back()->with('success', $msg);
        } catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
    }
}



