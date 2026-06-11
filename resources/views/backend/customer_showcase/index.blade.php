@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h1 class="h3">{{translate('All Customer Showcase')}}</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Customer Showcase')}}</h5>
            </div>
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th data-breakpoints="lg" width="10%">#</th>
                            <th>{{translate('Image')}}</th>
                            <th data-breakpoints="lg">{{translate('Status')}}</th>
                            <th width="10%" class="text-right">{{translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_showcase as $key => $showcase)
                        <tr>
                            <td>{{ ($key+1) + ($customer_showcase->currentPage() - 1)*$customer_showcase->perPage() }}</td>
                            <td>
		                        <img src="{{ uploaded_asset($showcase->showcase_image) }}" alt="{{translate('Customer Showcase')}}" class="h-50px">
		                    </td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" 
                                        @can('publish_customer-showcase') onchange="change_status(this)" @endcan
                                        value="{{ $showcase->id }}" 
                                        <?php if($showcase->status == 1) echo "checked";?>
                                        @cannot('publish_customer-showcase') disabled @endcan
                                    >
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-right d-flex">
                                @can('edit_customer-showcase')
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('customer_showcase.edit', encrypt($showcase->id))}}" title="{{ translate('Edit') }}">
                                    <i class="las la-edit"></i>
                                </a>
                                @endcan
                                &nbsp;
                                @can('delete_customer-showcase')
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('customer-showcase.destroy', $showcase->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $customer_showcase->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Add New Customer Showcase') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('customer_showcase.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="customer_image">{{translate('Image')}}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ translate('Browse')}}
                                </div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="showcase_image" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>

                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
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
        function change_status(el){
            var status = 0;
            if(el.checked){
                var status = 1;
            }
            $.post('{{ route('customer-showcase.change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Change Customer Showcase status successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection