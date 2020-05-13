<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

    public function index()
    {
        $profiles = Profile::where('verified',1)
                            ->orWhere('request',1)
                            ->get();
        return view('admin.teachers.index',compact('profiles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.teachers.form.show',compact('user'));
    }

    public function addFile(Request $request)
    {
        $user = User::find($request->get('user_id'));
        if($request->file('file'))
        {
            $document = $request->file('file')->store('public/profiles');
            $user->profile->documents()->create([
                'url'      => Storage::url($document),
                'type'     => $request->get('type'),
                'verified' => false
            ]);
        }
        return back()->withFlash('Anexo creado');
    }

    public function message(Request $request)
    {
        $user = User::find($request->get('user_id'));
        $user->profile->update([
            'verified' => $request->get('verified'),
            'message'  => $request->get('message'),
            'viewed'  => false,
        ]);
        return back()->withFlash('Mensaje enviado, estado asignado');
    }

    public function viewed(Request $request)
    {
        $user = User::find($request->get('user_id'));
        $user->profile->update([
            'viewed'  => true,
            'message' => ''
        ]);
        return back();
    }

    public function verifyDocument(Request $request)
    {
        $document = Document::find($request->get('document'));
        $document->update([
            'verified' => true
        ]);
        return back()->withFlash('Documento verificado');
    }

    public function showStatuses($status)
    {
        if ($status == 'verified'){
            $profiles = (empty($status)) ?  null : Profile::where('verified',true)->get();
        }else{
            $profiles = (empty($status)) ?  null : Profile::where('request',true)->get();
        }

        if($profiles == null)
            abort(404);

        return view('admin.teachers.index',compact('profiles'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
