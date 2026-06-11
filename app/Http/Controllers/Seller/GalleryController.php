<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\BottomSection;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::paginate(15);
        return view('backend.gallery.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gallery_image' => 'required',
            ]);
                $gallery = new Gallery;
                $gallery->photo = $request->gallery_image;
                $gallery->save();
            flash(translate('Gallery has been inserted successfully'))->success();
        return redirect()->route('admingallery.index');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->published = $request->status;
        if($gallery->save()){
            return '1';
        }
        else {
            return '0';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if(Gallery::destroy($id)){
            //unlink($slider->photo);
            flash(translate('Gallery has been deleted successfully'))->success();
        }
        else{
            flash(translate('Something went wrong'))->error();
        }
        return redirect()->route('admingallery.index');
    }
    
     public function bottomsection()
     {
         $section="";
         $section=BottomSection::first();
         if($section){
           
         } 
         return view('backend.gallery.bottom',compact('section'));    
     }
    
     public function bottomsectionstore(Request $request)
    {
        
     $request->validate([
            'description' => 'required',
            ]);
        $section=BottomSection::first();
        if($section){
                $gallery = BottomSection::find('1');
                $gallery->data = $request->description;
                $gallery->save();
        }
        else{
                $gallery = new BottomSection;
                $gallery->data = $request->description;
                $gallery->save();
        }
            
            flash(translate('Bottom Section has been inserted successfully'))->success();
        return back();
  
  
    }
    
    
    // frontend gallery show 
    public function frontend_gallery(){
        $gallery_show = Gallery::orderBy('id','desc')->get();
        return view('frontend.gallery', compact('gallery_show'));
    }
    
    
}

