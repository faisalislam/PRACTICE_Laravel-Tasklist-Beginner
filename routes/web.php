<?php
use Illuminate\Http\Request;
use App\Task;
Route::get('/', function () {
    
    $tasks = Task::orderBy('created_at','asc')->get();
    return view('tasks.index',[
        'tasks' => $tasks,
    ]);
});

Route::post('/task', function(Request $request){
    $validator = Validator::make($request->all(),[
        'name' => 'required|max:100',
    ]);
    
    if ($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
//    $task = new Task;
//    $task->name = $request->name;
//    $task->save();
    Task::create([
        'name' => $request->name,
    ]);
    return redirect('/');
});


Route::delete('/task/{task}', function(Task $task){
    $task->delete();
    return redirect('/');
});