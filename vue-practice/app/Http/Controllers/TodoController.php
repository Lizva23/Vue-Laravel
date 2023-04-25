<?php

namespace App\Http\Controllers;
  
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
  
class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $todos = Todo::latest()->paginate(5);
        
        return view('todos.index',compact('todos'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('todos.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => 'required',
            'date' => 'required',
        ]);
        
        Todo::create($request->all());
         
        return redirect()->route('todos.index')
                        ->with('success','To-do added successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): View
    {
        return view('todos.show',compact('todo'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo): View
    {
        return view('todos.edit',compact('todo'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo): RedirectResponse
    {
        $request->validate([
            'description' => 'required',
            'date' => 'required',
        ]);
        
        $todo->update($request->all());
        
        return redirect()->route('todos.index')
                        ->with('success','To-do added successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): RedirectResponse
    {
        $todo->delete();
         
        return redirect()->route('todos.index')
                        ->with('success','To-do deleted successfully');
    }

}
