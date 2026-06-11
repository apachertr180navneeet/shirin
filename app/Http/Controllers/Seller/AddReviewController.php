<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddReview;
use App\Models\AddReviewTranslation;
use App\Models\Product;
use Illuminate\Support\Str;

class AddReviewController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:view_all_add_review'])->only('index');
        $this->middleware(['permission:add_add_review'])->only('create');
        $this->middleware(['permission:edit_add_review'])->only('edit');
        $this->middleware(['permission:delete_add_review'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $add_reviews = AddReview::orderBy('customer_name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $add_reviews = $add_reviews->where('customer_name', 'like', '%'.$sort_search.'%')->orwhere('product_name', 'like', '%'.$sort_search.'%');
        }
        $add_reviews = $add_reviews->paginate(10);
       
        return view('backend.add_reviews.index', compact('add_reviews', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.add_reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add_reviews = new AddReview;
        $add_reviews->customer_name = $request->customer_name;
        $add_reviews->customer_image = $request->customer_image;
        
        $add_reviews->comment = $request->comment;
        
        $add_reviews->product_id = $request->product_id;
       
        
        $add_reviews->save();

        $add_reviews_translation = AddReviewTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'add_review_id' => $add_reviews->id]);
        $add_reviews_translation->customer_name = $request->customer_name;
        $add_reviews_translation->comment = $request->comment;
        
        $add_reviews_translation->save();

        flash(translate('AddReviews has been inserted successfully'))->success();
        return redirect()->route('add_reviews.index');

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
    public function edit(Request $request, $id)
    {
        $lang   = $request->lang;
        $add_reviews  = AddReview::findOrFail($id);
        
        return view('backend.add_reviews.edit', compact('add_reviews','lang'));
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
        $add_reviews = AddReview::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $add_reviews->customer_name = $request->customer_name;
            $add_reviews->comment = $request->comment;
            $add_reviews->product_id = $request->product_id;
        }
        $add_reviews->customer_name = $request->customer_name;
        $add_reviews->customer_image = $request->customer_image;
        
        $add_reviews->comment = $request->comment;
        
        $add_reviews->product_id = $request->product_id;
        
        
      
        $add_reviews->save();

        $add_reviews_translation = AddReviewTranslation::firstOrNew(['lang' => $request->lang, 'add_review_id' => $add_reviews->id]);
        $add_reviews_translation->customer_name = $request->customer_name;
        $add_reviews_translation->comment = $request->comment;
        $add_reviews_translation->save();

        flash(translate('AddReviews has been updated successfully'))->success();
        return redirect()->route('add_reviews.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

        $add_reviews = AddReview::findOrFail($id);
        if(AddReview::destroy($id)){
            //unlink($add_reviews->photo);
            flash(translate('AddReview has been deleted successfully'))->success();
        }
        else{
            flash(translate('Something went wrong'))->error();
        }
        return redirect()->route('add_reviews.index');

    }
    
    
    public function updatePublished(Request $request)
    {
        try {
            $add_reviews = AddReview::find($request->id);
            if (!$add_reviews) {
                return response()->json(['status' => 0, 'error' => 'AddReview not found!'], 404);
            }
    
            // Agar status same hai toh dobara update na karein
            if ($add_reviews->published == $request->status) {
                return response()->json([
                    'status' => (int) $add_reviews->published,
                    'message' => 'No change required'
                ]);
            }
    
            $add_reviews->published = $request->status;
            $add_reviews->save();
    
            return response()->json([
                'status' => (int) $add_reviews->published
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => 'Something went wrong!'], 500);
        }
    }
    





}
