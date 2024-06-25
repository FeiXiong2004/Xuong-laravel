<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogues;
use Illuminate\Support\Facades\Storage;


class CataloguesController extends Controller
{   
    const PATH_VIEW = 'admin.catalogues.';
    const PATH_UPLOAD = 'catalogues';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogues = Catalogues::query()->paginate(5);
   
        return view(self::PATH_VIEW .  __FUNCTION__ ,compact('catalogues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__ );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $catalogues = $request->except('cover');
        $catalogues['is_active'] ??= 0;
        if($request->hasFile('cover')){
            $catalogues['cover'] = Storage::put(self::PATH_UPLOAD,$request->file('cover'));
        }
        Catalogues::query()->create($catalogues);

        return redirect()->route('admin.catalogues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catalogue = Catalogues::query()->findOrFail($id);
        // $catalogue['is_active'] = $request->input('is_active',0);    
      
        return view(self::PATH_VIEW . __FUNCTION__ ,compact('catalogue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catalogue = Catalogues::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__ ,compact('catalogue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $catalogue =  Catalogues::query()->findOrFail($id);
        $data = $request->except('cover');
        $data['is_active'] ??= 0;
        if($request->hasFile('cover')){
            $data['cover'] = Storage::put(self::PATH_UPLOAD,$request->file('cover'));
        }
        $currentCover = $catalogue->cover;
        $catalogue->update($data);

        if($request->hasFile('cover') &&    $currentCover && Storage::exists(self::PATH_UPLOAD)){
            Storage::delete($currentCover);
        }
        return redirect()->route('admin.catalogues.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalogue = Catalogues::findOrFail($id)->delete();
        // if($catalogue->cover && Storage::exists(self::PATH_UPLOAD)){
        //     Storage::delete($catalogue->cover);
        // }
        return redirect()->route('admin.catalogues.index');
    }
}
