@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Testimonials Information')}}</h5>
            </div>

            <form action="{{ route('testimonial.update', $testimonials->id) }}" method="POST">
                <input name="_method" type="hidden" value="PATCH">
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
                                <input type="hidden" name="photos" value="{{$testimonials->photos}}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" value="{{ $testimonials->name }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="designation">{{translate('Designation')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Designation')}}" id="designation" name="designation" value="{{ $testimonials->designation }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{ translate('Rating') }}</label>
                        <div class="col-sm-9">
                            <div class="rating rating-input d-flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <label class="mr-2" style="cursor:pointer;">
                                        <input type="radio" name="rating" value="{{ $i }}" {{ $testimonials->rating == $i ? 'checked' : '' }} hidden required>
                                        <i class="las la-star {{ $testimonials->rating >= $i ? 'active' : '' }}"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="comment">{{translate('Comment')}}</label>
                        <div class="col-md-9">
                            <textarea name="comment" rows="8" class="form-control">{{$testimonials->comment}}</textarea>
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
