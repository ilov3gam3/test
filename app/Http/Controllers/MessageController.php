<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $mess = message::create([
            'message' => $request->message
        ]);
        if ($mess){
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function show()
    {
        $list = message::all();
        return response()->json(['data' => $list]);
    }

    public function edit(message $message)
    {
        //
    }

    public function update(Request $request, message $message)
    {
        //
    }

    public function destroy(message $message)
    {
        //
    }
}
