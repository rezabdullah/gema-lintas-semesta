@extends('backoffice.layouts.main', [
    'title' => 'Tambah Riwayat Resi',
    'contentTitle' => 'Riwayat Resi'
])

@section('content-page')
    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ "Tambah Riwayat Resi " .$cargo->id }}</h6>
                </div>
                <div class="card-body">                    
                    <form action="{{ route('shipments.delivery.store', $cargo->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="delivery_status">Status</label>
                            <select class="form-control @error('delivery_status') is-invalid @enderror" id="delivery_status" name="delivery_status">
                                <option value="">Pilih Status</option>
                                <option value="PICKED-UP">PICKED UP</option>
                                <option value="RECEIVED-AT-WAREHOUSE">RECEIVED AT WAREHOUSE</option>
                                <option value="DELIVERING">DELIVERING</option>
                                <option value="DELIVERING-BY-COURIER">DELIVERING BY COURIER</option>
                                <option value="DELIVERED">DELIVERED</option>
                            </select>

                            @error('delivery_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Paket di terima" value="{{ old('description') }}">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection