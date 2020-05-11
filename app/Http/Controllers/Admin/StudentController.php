<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Location;
use App\Models\Profile;
use App\Models\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{

    public function index()
    {
        $students = User::where('admin','=',1)->orderBy('id','DESC')->get();
        return view('admin.students.index',compact('students'));
    }

    public function create()
    {

        return view('admin.students.form.create',[
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function store(StudentStoreRequest $request)
    {

        $user = User::create([
            'name'              => $request->get('name'),
            'email'             => $request->get('email'),
            'email_verified_at' => now(),
            'password'          => Hash::make($request->get('password')),
            'birthday'          => $request->get('birthday'),
            'gender'            => $request->get('gender'),
            'mobile'            => $request->get('mobile'),
            'active'            => 0,
            'admin'             => 1,
        ]);

        $profile = $user->profile()->create();

        Location::create([
            'profile_id' => $user->profile->id,
            'state'      => $request->get('state'),
            'city'       => $request->get('city'),
            'address'    => $request->get('address'),
        ]);

        $categories = $request->get('categories');
        $tags = $request->get('tags');

        if(! empty($categories))
        {
            $user->profile->categories()->attach($categories);
        }

        if(! empty($tags))
        {
            $user->profile->tags()->attach($tags);
        }

        if($request->file('avatar'))
        {
            $photo = $request->file('avatar')->store('public/avatar');
            $user->image()->create([
                'url' => Storage::url($photo)
            ]);
        }


        return redirect()->route('students.index')->withFlash('Estudiante creado');

    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.students.form.show',[
            'student' => $user,
        ]);
    }

    public function edit($id)
    {
        $student = User::find($id);

        return view('admin.students.form.update',[
            'student'    => $student,
            'tags'       => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {

       $user = User::find($id);

        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => ['required',Rule::unique('users')->ignore($user->id)],
            'gender'                => 'required',
            'mobile'                => ['required',Rule::unique('users')->ignore($user->id)],
            'state'                 => 'required',
            'city'                  => 'required',
            'address'               => 'required',
            'photo'                 => 'mimes:jpeg,jpg,png,gif|max:2048',
            'tags'                  => 'array|size:7',
            'categories'            => 'array|size:3',
        ]);

        $user->update([
            'name'              => $request->get('name'),
            'email'             => $request->get('email'),
            'birthday'          => $request->get('birthday'),
            'gender'            => $request->get('gender'),
            'mobile'            => $request->get('mobile'),
            'active'            => 0,
            'admin'             => 1,
        ]);

        $categories = $request->get('categories');
        $tags = $request->get('tags');

        if(! empty($categories))
        {
            $user->profile->categories()->sync($categories);
        }

        if(! empty($tags))
        {
            $user->profile->tags()->sync($tags);
        }

        $user->profile->location->update([
            'state'      => $request->get('state'),
            'city'       => $request->get('city'),
            'address'    => $request->get('address'),
        ]);

        return redirect()->route('students.index')->withFlash('Estudiante modificado');
    }

    public function destroy(User $user)
    {
        dd($user->id);
    }
}
