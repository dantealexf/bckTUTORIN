<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvisoryStoreRequest;
use App\Http\Requests\AdvisoryUpdateRequest;
use App\Models\Advisory;
use App\Models\Category;
use App\Models\Level;
use App\Models\Tag;
use App\Models\Zone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdvisoryController extends Controller
{

    public function index()
    {
        if (auth()->user()->admin)
        {
            $advisories = Advisory::all();
        }else{
            $advisories = auth()->user()->advisory;
        }
        return view('admin.advisories.index',compact('advisories'));
    }

    public function showStatuses($status)
    {
        if (auth()->user()->admin)
        {
            $advisories = (empty($status)) ?  null : Advisory::where('status',$status)->get();
        }else{
            $advisories = (empty($status)) ?  null : Advisory::where('status',$status)->where('user_id',auth()->user()->id)->get();
        }
        if($advisories == null)
            abort(404);
        return view('admin.advisories.index',compact('advisories'));
    }

    public function create()
    {
        $this->authorize('create', Advisory::class);

        return view('admin.advisories.forms.create',[
            'user'       => Auth::user(),
            'levels'     => Level::all(),
            'tags'       => Tag::all(),
            'zones'      => Zone::all(),
            'categories' => Category::all()
        ]);
    }

    public function store(AdvisoryStoreRequest $request)
    {
        $user = Auth::user();
        $zone = ($request->get('type') == 1) ? $request->get('zone') : null;

        $advisory = Advisory::create([
            'user_id'     => $user->id,
            'category_id' => $request->get('category'),
            'level_id'    => $request->get('level'),
            'zone_id'     => $zone,
            'hours'       => $request->get('hours'),
            'title'       => $request->get('title'),
            'delivery'    => $request->get('delivery'),
            'price'       => $request->get('price'),
            'virtual'     => ($request->get('type') == 0),
            'body'        => $request->get('body'),
        ]);

        $advisory->user->profile->location->update([
            'state'      => $request->get('state'),
            'city'       => $request->get('city'),
            'address'    => $request->get('address'),
        ]);

        $tags = $request->get('tags');

        if(! empty($tags))
        {
            $advisory->tags()->attach($tags);
        }

        if($request->file('photo'))
        {
            $photo = $request->file('photo')->store('public/advisory');
            $advisory->image()->create([
                'url'  => Storage::url($photo),
            ]);
        }

        if($request->file('document'))
        {
            $document = $request->file('document')->store('public/advisory');
            $advisory->file()->create([
                'url' => Storage::url($document),
            ]);
        }
        return redirect()->route('advisory.index')->withFlash('Asesoría creada');
    }

    public function show(Advisory $advisory)
    {
        $user = Auth::user();
        $view = $user->can('view',$advisory);
        if($view)
        {
            return view('admin.advisories.forms.show', compact('advisory'));
        }
        return abort('403');
    }

    public function edit(Advisory $advisory)
    {
        $user = Auth::user();
        $view = $user->can('update',$advisory);
        if($view)
        {
            return view('admin.advisories.forms.update',compact('advisory'));
        }
        return abort('403');
    }

    public function update(AdvisoryUpdateRequest $request, Advisory $advisory)
    {
        $advisory->update([
            'title'   => $request->get('title'),
            'body'    => $request->get('body'),
        ]);

        return back()->withFlash('Asesoría modificada');
    }

    public function destroy($id)
    {
        //
    }
}
