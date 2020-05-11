<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\File;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{

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
