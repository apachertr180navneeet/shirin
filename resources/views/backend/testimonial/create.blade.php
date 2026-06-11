@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Testimonial Information')}}</h5>
            </div>

            <form class="form-horizontal" action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="photos">{{translate('Photos')}}</label>
                        <div class="col-sm-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="photos" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="designation">{{translate('Designation')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Designation')}}" id="designation" name="designation" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="rating">{{translate('Rating')}}</label>
                        <div class="col-sm-9">
                            <div class="rating rating-input">
                                <label>
                                    <input type="radio" name="rating" value="1" required>
                                    <i class="las la-star"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="2">
                                    <i class="las la-star"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="3">
                                    <i class="las la-star"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="4">
                                    <i class="las la-star"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="5">
                                    <i class="las la-star"></i>
                                </label>
                            </div>
                            <!-- <input type="text" placeholder="{{translate('Rating')}}" id="rating" name="rating" class="form-control" required> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="comment">{{translate('Comment')}}</label>
                        <div class="col-md-9">
                            <textarea name="comment" rows="8" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
