@extends('backoffice.layouts.main', [
    'title' => 'Add new partner',
    'contentTitle' => 'Partners'
])

@section('content-page')
    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add new</h6>
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

                    <div class="alert alert-info" role="alert">
                        <h5 class="alert-heading mb-0" style="font-size: 1rem; font-weight: bold;">Info!</h5>
                        <hr>
                        <p style="font-size: 0.9rem;" class="mb-0"><strong>Kode</strong> harus unik. Pastikan kode yang dimasukkan belum terdapat didalam database.</p>
                    </div>
                    <form action="{{ route('partners.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="M1001" value="{{ old('code') }}">

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="PT ABCD EFGH" value="{{ old('name') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email@domain.com" value="{{ old('email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="021123123123" value="{{ old('phone') }}">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea rows="3" style="resize: none;" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Wisma Setia Tjiliwung Jl. Bukit Duri Tanjakan No. 54">{{ old('address') }}</textarea>

                            @error('address')
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