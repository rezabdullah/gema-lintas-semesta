@extends('backoffice.layouts.main', [
    'title' => 'Shipment Detail',
    'contentTitle' => 'Shipment Detail'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row px-2 justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">{{ 'Shipment Detail of ' . $cargo->id }}</h6>

                        <div class="col-auto">
                            <a href="{{ route('shipments') }}" class="btn btn-sm btn-default mr-2">
                                <i class="fas fa-chevron-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row px-2 mb-4">
                        <div class="col-12 col-md-6 px-1">
                            <h2 class="h5 mb-1 text-gray-800">Detail Pesanan</h2>

                            <table class="w-100" style="line-height: 25px;">
                                <tr>
                                    <td>No AWB</td>
                                    <td>:</td>
                                    <td>{{ $cargo->id }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>{{ $cargo->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Berat</td>
                                    <td>:</td>
                                    <td>{{ $cargo->weight }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td>{{ $cargo->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Petugas</td>
                                    <td>:</td>
                                    <td>{{ $cargo->cargoDetails[0]->user->name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 col-md-4 px-1">
                            {{ QrCode::generate( route('tracking', $cargo->id)) }}
                        </div>
                    </div>

                    <div class="row px-2 mb-5">
                        <div class="col-12 col-md-6 px-1">
                            <h2 class="h5 mb-1 text-gray-800">Pengirim</h2>

                            <table class="w-100" style="line-height: 25px;">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $cargo->partner->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $cargo->partner->email }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $cargo->partner->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Alamat</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ $cargo->partner->address .", ". $cargo->costRate->sender_sub_district .", ". $cargo->costRate->sender_city .", ". $cargo->costRate->sender_province }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-12 col-md-6 px-1">
                            <h2 class="h5 mb-1 text-gray-800">Penerima</h2>

                            <table class="w-100" style="line-height: 25px;">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $cargo->recipient_name }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $cargo->recipient_phone }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Alamat</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ $cargo->recipient_address .", ". $cargo->costRate->destination_sub_district .", ". $cargo->costRate->destination_city .", ". $cargo->costRate->destination_province }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" style="font-size: .9rem;" role="alert">
                        {{ Session::get('success') }}

                        <button type="button" class="close" style="font-size: 1.1rem;" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row px-2 mb-4">
                        <h2 class="h5 my-0 mr-3 text-gray-800">Shipment Records</h2>

                        <a href="{{ route('shipments.delivery.create', $cargo->id) }}" class="btn btn-primary btn-sm">Add Shipment Record</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Warehouse</th>
                                    <th scope="col">Petugas</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cargo->cargoDetails) > 0)
                                    @foreach($cargo->cargoDetails as $index => $detail)
                                        <tr>
                                            <th scope="row">{{ ($index+1) }}</th>
                                            <td>{{ $detail->created_at }}</td>
                                            <td>{{ $detail->warehouse->sub_district . ', '. $detail->warehouse->city .' ('. $detail->warehouse->code .')' }}</td>
                                            <td>{{ $detail->user->name }}</td>
                                            <td>{{ $detail->description }}</td>
                                            <td>{{ $detail->delivery_status }}</td>
                                            <td>
                                                @if ($detail->delivery_status != 'REQUEST-PICKUP')
                                                    <form method="POST" action="{{ route('shipments.delivery.destroy', $detail->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
            
                                                        <button onclick="return confirm('Are you sure want delete this record ?')" type="submit" class="btn btn-danger btn-sm my-1">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
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
@endsection