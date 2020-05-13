<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Category;
use App\Models\Level;
use App\Models\Tag;
use App\Models\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function showStatuses($status)
    {
        $tasks = (empty($status)) ?  null : Task::where('status',$status)->get();
        if($tasks == null)
            abort(404);
        return view('admin.tasks.index',compact('tasks'));
    }

    public function create()
    {

        return view('admin.tasks.create',[
            'user'       => Auth::user(),
            'levels'     => Level::all(),
            'tags'       => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function store(TaskStoreRequest $request)
    {
       $user = Auth::user();
       $task = Task::create([
           'user_id'     => $user->id,
           'category_id' => $request->get('category'),
           'level_id'    => $request->get('level'),
           'title'       => $request->get('title'),
           'delivery'    => $request->get('delivery'),
           'price'       => $request->get('price'),
           'body'        => $request->get('body'),
       ]);

       $task->user->profile->location->update([
           'state'      => $request->get('state'),
           'city'       => $request->get('city'),
           'address'    => $request->get('address'),
       ]);

        $tags = $request->get('tags');

        if(! empty($tags))
        {
            $task->tags()->attach($tags);
        }

        if($request->file('photo'))
        {
            $photo = $request->file('photo')->store('public/task');
            $task->image()->create([
                'url' => Storage::url($photo)
            ]);
        }

        if($request->file('document'))
        {
            $document = $request->file('document')->store('public/task');
            $task->file()->create([
                'url'  => Storage::url($document),
            ]);
        }
        return redirect()->route('task.index')->withFlash('Tarea creada');
    }

    public function show(Task $task)
    {
        return view('admin.tasks.show',compact('task'));
    }

    public function edit(Task $task)
    {
        return view('admin.tasks.update',compact('task'));
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update([
            'title'   => $request->get('title'),
            'body'    => $request->get('body'),
        ]);

        return back()->withFlash('Tarea modificada');
    }

    public function destroy($id)
    {
        //
    }
}
