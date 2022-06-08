@extends('backoffice.layouts.main', [
    'title' => 'Dashboard',
    'contentTitle' => 'Dashboard'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show mb-4" style="font-size: .9rem;" role="alert">
                *Perhitungan Earning Didapat Dari Pengiriman Yang Sudah Selesai
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earning This Day</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp ". number_format($earningsThisDay, 0, ",", ".") }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earning This Week</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp ". number_format($earningsThisWeek, 0, ",", ".") }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Earning This Month</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp ". number_format($earningsThisMonth, 0, ",", ".") }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Earning All Time</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp ". number_format($earningsAllTime, 0, ",", ".") }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Shipments Overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Delivered
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Delivering
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> At Warehouse
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Pickup Request
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tracking Shipments</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.tracking.shipments') }}" method="POST" class="mt-2">
                        @csrf

                        <div class="row">
                            <div class="col-md-10 pr-0">
                                <div class="form-group">
                                    <input type="text" class="form-control w-100 @if(old('tracking_number')) is-invalid @endif" name="tracking_number" placeholder="Tracking Number" value="{{ old('tracking_number') }}" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" required>

                                    @if ($errors->has('tracking_number'))
                                        <span class="text-danger mt-2 d-block">{{ $errors->first('tracking_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2 pl-0">
                                <div class="form-group">
                                    <button class="btn btn-primary w-100" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('additional-scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('sb-admin-2/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('sb-admin-2/js/demo/chart-area-demo.js') }}"></script> --}}
    
    <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Delivered", "Delivering To Client", "At Warehouse", "Pickup Requests"],
        datasets: [{
            data: [{{ $delivered }}, {{ $deliveringToClient }}, {{ $atWarehouse }}, {{ $pickupRequest }}],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#eab735'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
    </script>
@endpush