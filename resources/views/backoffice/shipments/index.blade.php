@extends('backoffice.layouts.main', [
    'title' => 'list Resi',
    'contentTitle' => 'Resi'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" style="font-size: .9rem;" role="alert">
                        {{ Session::get('success') }}

                        <button type="button" class="close" style="font-size: 1.1rem;" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 3%">#</th>
                                    <th scope="col" style="width: 10%">No AWB</th>
                                    <th scope="col" style="width: 10%">Tanggal</th>
                                    <th scope="col" style="width: 10%">Pengirim</th>
                                    <th scope="col" style="width: 20%">Asal</th>
                                    <th scope="col" style="width: 20%">Tujuan</th>
                                    <th scope="col" style="width: 5%">Tipe</th>
                                    <th scope="col" style="width: 10%">STATUS</th>
                                    <th scope="col" style="width: 17%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cargos) > 0)
                                    @foreach($cargos as $index => $cargo)
                                        <tr>
                                            <th scope="row">{{ ($index+1) }}</th>
                                            <td>{{ $cargo->id }}</td>
                                            <td>{{ $cargo->created_at }}</td>
                                            <td>{{ $cargo->partner->name }}</td>
                                            <td>{{ $cargo->costRate->sender_sub_district .', '. $cargo->costRate->sender_city .', '. $cargo->costRate->sender_province }}</td>
                                            <td>{{ $cargo->costRate->destination_sub_district .', '. $cargo->costRate->destination_city .', '. $cargo->costRate->destination_province }}</td>
                                            <td>{{ $cargo->costRate->transport_type }}</td>
                                            <td>{{ isset($cargo->cargoDetails[0]) ? $cargo->cargoDetails[0]->delivery_status : '' }}</td>
                                            <td>
                                                <a href="{{ route('shipments.show', $cargo->id) }}" class="btn btn-primary btn-sm mb-1 d-block" style="font-size: 11.5px;">
                                                    <i class="fas fa-list mr-2"></i>
                                                    Detail
                                                </a>
                                                
                                                <a href="{{ route('shipments.delivery.print', $cargo->id) }}" class="btn btn-success btn-sm mb-1 d-block" style="font-size: 11.5px;">
                                                    <i class="fas fa-print mr-2"></i>
                                                    Form Penagihan
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No data found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination justify-content-center">
                        {{ $cargos->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection