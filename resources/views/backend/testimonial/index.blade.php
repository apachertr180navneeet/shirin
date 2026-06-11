@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Testimonials')}}</h1>
		</div>
        @can('add_testimonial')
            <div class="col-md-6 text-md-right">
                <a href="{{ route('testimonial.create') }}" class="btn btn-circle btn-info">
                    <span>{{translate('Add New Testimonial')}}</span>
                </a>
            </div>
        @endcan
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Testimonial')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg" width="5%">#</th>
                    <th data-breakpoints="lg">{{translate('Photos')}}</th>
                    <th>{{translate('Name')}}</th>
                    <th data-breakpoints="lg">{{translate('Designation')}}</th>
                    <th data-breakpoints="lg">{{translate('Rating')}}</th>
                    <th data-breakpoints="lg" width="30%">{{translate('Comment')}}</th>
                    <th data-breakpoints="lg">{{translate('Status')}}</th>
                    <th width="10%" class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $key => $test)
                        <tr>
                            <td>{{ ($key+1) + ($testimonials->currentPage() - 1)*$testimonials->perPage() }}</td>
                            <td>
		                        <img src="{{ uploaded_asset($test->photos) }}" alt="{{translate('Photos')}}" class="h-50px">
		                    </td>
                            <td>{{$test->name}}</td>
                            <td>{{$test->designation}}</td>
                            <td>
                                <p class="rating rating-sm">
                                    @for ($i=0; $i < $test->rating; $i++)
                                        <i class="las la-star active"></i>
                                    @endfor
                                    @for ($i=0; $i < 5-$test->rating; $i++)
                                        <i class="las la-star"></i>
                                    @endfor
                                </p>
                            </td>
                            <td>{{$test->comment}}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" 
                                        @can('publish_testimonial') onchange="change_status(this)" @endcan
                                        value="{{ $test->id }}" 
                                        <?php if($test->status == 1) echo "checked";?>
                                        @cannot('publish_testimonial') disabled @endcan
                                    >
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-right">
                                @can('edit_testimonial')
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('testimonial.edit', encrypt($test->id))}}" title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                @endcan
                                @can('delete_testimonial')
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('testimonials.destroy', $test->id)}}" title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $testimonials->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

    <script type="text/javascript">
        function change_status(el){
            var status = 0;
            if(el.checked){
                var status = 1;
            }
            $.post('{{ route('testimonials.change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Change Testimonial status successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection
