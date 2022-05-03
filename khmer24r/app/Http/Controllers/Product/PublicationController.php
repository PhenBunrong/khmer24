<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PublicationController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Publication::where('status',1)->latest()->paginate(10);
        return view('admin.product.publication.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.publication.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
        ]);

        $publication = Publication::create($request->except('image'));

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/publication/',$filename);
        }

        
        // if($request->hasFile('image')){
        //     $publication->image = Storage::put('uploads/publication',$request->file('image'));
        //     $publication->save();
        // }

        $publication->image = $filename;
        $publication->slug = Str::slug($publication->name);
        $publication->creator = Auth::user()->id;
        $publication->save();

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        return view('admin.product.publication.edit',compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        $this->validate($request,[
            'name' => ['required'],
            'description' => ['required']
        ]);

        $publication->update($request->except('image'));

        if($request->hasFile('image')){
            // Delete old image
            $pathImage = 'uploads/publication/'.$publication->image;
            if(File::exists($pathImage))
            {
                File::delete($pathImage);
            }
 
            // Store image
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/publication/',$filename);
            
            // Save to Datebase
            $publication->image = $filename;
        }

        $publication->slug = Str::slug($publication->name);
        $publication->creator = Auth::user()->id;
        $publication->save();

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        $pathImage = 'uploads/publication/'.$publication->image;
        if(File::exists($pathImage))
        {
            File::delete($pathImage);
        }

        $publication->delete();
        
        return response()->json([
            'success' => true
        ]);
    }
}
