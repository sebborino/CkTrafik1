@extends('agent.layout.app')

@section('content')
    

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome Back {{ auth()->user()->name }}
    </div>
</div>

@endsection

@push('chart-scripts')
    <script src="/js/chart.js/Chart.min.js"></script>
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>
@endpush    