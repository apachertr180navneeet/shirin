@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('Edit Slider')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('adminslider.index') }}" class="btn btn-link text-reset">
				<i class="las la-angle-left"></i>
				<span>{{translate('Back to Slider')}}</span>
			</a>
		</div>
	</div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Edit Slider')}}</h5>
    </div>
    <div class="card-body">
 <form class="form form-horizontal mar-top" action="{{route('adminslider.update', $slider->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf
        @method('PUT')
         <div class="card-body">

                        <div class="form-group row">
                             <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Slider Image')}}</label>
                             <div class="col-md-8">
                                 <div class="input-group" data-toggle="aizuploader" data-type="image">
                                     <div class="input-group-prepend">
                                         <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                     </div>
                                     <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                     <input type="hidden" name="slider_image" class="selected-files" value="{{ $slider->photo }}">
                                 </div>
                                 <div class="file-preview box sm">
                                 </div>
                                 <samll class="text-danger">{{$errors->first('slider_image')}}</samll>
                                 <small class="text-muted">Please Upload Banner Image Size Min 1200 x 600 is Required.</small>
                             </div>
                         </div>
                          <div class="form-group row">
                             <label class="col-md-3 col-form-label" for="mobile_slider">{{translate('Mobile Slider Image')}}</label>
                             <div class="col-md-8">
                                 <div class="input-group" data-toggle="aizuploader" data-type="image">
                                     <div class="input-group-prepend">
                                         <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                     </div>
                                     <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                     <input type="hidden" name="mobile_slider" class="selected-files" value="{{ $slider->mobile_slider }}">
                                 </div>
                                 <div class="file-preview box sm">
                                 </div>
                                 <small class="text-muted">{{translate('Optional: Upload mobile-specific slider image')}}</small>
                             </div>
                         </div>
                     </div>
        <div class="form-group">
                <button type="submit" id="form-submit" class="btn btn-primary btn-sm">{{translate('Update')}}</button>
                  </div>
    </form>

    </div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
</script>
	<script>
    var loadimageFile = function (event, imgid) {
      var output = document.getElementById(imgid);
      output.src = URL.createObjectURL(event.target.files[0]);
    };

      function hide() {
          document.getElementById('submit_btn').style.display = 'none'
      }
  </script>
@endsection