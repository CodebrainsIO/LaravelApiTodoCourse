<?php

namespace App\Http\Controllers\API;

use App\Enums\Priority;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use BenSampo\Enum\Rules\EnumValue;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todos = Todo::all();

        return $todos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'task' => 'required|max:255',
            'priority' => ['required', new EnumValue(Priority::class)],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $todo = Todo::create(
            $request->all()
        );

        $todo->save();

        return $todo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $todo = Todo::findOrFail($id);

        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $todo = Todo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'task' => 'required|max:255',
            'priority' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $todo->fill(
            $request->all()
        );

        $todo->save();

        return $todo;
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
        Todo::destroy($id);
    }
}
