@extends('backoffice.layouts.main', [
    'title' => 'Laporan Barang Masuk',
    'contentTitle' => 'Laporan Barang Masuk'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row px-2 justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>

                        <div class="col-auto">
                            <button class="btn btn-sm btn-primary" onclick="window.print()">
                                <i class="fas fa-print"></i>
                                Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="w-100 mx-auto" id="print-area">
                        <h6 id="table-title" class="h4 mb-3 text-gray-800">At Warehouse Reports</h6>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Asal</th>
                                        <th scope="col">Tujuan</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Berat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($cargos) > 0)
                                        @foreach($cargos as $index => $cargo)
                                            <tr>
                                                <th scope="row">{{ ($index+1) }}</th>
                                                <td>{{ $cargo->created_at }}</td>
                                                <td>{{ $cargo->sender_sub_district . ', '. $cargo->sender_city }}</td>
                                                <td>{{ $cargo->destination_sub_district . ', '. $cargo->destination_city }}</td>
                                                <td>{{ $cargo->package_description }}</td>
                                                <td>{{ $cargo->quantity }}</td>
                                                <td>{{ $cargo->weight }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No data found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('additional-styles')
    <style>
        #table-title {
            display: none
        }
    </style>

    <style media="print">
        @page {
            size: auto;
            margin: 0;
        }

        body * {
            visibility: hidden;
        }

        #print-area {
            max-width: 793px; 
            color: #000;
        }
        
        #print-area, #print-area * {
            visibility: visible;
        }
        
        #print-area {
            position: fixed;
            left: 50%;
            top: 30px;
            margin: 0;
            transform: translateX(-50%);
        }

        #table-title {
            display: block;
        }
    </style>
@endpush