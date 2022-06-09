@extends('main', [
    'title' => 'Riwayat shipment dari '. $cargo->id,
])

@section('content-page')
    <main class="container" data-aos="fade-up">
        <h1 class="h3 mt-4">Riwayat shipment dari {{ $cargo->id }}</h1>
        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Warehouse</th>
                        <th scope="col">Status</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($cargo->cargoDetails) > 0)
                        @foreach($cargo->cargoDetails as $index => $detail)
                            <tr>
                                <th scope="row">{{ ($index+1) }}</th>
                                <td>{{ $detail->created_at }}</td>
                                <td>{{ $detail->warehouse->sub_district . ', '. $detail->warehouse->city }}</td>
                                <td>{{ $detail->delivery_status }}</td>
                                <td>{{ $detail->description }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
@endsection