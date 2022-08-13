@extends('backoffice.layouts.main', [
    'title' => 'Laporan Data Pelanggan',
    'contentTitle' => 'Laporan Data Pelanggan'
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
                        <table class="w-100 mb-3">
                            <tr>
                                <td style="width: 25%; vertical-align: middle;">
                                    <p style="font-size: 23px; font-weight: bold;">pelanggan</p>
                                </td>
                                <td style="width: 60%; vertical-align: top; font-size: 13px;">
                                    <p class="mb-0">Wisma Setia Ciliwung Blok A. 108 Jl. Bukit Duri Tanjakan, Tebet, Jakarta Selatan</p>
                                    <p class="mb-0">Telp: 021-83783267</p>
                                    <p class="mb-0">Email: gema.express@yahoo.com</p>
                                    <p class="mb-0">www.gemalintassemesta.com</p>
                                </td>
                                <td style="width: 15%; vertical-align: top; text-align: right;">
                                    <img src="{{ asset('images/gema-logo.png') }}">
                                </td>
                            </tr>
                        </table>

                        <table class="w-100 mb-3">
                            <tr>
                                <td colspan="3" class="text-right">
                                    <p style="font-size: 16px; font-weight: bold;">{{ date("j F Y")}}</p>
                                </td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama Perusahaan</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($partners) > 0)
                                        @foreach($partners as $index => $partner)
                                            <tr>
                                                <th scope="row">{{ ($index+1) }}</th>
                                                <td>{{ $partner->code }}</td>
                                                <td>{{ $partner->name }}</td>
                                                <td>{{ $partner->email }}</td>
                                                <td>{{ $partner->phone }}</td>
                                                <td>{{ $partner->address }}</td>
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

                        <table class="w-100 mb-3">
                            <tr>
                                <td style="width:30%; vertical-align: top; text-align: center">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    ({{ Auth::user()->name }})
                                    <br>
                                    <b>Pegawai</b>
                                </td>
                                <td style="width:13.3%; vertical-align: top; text-align: center">
                                </td>
                                <td style="width:13.3%; vertical-align: top; text-align: center">
                                </td>
                                <td style="width:13.3%; vertical-align: top; text-align: center">
                                </td>
                                <td style="width:30%; vertical-align: top; text-align: center">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (Andi Santoso)
                                    <br>
                                    <b>Direktur</b>
                                </td>
                            </tr>
                        </table>
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