@extends('backoffice.layouts.main', [
    'title' => 'Buat Baru Resi',
    'contentTitle' => 'Resi',
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

                    <form action="{{ route('shipments.pickup.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <h2 class="h4 mb-4 text-center text-gray-800">Detail Pesanan</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="partner_id">Partner</label>
                                    <select class="form-control @error('partner_id') is-invalid @enderror" id="partner_id" name="partner_id">
                                        <option value="">Pilih Partner</option>
        
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
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="cost_rate_id">Cost Rate</label>
                                    <select class="form-control @error('cost_rate_id') is-invalid @enderror" id="cost_rate_id" name="cost_rate_id" disabled>
                                        <option value="">Pilih Cost Rate</option>
                                    </select>
        
                                    @error('cost_rate_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="package_description">Deskripsi Paket</label>
                                    <textarea rows="3" style="resize: none;" class="form-control @error('package_description') is-invalid @enderror" id="package_description" name="package_description" placeholder="Sepatu"></textarea>
        
                                    @error('package_description')
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="quantity">Jumlah Koli/Pcs</label>
                                    <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="1" value="{{ old('quantity') }}">
        
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="price">Harga Satuan</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Rp 0" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="transport_type">Tipe Pengiriman</label>
                                    <input type="text" class="form-control" id="transport_type" name="transport_type" placeholder="DARAT" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <h2 class="h4 mb-4 text-center text-gray-800">Detail Pengirim</h2>
                                </div>
                                <div class="form-group">
                                    <label for="sender_name">Nama Pengirim</label>
                                    <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="PT ABCDEF" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="sender_phone">Telepon Pengirim</label>
                                    <input type="text" class="form-control" id="sender_phone" name="sender_phone" placeholder="021123123123" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="sender_email">Email Pengirim</label>
                                    <input type="text" class="form-control" id="sender_email" name="sender_email" placeholder="email@domain.com" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="sender_address">Alamat Pengirim</label>
                                    <input type="text" class="form-control" id="sender_address" name="sender_address" placeholder="Jalan Cempedak" value="{{ old('sender_address') }}">

                                    @error('sender_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sender_sub_district">Kecamatan Pengirim</label>
                                    <input type="text" class="form-control" id="sender_sub_district" name="sender_sub_district" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="sender_city">Kota Pengirim</label>
                                    <input type="text" class="form-control" id="sender_city" name="sender_city" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="sender_province">Provinsi Pengirim</label>
                                    <input type="text" class="form-control" id="sender_province" name="sender_province" value="" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <h2 class="h4 mb-4 text-center text-gray-800">Detail Penerima</h2>
                                </div>
                                <div class="form-group">
                                    <label for="recipient_name">Nama Penerima</label>
                                    <input type="text" class="form-control @error('recipient_name') is-invalid @enderror" id="recipient_name" name="recipient_name" placeholder="PT ABCDEF" value="{{ old('recipient_name') }}">
        
                                    @error('recipient_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="recipient_phone">Telepon Penerima</label>
                                    <input type="text" class="form-control @error('recipient_phone') is-invalid @enderror" id="recipient_phone" name="recipient_phone" placeholder="021123123123" value="{{ old('recipient_phone') }}">
        
                                    @error('recipient_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="recipient_email">Email Penerima</label>
                                    <input type="text" class="form-control @error('recipient_email') is-invalid @enderror" id="recipient_email" name="recipient_email" placeholder="email@domain.com" value="{{ old('recipient_email') }}">
        
                                    @error('recipient_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="recipient_address">Alamat Pengirim</label>
                                    <input type="text" class="form-control @error('recipient_address') is-invalid @enderror" id="recipient_address" name="recipient_address" placeholder="Jalan Rambutan" value="{{ old('recipient_address') }}">
                                    
                                    @error('recipient_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="recipient_sub_district">Kecamatan Penerima</label>
                                    <input type="text" class="form-control" id="recipient_sub_district" name="recipient_sub_district" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="recipient_city">Kota Penerima</label>
                                    <input type="text" class="form-control" id="recipient_city" name="recipient_city" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="recipient_province">Provinsi Penerima</label>
                                    <input type="text" class="form-control" id="recipient_province" name="recipient_province" value="" disabled>
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
    $(function () {
        $('#partner_id').on('change', function () {
            if($(this).val() != '') {
                $.ajax({
                    url: '{{ route("ajax.partner") }}',
                    type: 'GET',
                    data: { id: $(this).val() },
                    success: function (data) {
                        $('#cost_rate_id').empty().attr('disabled', false).append('<option value="">Pilih Cost Rate</option>');

                        $.each(data.costRates, function (key, value) {
                            $('#cost_rate_id').append('<option value="' + value['id'] + '"'+
                                'data-sender-province="' + value['sender_province'] + '"' +
                                'data-sender-city="' + value['sender_city'] + '"' +
                                'data-sender-sub-district="' + value['sender_sub_district'] + '"' +
                                'data-recipient-province="' + value['destination_province'] + '"' +
                                'data-recipient-city="' + value['destination_city'] + '"' +
                                'data-recipient-sub-district="' + value['destination_sub_district'] + '"' +
                                'data-cost="Rp ' + number_format(value['cost'], ",", ".") + '"' +
                                'data-transport-type="' + value['transport_type'] + '"' +
                            '>' + 
                                (value['sender_sub_district'] +' ('+ value['sender_city'] +') - '+ value['destination_sub_district'] +' ('+ value['destination_city'] +') - '+ value['transport_type']).toLowerCase()
                            + '</option>');
                        });

                        $('#sender_name').empty().val(data.partner.name);
                        $('#sender_phone').empty().val(data.partner.phone);
                        $('#sender_email').empty().val(data.partner.email);
                    }
                });
            }
        })

        $('#cost_rate_id').on('change', function () {
            if($(this).val() != '') {
                $('#price').empty().val($(this).find(':selected').attr('data-cost'));
                $('#transport_type').empty().val($(this).find(':selected').attr('data-transport-type'));
                $('#sender_province').empty().val($(this).find(':selected').attr('data-sender-province'));
                $('#sender_city').empty().val($(this).find(':selected').attr('data-sender-city'));
                $('#sender_sub_district').empty().val($(this).find(':selected').attr('data-sender-sub-district'));
                $('#recipient_province').empty().val($(this).find(':selected').attr('data-recipient-province'));
                $('#recipient_city').empty().val($(this).find(':selected').attr('data-recipient-city'));
                $('#recipient_sub_district').empty().val($(this).find(':selected').attr('data-recipient-sub-district'));
            }
        })
    });

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
</script>
@endpush