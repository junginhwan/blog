<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\TodoItem;
use App\Http\Requests\CreateTodoItemRequest;
use Carbon\Carbon;

class TodoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todoItems = TodoItem::orderBy('created_at', 'DESC')->get();
        return Inertia::render('Todo/Show', [
            'todoItems' => $todoItems,
        ]);
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
    public function store(CreateTodoItemRequest $request)
    {
        $user = Auth::user();
        TodoItem::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
        ]);
        return redirect('todo');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $todoItem = TodoItem::find($request->input('id'));
        $todoItem->completed = !$request->completed;
        $todoItem->completed_at = ($todoItem->completed) ? Carbon::now() : null;
        $todoItem->save();

        return redirect('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todoItem = TodoItem::find($id);
        $todoItem->delete();

        return redirect('todo');
    }
}
