@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h1 class="h3">{{translate('All Instagram Reels')}}</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Instagram Reels')}}</h5>
            </div>
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th data-breakpoints="lg" width="10%">#</th>
                            <th>{{translate('Url')}}</th>
                            <th data-breakpoints="lg">{{translate('Status')}}</th>
                            <th width="10%" class="text-right">{{translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($insta_reels as $key => $insta)
                        <tr>
                            <td>{{ ($key+1) + ($insta_reels->currentPage() - 1)*$insta_reels->perPage() }}</td>
                            <td>{{$insta->url}}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" 
                                        @can('publish_insta-reel') onchange="change_status(this)" @endcan
                                        value="{{ $insta->id }}" 
                                        <?php if($insta->status == 1) echo "checked";?>
                                        @cannot('publish_insta-reel') disabled @endcan
                                    >
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-right d-flex">
                                @can('edit_insta_reel')
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('insta-reels.edit', encrypt($insta->id))}}" title="{{ translate('Edit') }}">
                                    <i class="las la-edit"></i>
                                </a>
                                @endcan
                                &nbsp;
                                @can('delete_insta_reel')
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('insta-reels.destroy', $insta->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $insta_reels->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Add New Instagram Reels') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('insta-reels.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="url">{{translate('Instagram Reels Url')}}</label>
                        <input type="url" placeholder="{{translate('Instagram Reels Url')}}" name="url" class="form-control" required>
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
            $.post('{{ route('instagram-reels.change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Change Instagram Reels status successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection