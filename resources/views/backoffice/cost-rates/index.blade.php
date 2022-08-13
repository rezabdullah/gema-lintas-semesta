@extends('backoffice.layouts.main', [
    'title' => 'List Harga Pengiriman',
    'contentTitle' => 'Harga Pengiriman'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
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
                                    <th scope="col">#</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Berat</th>
                                    <th scope="col">Ctg</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($costRates) > 0)
                                    @foreach($costRates as $index => $costRate)
                                        <tr>
                                            <th scope="row">{{ ($index+1) }}</th>
                                            <td>{{ empty($costRate->partner->name) ? 'Semua Partner' : $costRate->partner->name . ' ('. $costRate->partner->code .')'  }}</td>
                                            <td>{{ $costRate->sender_sub_district.', '. $costRate->sender_city .', '. $costRate->sender_province }}</td>
                                            <td>{{ $costRate->destination_sub_district.', '. $costRate->destination_city .', '. $costRate->destination_province }}</td>
                                            <td>{{ $costRate->weight }}</td>
                                            <td>{{ $costRate->ctg_type }}</td>
                                            <td>{{ 'Rp '. number_format($costRate->cost, 0 ,",", ".") }}</td>
                                            <td>{{ $costRate->transport_type }}</td>
                                            <td>
                                                <a href="{{ route('cost-rates.edit', $costRate->id) }}" class="btn btn-primary btn-sm mb-1">Edit</a>
    
                                                <form method="POST" action="{{ route('cost-rates.destroy', $costRate->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
        
                                                    <button onclick="return confirm('Apakah Anda yakin ingin menghapus harga pengiriman ini ?')" type="submit" class="btn btn-danger btn-sm mb-1">Delete</button>
                                                </form>
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
                        {{ $costRates->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection