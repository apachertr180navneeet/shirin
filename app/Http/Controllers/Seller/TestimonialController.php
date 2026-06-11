<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function __construct() {
        // Testimonial Permission Check
        $this->middleware(['permission:view_all_testimonials'])->only('index');
        $this->middleware(['permission:add_testimonial'])->only('create');
        $this->middleware(['permission:edit_testimonial'])->only('edit');
        $this->middleware(['permission:delete_testimonial'])->only('destroy');
        $this->middleware(['permission:publish_testimonial'])->only('change_status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::paginate(10);
        return view('backend.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $testimonials = new Testimonial;
        $testimonials->name = $request->name;
        $testimonials->designation = $request->designation;
        $testimonials->rating = $request->rating;
        $testimonials->comment = $request->comment;
        $testimonials->photos = $request->photos;
        $testimonials->save();

        flash(translate('Testimonials inserted successfully'))->success();
        return redirect()->route('testimonial.index');
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
        $testimonials = Testimonial::findorFail(decrypt($id));
        return view('backend.testimonial.edit',compact('testimonials'));
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
        $testimonials = Testimonial::findorFail($id);
        $testimonials->name = $request->name;
        $testimonials->designation = $request->designation;
        $testimonials->rating = $request->rating;
        $testimonials->comment = $request->comment;
        $testimonials->photos = $request->photos;
        $testimonials->save();

        flash(translate('Testimonials updated successfully'))->success();
        return redirect()->route('testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Testimonial::destroy($id)){
            flash(translate('Testimonials has been deleted successfully'))->success();
            return back();
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    // published/unpublished testimonial 
    public function change_status(Request $request) {
        $testimonials = Testimonial::find($request->id);
        $testimonials->status = $request->status;
        
        $testimonials->save();
        return 1;
    }
}
