<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index',compact('courses'));
    }

    public function showStatuses($status)
    {
        $courses = (empty($status)) ?  null : Course::where('status',$status)->get();
        if($courses == null)
            abort(404);
        return view('admin.courses.index',compact('courses'));
    }

    public function create()
    {

        return view('admin.courses.forms.create',[
            'user'       => Auth::user(),
            'levels'     => Level::all(),
            'tags'       => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function store(CourseStoreRequest $request)
    {
        $user = Auth::user();

        $course = Course::create([
            'user_id'     => $user->id,
            'category_id' => $request->get('category'),
            'level_id'    => $request->get('level'),
            'title'       => $request->get('title'),
            'delivery'    => $request->get('delivery'),
            'price'       => $request->get('price'),
            'body'        => $request->get('body'),
        ]);

        $course->user->profile->location->update([
            'state'      => $request->get('state'),
            'city'       => $request->get('city'),
            'address'    => $request->get('address'),
        ]);

        $tags = $request->get('tags');

        if(! empty($tags))
        {
            $course->tags()->attach($tags);
        }

        if($request->file('photo'))
        {
            $photo = $request->file('photo')->store('public/course');
            $course->image()->create([
                'url' => Storage::url($photo)
            ]);
        }

        if($request->file('document'))
        {
            $document = $request->file('document')->store('public/course');
            $course->file()->create([
                'url'  => Storage::url($document),
            ]);
        }
        return redirect()->route('task.index')->withFlash('Curso creado');
    }

    public function show(Course $course)
    {
        return view('admin.courses.forms.show',compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.forms.update',compact('course'));
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update([
            'title'   => $request->get('title'),
            'body'    => $request->get('body'),
        ]);

        return back()->withFlash('Curso modificada');
    }

    public function destroy($id)
    {
        //
    }
}
