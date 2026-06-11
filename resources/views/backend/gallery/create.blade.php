@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('Upload New Image')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('admingallery.index') }}" class="btn btn-link text-reset">
				<i class="las la-angle-left"></i>
				<span>{{translate('Back to Gallery')}}</span>
			</a>
		</div>
	</div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Drag & drop your files')}}</h5>
    </div>
    <div class="card-body">
 <form class="form form-horizontal mar-top" action="{{route('admingallery.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf
         <div class="card-body">
                       
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Gallery Image')}}</label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="gallery_image" class="selected-files" required="">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <samll class="text-danger">{{$errors->first('gallery_image')}}</samll>
                                <!--<small class="text-muted">Please Upload Banner Image Size Min 1200 x 600 is Required.</small>-->
                            </div>
                        </div>
                    </div>
        <!--<div class="form-group">-->
        <!--            <img src="" width="250px" id="galleryimage" alt>-->
        <!--          </div>-->
        <div class="form-group">
                <button type="submit" id="form-submit" class="btn btn-primary btn-sm">Upload</button>
                  </div>
    </form>
    
    </div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
// 		$(document).ready(function() {
// 			AIZ.plugins.aizUppy();
// 		});
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
//   <script>
//         $(document).ready(function(){
//             $('#storeform').on('submit',function(event){
//                 alert('dcgvdfgf');
//                 event.preventDefault();
//                 $.ajax({
//              url:"",
//                 type: 'POST',
//                 data:new FormData(this),
//                 dataType: "json",
//                 contentType: false,
//                 cache: false,
//                 processData: false,
//                 success:function(data){
//                     alert('edfd');
//                     $('#photo').val(null);
//                     $('#galleryimage').attr('src', null);
//              }
//         });
//         });
//         });
//     </script>
@endsection