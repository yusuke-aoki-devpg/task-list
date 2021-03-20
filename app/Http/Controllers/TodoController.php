<?php



namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 期限が近いものから順に表示する、期限がないものは最後に持っていく
        // $todos = Todo::orderByRaw('`deadline` IS NULL ASC')->orderBy('deadline')->get();
        $today = new DateTime();
        echo $today->format('Y/m/d H:i');
        // -----------------------------------


        $users = User::where('id', '=', 1)->get();
        echo $users;

        $todos = Todo::where('user_id', '=', 1)->whereDay('deadline', '=', $today)->get();
        echo $todos;

        echo User::count();
        

        // $todos = Auth::user()->todos()->orderByRaw('`deadline` IS NULL ASC')->orderBy('deadline')->where('deadline', '>=', $today)->get();
        $todos = Auth::user()->todos()->orderByRaw('`deadline` IS NULL ASC')->orderBy('deadline')->where('deadline', '>=', $today)->get();

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ここでタスクを新規追加する------------------------------------------------------------------------

        // バリデーションチェック
        $request->validate([
            'newTodo'     => 'required|max:100',
            'newDeadline' => 'nullable|after:"now"',
        ]);

        //DBに保存
        $todo = new Todo();

        $todo->todo     = $request->newTodo;
        $todo->deadline = $request->newDeadline;
        
        Auth::user()->todos()->save($todo);

        // リダイレクトする
        return redirect()->route('todos.index');
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
        $todo = Todo::find($id);
        
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
            'updateDeadline' => 'nullable|after:"now"',
        ]);

        $todo = Todo::find($id);

        $todo->todo     = $request->updateTodo;
        $todo->deadline = $request->updateDeadline;

        $todo->save();

        return redirect()->route('todos.index');
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
        $todo = Todo::find($id);

        $todo->delete();

        return redirect()->route('todos.index');
    }
}
