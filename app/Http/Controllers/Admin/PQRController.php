<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pqr;
use Illuminate\Http\Request;

class PQRController extends Controller
{

    public function index()
    {
        $pqrs = Pqr::all();
        return view('admin.pqr.index',compact('pqrs') );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(PQR $pqr)
    {
        return view('admin.pqr.form.show',compact('pqr'));
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
