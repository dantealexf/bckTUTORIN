<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZoneStoreRequest;
use App\Http\Requests\ZoneUpdateRequest;
use App\Models\Advisory;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::orderBy('id', 'DESC')->get();
        return view('admin.zones.index',compact('zones'));
    }

    public function create()
    {
        return view('admin.zones.index');
    }

    public function store(ZoneStoreRequest $request)
    {
        $zone = Zone::create($request->all());
        return redirect()->route('zone.index')->withFlash('Zona guardada');
    }

    public function show(Zone $zone)
    {
        $tasks = Advisory::where('zone_id',$zone->id)->get();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Zone $zone,ZoneUpdateRequest $request)
    {
        $zone = Zone::update($request->all());
        return redirect()->route('zone.index')->withFlash('Zona modificada');
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zone.index')->withFlash('Zona eliminada');
    }
}
