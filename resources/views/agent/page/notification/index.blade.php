@extends('agent.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Notifications</h1>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Notifications</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Notification Status</th>
                                    <th>Notification</th>
                                    <th>Notification Sent At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                    <tr class="text-center">
                                        <td>
                                            <i class="fas {{ is_null($notification->read_at) ? 'fa-folder' : 'fa-folder-open'}}"></i>
                                        </td>
                                        <td>
                                            <a href="{{ route($notification->data['view'],['id' => $notification->id])}}">
                                                {{ $notification->data['text']}}
                                                
                                            </a>    
                                        </td>
                                        <td class="text-xs">
                                            {{ $notification->created_at}}
                                        </td>
                                        
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


@endsection

@push('dataTable-scripts')
        <script src="/js/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
@endpush
