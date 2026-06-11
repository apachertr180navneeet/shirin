@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Images')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('admingallery.create') }}" class="btn btn-primary">
				<span>{{translate('Upload New Images')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <form id="sort_uploads" action="">
        <div class="card-header row gutters-5">
            <div class="col-md-3">
                <h5 class="mb-0 h6">{{translate('All Images')}}</h5>
            </div>
             <div class="col-md-9">
                <!--<p class="mb-0">Please Upload Banner Image Size 1920 x 600 for better and effective visualization.</p>-->
            </div>

        </div>
    </form>
    <div class="card-body">
    	<div class="row gutters-5">
    		@foreach($gallery as $key => $file)
    			<div class="col-auto w-140px w-lg-220px">
    				<div class="aiz-file-box">
    					<div class="dropdown-file" >
    						<a class="dropdown-link" data-toggle="dropdown">
    							<i class="la la-ellipsis-v"></i>
    						</a>
    						<div class="dropdown-menu dropdown-menu-right">
    							<a href="javascript:void(0)" class="dropdown-item confirm-alert" data-href="{{ route('gallery.destroy', $file->id ) }}" data-target="#delete-modal">
    								<i class="las la-trash mr-2"></i>
    								<span>{{ translate('Delete') }}</span>
    							</a>
    						</div>
    					</div>
    					<div class="card card-file aiz-uploader-select c-default">
    						<div class="card-file-thumb">
    							@if($file->photo != null)
    								<img src="{{ uploaded_asset($file->photo)}}" class="img-fit">
    							@endif
    						</div>
    					</div>
    				</div>
    			</div>
    		@endforeach
    	</div>
		<div class="aiz-pagination mt-3">
			{{ $gallery->appends(request()->input())->links() }}
		</div>
    </div>
</div>
@endsection
@section('modal')
<div id="delete-modal" class="modal fade">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1">{{ translate('Are you sure to delete this file?') }}</p>
                <button type="button" class="btn btn-link mt-2" data-dismiss="modal">{{ translate('Cancel') }}</button>
                <a href="" class="btn btn-primary mt-2 comfirm-link">{{ translate('Delete') }}</a>
            </div>
        </div>
    </div>
</div>
<div id="info-modal" class="modal fade">
	<div class="modal-dialog modal-dialog-right">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h6">{{ translate('File Info') }}</h5>
				<button type="button" class="close" data-dismiss="modal">
				</button>
			</div>
			<div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
				<div class="c-preloader text-center absolute-center">
                    <i class="las la-spinner la-spin la-3x opacity-70"></i>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
	<script type="text/javascript">
// 		function detailsInfo(e){
		
//             $('#info-modal-content').html('<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>');
// 			var id = $(e).data('id')
// 			$('#info-modal').modal('show');
// 			$.post('{{ route('uploaded-files.info') }}', {_token: AIZ.data.csrf, id:id}, function(data){
//                 $('#info-modal-content').html(data);
// 				// console.log(data);
// 			});
// 		}
// 		function copyUrl(e) {
// 			var url = $(e).data('url');
// 			var $temp = $("<input>");
// 		    $("body").append($temp);
// 		    $temp.val(url).select();
// 		    try {
// 			    document.execCommand("copy");
// 			    AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
// 			} catch (err) {
// 			    AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
// 			}
// 		    $temp.remove();
// 		}
        // function sort_uploads(el){
        //     $('#sort_uploads').submit();
        // }
	</script>
@endsection