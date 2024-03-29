@extends('backoffice.layouts.main', [
    'title' => 'Update Gudang',
    'contentTitle' => 'Gudang'
])

@section('content-page')
    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
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

                    <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="JKT001" value="{{ $warehouse->code }}">

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea rows="3" style="resize: none;" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Wisma Setia Tjiliwung Jl. Bukit Duri Tanjakan No. 54">{{ $warehouse->address }}</textarea>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="province">Provinsi</label>
                            <select class="form-control @error('province') is-invalid @enderror" id="province" name="province">
                                <option value="">Pilih Provinsi</option>

                                @if (count($provinces) > 0)
                                    @foreach($provinces as $index => $province)
                                        <option value="{{ $province->id ."#". $province->name }}" {{ $province->name == $warehouse->province ? 'selected' : '' }} >{{ $province->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            
                            @error('province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">Kota</label>
                            <select class="form-control @error('city') is-invalid @enderror" id="city" name="city">
                                <option value="{{ $warehouse->city }}">{{ $warehouse->city }}</option>
                            </select>
                            
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sub_district">Kecamatan</label>
                            <select class="form-control @error('sub_district') is-invalid @enderror" id="sub_district" name="sub_district">
                                <option value="{{ $warehouse->sub_district }}">{{ $warehouse->sub_district }}</option>
                            </select>
                            
                            @error('sub_district')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="">Pilih Status</option>
                                <option value="active" {{ $warehouse->status == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{ $warehouse->status == "inactive" ? "selected" : "" }}>Inactive</option>
                            </select>
                            
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Save</button>

                            <a href="{{ route('warehouses') }}" class="btn btn-default">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('additional-scripts')
<script>
    const onChangeSelect = (url, id, responseId) => {
        $.ajax({
            url: url,
            type: 'GET',
            data: { id },
            success: function (data) {
                const inputLabel = responseId === 'city' ? 'Kota' : 'Kecamatan'

                $('#' + responseId).empty().append('<option value="">Pilih ' + inputLabel + '</option>');

                $.each(data, function (key, value) {
                    $('#' + responseId).append('<option value="' + key + '#' + value + '">' + value + '</option>');
                });
            }
        });
    }

    $(function () {
        $('#province').on('change', function () {
            if($(this).val() != '') {
                const value = $(this).val().split('#')

                onChangeSelect(`{{ route("ajax.cities") }}`, value[0], 'city');
            }
        });

        $('#city').on('change', function () {
            if($(this).val() != '') {
                const value = $(this).val().split('#')

                onChangeSelect('{{ route("ajax.districts") }}', value[0], 'sub_district');
            }
        })
    });
</script>
@endpush