<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->get();
        return view('admin.tags.index',compact('tags'));
    }

    public function create()
    {
        //
    }

    public function store(TagStoreRequest $request)
    {
        $tag = Tag::create($request->all());
        return redirect()->route('tag.index')->withFlash('Etiqueta guardada');
    }

    public function show(Tag $tag)
    {
        $tasks = $tag->tasks;
        return view('admin.tasks.index',compact('tasks'));
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update(Tag $tag,TagUpdateRequest $request)
    {
        $tag = Tag::update($request->all());
        return redirect()->route('tag.index')->withFlash('Etiqueta modificada');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tag.index')->withFlash('Etiqueta eliminada');
    }
}
