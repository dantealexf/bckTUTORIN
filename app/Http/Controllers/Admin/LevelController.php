<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelStoreRequest;
use App\Http\Requests\LevelUpdateRequest;
use App\Models\Level;
use App\Models\Task;
use Illuminate\Http\Request;

class LevelController extends Controller
{

    public function index()
    {
        $levels = Level::orderBy('id', 'DESC')->get();
        return view('admin.levels.index',compact('levels'));
    }

    public function create()
    {
        return view('admin.levels.index');
    }

    public function store(LevelStoreRequest $request)
    {
        $level = Level::create($request->all());
        return redirect()->route('level.index')->withFlash('Nivel guardado');
    }

    public function show(Level $level)
    {
        $tasks = Task::where('level_id',$level->id)->get();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function edit($id)
    {
        //
    }

    public function update(LevelUpdateRequest $request, $id)
    {
        $level = Level::update($request->all());
        return redirect()->route('level.index')->withFlash('Nivel modificado');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('level.index')->withFlash('Nivel eliminado');
    }
}
