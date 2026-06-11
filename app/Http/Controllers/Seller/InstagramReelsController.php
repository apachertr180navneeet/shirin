<?php

namespace App\Http\Controllers;

use App\Models\InstagramReel;
use Illuminate\Http\Request;

class InstagramReelsController extends Controller
{
    public function __construct() {
        // Instagram Reels Permission Check
        $this->middleware(['permission:view_all_insta-reels'])->only('index');
        $this->middleware(['permission:add_insta-reel'])->only('create');
        $this->middleware(['permission:edit_insta-reel'])->only('edit');
        $this->middleware(['permission:delete_insta-reel'])->only('destroy');
        $this->middleware(['permission:publish_insta-reel'])->only('change_status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insta_reels = InstagramReel::paginate(10);
        return view('backend.insta_reels.index', compact('insta_reels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insta_reels = new InstagramReel;

        $insta_reels->url = $request->url;

        $insta_reels->save();

        flash(translate('Instagram Reels Stored successfully'))->success();
        return back();
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
        $insta_reels = InstagramReel::findorFail(decrypt($id));
        return view('backend.insta_reels.edit',compact('insta_reels'));
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
        $insta_reels = InstagramReel::findorFail($id);

        $insta_reels->url = $request->url;

        $insta_reels->save();

        flash(translate('Instagram Reels Updated successfully'))->success();
        return redirect()->route('insta-reels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(InstagramReel::destroy($id)){
            flash(translate('Instagram Reels has been deleted successfully'))->success();
            return back();
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    // published/unpublished insta reels 
    public function change_status(Request $request) {
        $insta_reels = InstagramReel::find($request->id);
        $insta_reels->status = $request->status;
        
        $insta_reels->save();
        return 1;
    }
}
