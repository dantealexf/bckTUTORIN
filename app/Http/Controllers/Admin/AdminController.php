<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Models\Comment;
use App\Models\File;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Task;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function index()
    {
        $users = User::where('admin',true)->get();
        return view('admin.Admins.index',compact('users'));
    }

    public function create()
    {
        return view('admin.Admins.form.create');
    }

    public function store(StudentStoreRequest $request)
    {
        $user = User::create($request->all());
        $user->update([
            'active'            => true,
            'admin'             => true,
        ]);

        $user->profile()->make();

        return $user;

    }

    public function show(User $user)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy(User $user)
    {

    }


    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->withFlash('Comentario eliminado');
    }

    public function deleteOffer(Offer $offer)
    {
        $offer->delete();
        return redirect()->back()->withFlash('Propuesta eliminada');
    }

    public function deleteImage(Image $image)
    {
        $image->delete();
        return redirect()->back()->withFlash('Imagen eliminada');
    }

    public function deleteDocument(File $file)
    {
        $file->delete();
        return redirect()->back()->withFlash('Documento eliminado');
    }

}
