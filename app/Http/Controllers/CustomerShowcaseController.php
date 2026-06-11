<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerShowcase;

class CustomerShowcaseController extends Controller
{
    public function __construct() {
        // Instagram Reels Permission Check
        $this->middleware(['permission:view_all_customer-showcases'])->only('index');
        $this->middleware(['permission:add_customer-showcase'])->only('create');
        $this->middleware(['permission:edit_customer-showcase'])->only('edit');
        $this->middleware(['permission:delete_customer-showcase'])->only('destroy');
        $this->middleware(['permission:publish_customer-showcase'])->only('change_status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_showcase = CustomerShowcase::paginate(15);
        return view('backend.customer_showcase.index', compact('customer_showcase'));
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
        $customer_showcase = new CustomerShowcase;

        $customer_showcase->showcase_image = $request->showcase_image;
        $customer_showcase->save();

        flash(translate('Customer Showcase has been inserted successfully'))->success();
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
        $customer_showcase = CustomerShowcase::findorFail(decrypt($id));
        return view('backend.customer_showcase.edit',compact('customer_showcase'));
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
        $customer_showcase = CustomerShowcase::findorFail($id);;

        $customer_showcase->showcase_image = $request->showcase_image;
        $customer_showcase->save();

        flash(translate('Customer Showcase updated successfully'))->success();
        return redirect()->route('customer_showcase.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(CustomerShowcase::destroy($id)){
            flash(translate('Customer Showcase has been deleted successfully'))->success();
            return back();
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    // published/unpublished customer showcase 
    public function change_status(Request $request) {
        $customer_showcase = CustomerShowcase::find($request->id);
        $customer_showcase->status = $request->status;
        
        $customer_showcase->save();
        return 1;
    }
}
