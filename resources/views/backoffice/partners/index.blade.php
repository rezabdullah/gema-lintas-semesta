@extends('backoffice.layouts.main', [
    'title' => 'Partner list',
    'contentTitle' => 'Partners'
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
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama Perusahaan</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
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
                                            <td>{{ $partner->status }}</td>
                                            <td>
                                                <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-primary btn-sm mb-1">Edit</a>
    
                                                <form method="POST" action="{{ route('partners.destroy', $partner->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
        
                                                    <button onclick="return confirm('Apakah Anda yakin ingin menghapus partner ini ?')" type="submit" class="btn btn-danger btn-sm mb-1">Delete</button>
                                                </form>
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

                    <div class="pagination justify-content-center">
                        {{ $partners->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection