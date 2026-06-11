@extends('backend.layouts.app')

@section('content')

<style>
	.aiz-file-box .card-file .card-file-thumb {
    position: absolute;
    width: calc(100% - 16px);
    top: 8px;
    left: 8px;
    height: calc(100% - 18px);
}
</style>
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Reviews')}}</h1>
        </div>
        @can('add_add_review')
            <div class="col-md-6 text-md-right">
                <a href="{{route('add_reviews.create')}}" class="btn btn-primary">
                    <span>{{translate('Add New Reviews')}}</span>
                </a>
            </div>
        @endcan
    </div>
</div>
<!--<div class="aiz-titlebar text-left mt-2 mb-3">-->
<!--	<div class="align-items-center">-->
<!--		<h1 class="h3">{{translate('All Reviews')}}</h1>-->
<!--	</div>-->
<!--</div>-->

<div class="row">
	<div class="@if(auth()->user()->can('add_reviews')) col-lg-12 @else col-lg-10 @endif">
		<div class="card">
			<div class="card-header row gutters-5">
				<div class="col text-center text-md-left">
					<h5 class="mb-md-0 h6">{{ translate('Our Reviews') }}</h5>
				</div>
				<div class="col-md-4">
					<form class="" id="sort_add_reviews" action="" method="GET">
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
						</div>
					</form>
				</div>
			</div>
			<div class="card-body">
				<table class="table aiz-table mb-0">
					<thead>
						<tr>
							<th>#</th>
							<th>{{translate('Customer Name')}}</th>
							<th>{{translate('Customer Image')}}</th>
							<th>{{translate('Product Name')}}</th>
							<th>{{translate('Product Image')}}</th>
							<th>{{translate('Comment')}}</th>
							<th>{{translate('Published')}}</th>
							<th class="text-right">{{translate('Options')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($add_reviews as $key => $add_review)
						<tr>
							<td>{{ ($key+1) + ($add_reviews->currentPage() - 1)*$add_reviews->perPage() }}</td>
							<td>{{ $add_review->getTranslation('customer_name') }}</td>
							<td>
							    @if($add_review->customer_image != null)
								<div class="col-auto w-100px w-lg-120px">
									<div class="aiz-file-box">
										<div class="card card-file aiz-uploader-select c-default">
											<div class="card-file-thumb">
												
												<img src="{{ uploaded_asset($add_review->customer_image) }}" alt="{{translate('Reviews')}}" class="img-fit">
												
											</div>
										</div>
									</div>
								</div>
								@else
								<div class="text-center">
								    —
								</div>
                                    
								@endif
							</td>
							<td>{{ $add_review->product->getTranslation('name') }}</td>
							<td>
								<span class="avatar avatar-square avatar-xs">
									@if($add_review->product->thumbnail_img != null)
									<img src="{{ uploaded_asset($add_review->product->thumbnail_img) }}" alt="{{translate('Reviews')}}" class="img-fit">
									@else
                                        —
									@endif
								</span>
							</td>
							<td>{{ $add_review->getTranslation('comment') }}</td>
							
							
							<td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_published(this)" value="{{ $add_review->id }}" type="checkbox" <?php if ($add_review->published == 1) echo "checked"; ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
						
							<td class="text-right">
								@can('edit_add_review')
								<a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('add_reviews.edit', ['id'=>$add_review->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
									<i class="las la-edit"></i>
								</a>
								@endcan
								@can('delete_add_review')
								<a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('add_reviews.destroy', $add_review->id)}}" title="{{ translate('Delete') }}">
									<i class="las la-trash"></i>
								</a>
								@endcan
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="aiz-pagination">
					{{ $add_reviews->appends(request()->input())->links() }}
				</div>
			</div>
		</div>
	</div>
	
</div>

@endsection


@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
	function sort_add_reviews(el) {
		$('#sort_add_reviews').submit();
	}
	
	

	$(document).ready(function() {
    $('body').off('change', 'input[type="checkbox"].publish-toggle') // Pehle purane event hatao
        .on('change', 'input[type="checkbox"].publish-toggle', function() {
        
        var el = this;

        // Prevent multiple requests
        if ($(el).data('processing')) {
            return;
        }
        $(el).data('processing', true); // Mark as processing

        update_published(el);
    });
});

function update_published(el) {
    var status = el.checked ? 1 : 0;

    $.post('{{ route('add_reviews.published') }}', {
        _token: '{{ csrf_token() }}',
        id: el.value,
        status: status
    }, function(response) {
        console.log("Success:", response);

        el.checked = response.status == 1;

        setTimeout(function() {
            AIZ.plugins.notify('success', 'Published Reviews updated successfully!');
        }, 100);

    }).fail(function(xhr) {
        console.log("AJAX Error:", xhr.responseText);
        AIZ.plugins.notify('danger', 'AJAX request failed! Check console for errors.');
    }).always(function() {
        $(el).data('processing', false); // Reset processing flag
    });
}






    // $.post('{{ route('add_reviews.published') }}', {
    //     _token: '{{ csrf_token() }}',
    //     id: el.value,
    //     status: status
    // }, function(data) {
    //     if (data == 1) {
    //         AIZ.plugins.notify('success', '{{ translate('Published Reviews updated successfully') }}');
    //     } else {
    //         AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
    //     }
    // }).fail(function() {
    //     AIZ.plugins.notify('danger', '{{ translate('AJAX request failed! Check console for errors.') }}');
    // });


</script>
@endsection