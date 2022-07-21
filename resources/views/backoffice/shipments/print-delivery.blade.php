@extends('backoffice.layouts.main', [
    'title' => 'Print Shipment Detail',
    'contentTitle' => 'Shipment Detail'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row px-2 justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">{{ 'Print preview of ' . $cargo->id }}</h6>

                        <div class="col-auto">
                            <a href="{{ route('shipments') }}" class="btn btn-sm btn-default mr-2">
                                <i class="fas fa-chevron-left"></i>
                                Back
                            </a>

                            <button class="btn btn-sm btn-primary" onclick="window.print()">
                                <i class="fas fa-print"></i>
                                Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="w-100 mx-auto" id="print-area" style="max-width: 793px; color: #000;">
                        <table class="w-100 mb-3">
                            <tr>
                                <td style="width: 25%; vertical-align: middle;">
                                    <p style="font-size: 23px; font-weight: bold;">invoice</p>
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
                                    <p style="font-size: 18px; font-weight: bold;" class="mb-1">Resi#{{ $cargo->id }}</p>
                                    <p style="font-size: 16px; font-weight: bold;">{{ date("j F Y")}}</p>
                                </td>
                            </tr>
                        </table>
                        
                        <table class="w-100 mb-5">
                            <tr>
                                <td style="width: 70%; vertical-align: top;">
                                    <table class="w-100" style="font-size: 14px;">
                                        <tr>
                                            <td style="width: 15%; vertical-align: top;">
                                                Nama
                                            </td>
                                            <td style="width: 2%; vertical-align: top;">
                                                :
                                            </td>
                                            <td style="width: 83%;">
                                                {{ $cargo->partner->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%; vertical-align: top;">
                                                Email
                                            </td>
                                            <td style="width: 2%; vertical-align: top;">
                                                :
                                            </td>
                                            <td style="width: 83%;">
                                                {{ $cargo->partner->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%; vertical-align: top;">
                                                Phone
                                            </td>
                                            <td style="width: 2%; vertical-align: top;">
                                                :
                                            </td>
                                            <td style="width: 83%;">
                                                {{ $cargo->partner->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%; vertical-align: top;">
                                                Alamat
                                            </td>
                                            <td style="width: 2%; vertical-align: top;">
                                                :
                                            </td>
                                            <td style="width: 83%;">
                                                {{ $cargo->partner->address }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 30%; vertical-align: top; text-align: right;">
                                    {{ QrCode::size(80)->generate(route('front.tracking.get', $cargo->id)) }}
                                </td>
                            </tr>
                        </table>

                        <table class="table table-striped mb-5" style="font-size: 14px; color: #000;">
                            <tr>
                                <th style="width: 5%; vertical-align: top; text-align: center; border: 1px solid #373737;" class="py-1">No</th>
                                <th style="width: 35%; vertical-align: top; text-align: center; border: 1px solid #373737;" class="py-1">Asal</th>
                                <th style="width: 35%; vertical-align: top; text-align: center; border: 1px solid #373737;" class="py-1">Tujuan</th>
                                <th style="width: 10%; vertical-align: top; text-align: center; border: 1px solid #373737;" class="py-1">Berat</th>
                                <th style="width: 10%; vertical-align: top; text-align: center; border: 1px solid #373737;" class="py-1">Jumlah</th>
                                <th style="width: 10%; vertical-align: top; text-align: center; border: 1px solid #373737;" class="py-1">Harga</th>
                                <th style="width: 10%; vertical-align: top; text-align: center; border: 1px solid #373737;" class="py-1">Total</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #373737;" class="py-1">1</td>
                                <td style="border: 1px solid #373737;" class="py-1">
                                    {{ 
                                        $cargo->sender_address .','. 
                                        $cargo->costRate->sender_sub_district .','. 
                                        $cargo->costRate->sender_city .','. 
                                        $cargo->costRate->sender_province 
                                    }}
                                </td>
                                <td style="border: 1px solid #373737;" class="py-1">
                                    {{ 
                                        $cargo->recipient_address .','. 
                                        $cargo->costRate->destination_sub_district .','. 
                                        $cargo->costRate->destination_city .','. 
                                        $cargo->costRate->destination_province 
                                    }}
                                </td>
                                <td style="border: 1px solid #373737;" class="py-1">{{ $cargo->weight }}</td>
                                <td style="border: 1px solid #373737;" class="py-1">{{ $cargo->quantity }}</td>
                                <td style="border: 1px solid #373737;" class="py-1">{{ "Rp". number_format($cargo->price, 0, ",", ".") }}</td>
                                <td style="border: 1px solid #373737;" class="py-1">{{ "Rp". number_format($cargo->total_price, 0, ",", ".") }}</td>
                            </tr>
                        </table>

                        <table class="w-100 mb-3">
                            <tr>
                                <td style="width:30%; vertical-align: top; text-align: center">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (_______________________)
                                    <br>
                                    <b>Kurir</b>
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
                                    ({{ $cargo->recipient_name }})
                                    <br>
                                    <b>Penerima</b>
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
    <style media="print">
        @page {
            size: auto;
            margin: 0;
        }

        /* 

        * {
            display: none;
        }

        #print-area * {
            display: block;
        } */

        body * {
            visibility: hidden;
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
    </style>
@endpush