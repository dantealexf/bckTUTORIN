<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.index');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->all());
        return redirect()->route('category.index')->withFlash('Categoria guardada');
    }

    public function show(Category $category)
    {
        $tasks = Task::where('category_id',$category->id)->get();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Category $categoy,CategoryUpdateRequest $request)
    {
        $category = Category::update($request->all());
        return redirect()->route('category.index')->withFlash('Categoria modificada');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->withFlash('Categoria eliminada');
    }
}
