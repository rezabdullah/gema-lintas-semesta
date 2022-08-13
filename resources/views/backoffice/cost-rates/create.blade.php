@extends('backoffice.layouts.main', [
    'title' => 'Buat Harga Pengiriman Baru',
    'contentTitle' => 'Harga Pengiriman'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Buat Baru</h6>
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

                    <form action="{{ route('cost-rates.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="partner_id">Pelanggan</label>
                                    <select class="form-control @error('partner_id') is-invalid @enderror" id="partner_id" name="partner_id">
                                        <option value="">Semua Pelanggan</option>
        
                                        @if (count($partners) > 0)
                                            @foreach($partners as $index => $partner)
                                                <option value="{{ $partner->id }}" {{ $partner->id == old('partner_id') ? 'selected' : '' }}>{{ $partner->name ." (". $partner->code .")" }}</option>
                                            @endforeach
                                        @endif
                                    </select>
        
                                    @error('partner_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sender_province">Provinsi Pengirim</label>
                                    <select class="form-control @error('sender_province') is-invalid @enderror" id="sender_province" name="sender_province">
                                        <option value="">Pilih Provinsi</option>
        
                                        @if (count($provinces) > 0)
                                            @foreach($provinces as $index => $province)
                                                <option value="{{ $province->id ."#". $province->name }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                    @error('sender_province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sender_city">Kota Pengirim</label>
                                    <select class="form-control @error('sender_city') is-invalid @enderror" id="sender_city" name="sender_city">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                    
                                    @error('sender_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sender_sub_district">Kecamatan Pengirim</label>
                                    <select class="form-control @error('sender_sub_district') is-invalid @enderror" id="sender_sub_district" name="sender_sub_district">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    
                                    @error('sender_sub_district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="destination_province">Provinsi Penerima</label>
                                    <select class="form-control @error('destination_province') is-invalid @enderror" id="destination_province" name="destination_province">
                                        <option value="">Pilih Provinsi</option>
        
                                        @if (count($provinces) > 0)
                                            @foreach($provinces as $index => $province)
                                                <option value="{{ $province->id ."#". $province->name }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                    @error('destination_province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="destination_city">Kota Penerima</label>
                                    <select class="form-control @error('destination_city') is-invalid @enderror" id="destination_city" name="destination_city">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                    
                                    @error('destination_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="destination_sub_district">Kecamatan Penerima</label>
                                    <select class="form-control @error('destination_sub_district') is-invalid @enderror" id="destination_sub_district" name="destination_sub_district">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    
                                    @error('destination_sub_district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="weight">Berat</label>
                                    <input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" placeholder="1" value="{{ old('weight') }}">
        
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ctg_type">Ctg</label>
                                    <input type="text" class="form-control @error('ctg_type') is-invalid @enderror" id="ctg_type" name="ctg_type" placeholder="kg" value="{{ old('ctg_type') }}">
        
                                    @error('ctg_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <input type="text" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" placeholder="20.000" value="{{ old('cost') }}">
        
                                    @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="transport_type">Tipe Pengiriman</label>
                                    
                                    <select class="form-control @error('transport_type') is-invalid @enderror" id="transport_type" name="transport_type">
                                        <option value="">Pilih Tipe Pengiriman</option>
                                        <option {{ old('transport_type') == 'DARAT' ? 'selected' : '' }}>DARAT</option>
                                        <option {{ old('transport_type') == 'LAUT' ? 'selected' : '' }}>LAUT</option>
                                        <option {{ old('transport_type') == 'UDARA' ? 'selected' : '' }}>UDARA</option>
                                    </select>
        
                                    @error('transport_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('additional-scripts')
<script>
    const number_format = (number, decimals, dec_point, thousands_sep) => {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        let n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                let k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    const onChangeSelect = (url, id, responseId) => {
        $.ajax({
            url: url,
            type: 'GET',
            data: { id },
            success: function (data) {
                const inputLabel = responseId === 'sender_city' ? 'Kota' : ('sender_sub_district' ? 'Kecamatan' : ('destination_city' ? 'Kota' : 'Kecamatan'))

                $('#' + responseId).empty().append('<option value="">Pilih ' + inputLabel + '</option>');

                $.each(data, function (key, value) {
                    $('#' + responseId).append('<option value="' + key + '#' + value + '">' + value + '</option>');
                });
            }
        });
    }

    $(function () {
        $('#sender_province').on('change', function () {
            if($(this).val() != '') {
                const value = $(this).val().split('#')

                onChangeSelect(`{{ route("ajax.cities") }}`, value[0], 'sender_city');
            }
        });

        $('#sender_city').on('change', function () {
            if($(this).val() != '') {
                const value = $(this).val().split('#')

                onChangeSelect('{{ route("ajax.districts") }}', value[0], 'sender_sub_district');
            }
        })

        $('#destination_province').on('change', function () {
            if($(this).val() != '') {
                const value = $(this).val().split('#')

                onChangeSelect(`{{ route("ajax.cities") }}`, value[0], 'destination_city');
            }
        });

        $('#destination_city').on('change', function () {
            if($(this).val() != '') {
                const value = $(this).val().split('#')

                onChangeSelect('{{ route("ajax.districts") }}', value[0], 'destination_sub_district');
            }
        })

        $('#cost').on('change keyup blur', function () {
            $(this).val(number_format($(this).val()));
        })
    });
</script>
@endpush