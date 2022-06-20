@extends('backoffice.layouts.main', [
    'title' => 'Partner Reports',
    'contentTitle' => 'Partner'
])

@section('content-page')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row px-2 justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Reports</h6>

                        <div class="col-auto">
                            <button class="btn btn-sm btn-primary" onclick="window.print()">
                                <i class="fas fa-print"></i>
                                Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="w-100 mx-auto" id="print-area">
                        <h6 id="table-title" class="h4 mb-3 text-gray-800">Partner Reports</h6>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama Perusahaan</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($partners) > 0)
                                        @foreach($partners as $index => $partner)
                                            <tr>
                                                <th scope="row">{{ ($index+1) }}</th>
                                                <td>{{ $partner->code }}</td>
                                                <td>{{ $partner->name }}</td>
                                                <td>{{ $partner->email }}</td>
                                                <td>{{ $partner->phone }}</td>
                                                <td>{{ $partner->address }}</td>
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
    </div>
@endsection

@push('additional-styles')
    <style>
        #table-title {
            display: none
        }
    </style>

    <style media="print">
        @page {
            size: auto;
            margin: 0;
        }

        body * {
            visibility: hidden;
        }

        #print-area {
            max-width: 793px; 
            color: #000;
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

        #table-title {
            display: block;
        }
    </style>
@endpush