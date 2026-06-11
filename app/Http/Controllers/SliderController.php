<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\BottomSection;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate(15);
        return view('backend.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create');
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
            'slider_image' => 'required',
            ]);
                $slider = new Slider;
                $slider->photo = $request->slider_image;
                $slider->mobile_slider = $request->mobile_slider;
                $slider->save();
            flash(translate('Slider has been inserted successfully'))->success();
        return redirect()->route('adminslider.index');
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
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit', compact('slider'));
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
        $slider = Slider::findOrFail($id);

        if ($request->has('status')) {
            $slider->published = $request->status;
            if($slider->save()){
                return '1';
            } else {
                return '0';
            }
        }

        if ($request->filled('slider_image')) {
            $slider->photo = $request->slider_image;
        }
        $slider->mobile_slider = $request->mobile_slider;
        $slider->save();
        flash(translate('Slider has been updated successfully'))->success();
        return redirect()->route('adminslider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if(Slider::destroy($id)){
            //unlink($slider->photo);
            flash(translate('Slider has been deleted successfully'))->success();
        }
        else{
            flash(translate('Something went wrong'))->error();
        }
        return redirect()->route('adminslider.index');
    }
    
     public function bottomsection()
     {
         $section="";
         $section=BottomSection::first();
         if($section){
           
         } 
         return view('backend.slider.bottom',compact('section'));    
     }
    
     public function bottomsectionstore(Request $request)
    {
        
     $request->validate([
            'description' => 'required',
            ]);
        $section=BottomSection::first();
        if($section){
                $slider = BottomSection::find('1');
                $slider->data = $request->description;
                $slider->save();
        }
        else{
                $slider = new BottomSection;
                $slider->data = $request->description;
                $slider->save();
        }
            
            flash(translate('Bottom Section has been inserted successfully'))->success();
        return back();
  
  
    }
    
    
}
