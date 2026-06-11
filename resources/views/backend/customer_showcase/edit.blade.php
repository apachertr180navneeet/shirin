@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{ translate('Customer Showcase Information') }}</h5>
</div>

<div class="row">
  <div class="col-lg-6 mx-auto">
      <div class="card">
            <div class="card-header">
    			<h5 class="mb-0 h6">{{ translate('Edit Customer Showcase') }}</h5>
    	    </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('customer_showcase.update', $customer_showcase->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="showcase_image">{{ translate('Image') }}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="showcase_image" value="{{$customer_showcase->showcase_image}}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>

                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ translate('Update') }}
                            </button>
                    </div>
                </form>
            </div>
      </div>
  </div>
</div>

@endsection
