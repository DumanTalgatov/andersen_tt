<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $records = Task::all();
        return view('main', compact('records'));
    }
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email",
            "message" => "required|string|max:200"
        ]);

        if($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ]);
        }

        Task::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "message" => $request->input("message"),
        ]);

        return redirect('/');
    }
}
