@extends('layout.app',['pageTitle' => __('Main Dashboard'),'activeMenu' => 'Event Organiser'])
@section('content')


@component('layout.inc.breadcrumb')
@slot('title')
{{ __('messages.dashboard') }}
@endslot
@endcomponent


<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
@include('elements.alert')
<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-info"><i class="fa fa-shopping-cart"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-light">120</h3>
                        <h5 class="text-muted m-b-0">Total Sale</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-warning"><i class="fa fa-shopping-bag"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">30</h3>
                        <h5 class="text-muted m-b-0">Total Purchase</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary"><i class="fa fa-hospital-o"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">30</h3>
                        <h5 class="text-muted m-b-0">Total Diagnostic Bill</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-danger"><i class="fa fa-calendar"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">20</h3>
                        <h5 class="text-muted m-b-0">Total Appointment</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-info"><i class="fa fa-file-word-o"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-light">55</h3>
                        <h5 class="text-muted m-b-0">Total Prescription</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-warning"><i class="fa fa-bar-chart"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">35</h3>
                        <h5 class="text-muted m-b-0">Total Laboratory Report</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary"><i class="fa fa-registered"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">44</h3>
                        <h5 class="text-muted m-b-0">Total Admission</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-danger"><i class="fa fa-ambulance"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">35</h3>
                        <h5 class="text-muted m-b-0">Total Emergency</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-info"><i class="fa fa-user-circle-o"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-light">35</h3>
                        <h5 class="text-muted m-b-0">Total Patient</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-warning"><i class="fa fa-credit-card"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">88</h3>
                        <h5 class="text-muted m-b-0">Total Payment</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary"><i class="fa fa-dollar"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">54</h3>
                        <h5 class="text-muted m-b-0">Total Received</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-danger"><i class="fa fa-user-md"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">45}</h3>
                        <h5 class="text-muted m-b-0">Total Doctor</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>



<div class="row">

    admin Dashboard
</div>

@endsection

<link href="{{ asset('material') }}/assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
<link href="{{ asset('material') }}/assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
<link href="{{ asset('material') }}/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
<!--This page css - Morris CSS -->
<link href="{{ asset('material') }}/assets/plugins/c3-master/c3.min.css" rel="stylesheet">


<script src="{{ asset('material') }}/assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="{{ asset('material') }}/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js">
</script>
<!--c3 JavaScript -->
<script src="{{ asset('material') }}/assets/plugins/d3/d3.min.js"></script>
<script src="{{ asset('material') }}/assets/plugins/c3-master/c3.min.js"></script>
<!-- Chart JS -->
{{-- <script src="{{ asset('material') }}/js/dashboard1.js"></script> --}}
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
{{-- <script src="{{ asset('material') }}/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> --}}


<script src="{{ asset('material') }}/assets/plugins/echarts/echarts-all.js"></script>

