@extends('backoffice.layouts.main', [
    'title' => 'List Pegawai',
    'contentTitle' => 'Pegawai'
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gudang</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <th scope="row">{{ ($index+1) }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ($user->warehouse) ? $user->warehouse->city .", ". $user->warehouse->sub_district ." (". $user->warehouse->code .")" : "" }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm my-1">Edit</a>

                                            @if ($user->id != Auth::user()->id)
                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
        
                                                    <button onclick="return confirm('Are you sure want delete this user ?')" type="submit" class="btn btn-danger btn-sm my-1">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination justify-content-center">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection