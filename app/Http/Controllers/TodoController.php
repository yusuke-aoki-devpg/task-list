<?php



namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $today = new DateTime();

        $todos = Todo::where('user_id', $request->user()->id)
                    ->orderByRaw('`deadline` IS NULL ASC')
                    ->orderBy('deadline')
                    ->where('deadline', '>=', $today)
                    ->get();

        return view('todos.index', [
            'todos' => $todos,
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
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'newTodo'     => 'required|max:100',
            'newDeadline' => 'required|after:"now"',
        ]);

        $request->user()->todos()->create([
            'todo' => $request->newTodo,
            'deadline' => $request->newDeadline
        ]);

        return redirect()->route('home');
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
    public function edit(Todo $todo)
    {
        // 他のユーザーが編集できてしまっていた $todo = Todo::find($id);
        $this->authorize('edit', $todo);
        
        return view('todos.edit', [
            'todo' => $todo,
        ]);
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
        $request->validate([
            'updateTodo'     => 'required|max:100',
            'updateDeadline' => 'required|after:"now"',
        ]);

        $todo = Todo::find($id);

        $todo->todo     = $request->updateTodo;
        $todo->deadline = $request->updateDeadline;

        $todo->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Todo $todo)
    {
        // 他のユーザーが編集できてしまっていた $todo = Todo::find($id);
        $this->authorize('destroy', $todo);

        $todo->delete();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
