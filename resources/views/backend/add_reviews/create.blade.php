@extends('backend.layouts.app')

@section('content')

<div class="row">
    	@can('add_add_review')
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">{{ translate('Add New Reviews') }}</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('add_reviews.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<label class="col-md-2 col-form-label" for="product_id">{{translate('Product Name')}}</label>
						<div class="col-md-10">
						    <select class="form-control aiz-selectpicker" name="product_id" id="product_id" data-live-search="true">
                                <option value="">{{ translate('Select Product') }}</option>
                                @foreach (\App\Models\Product::orderBy('created_at','desc')->get() as $product)
                                <option value="{{ $product->id }}">{{ $product->getTranslation('name') }}</option>
                                @endforeach
                            </select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label" for="customer_name">{{translate('Customer Name')}}</label>
						<div class="col-md-10">
						    <input type="text" placeholder="{{translate('Customer Name')}}" name="customer_name" class="form-control" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label" for="customer_image">{{translate('Customer Image')}} <small>({{ translate('120x80') }})</small></label>
						<div class="col-md-10">
						    <div class="input-group" data-toggle="aizuploader" data-type="image">
						    	<div class="input-group-prepend">
						    		<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
						    	</div>
						    	<div class="form-control file-amount">{{ translate('Choose File') }}</div>
						    	<input type="hidden" name="customer_image" class="selected-files">
						    </div>
						
						    <div class="file-preview box sm">
						    </div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label" for="comment">{{translate('Comment')}}</label>
						<div class="col-md-10">
						    <input type="text" placeholder="{{translate('Comment')}}" name="comment" class="form-control" required>
						</div>
					</div>
					
					<div class="form-group mb-3 text-right">
						<button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endcan
</div>

@endsection