@extends('backoffice.layouts.main', [
    'title' => 'Role list',
    'contentTitle' => 'Roles'
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

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Permissions</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $index => $role)
                                <tr>
                                    <th scope="row">{{ ($index+1) }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->permissions as $index => $permission)
                                            {{ $permission->name . ($index < count($role->permissions) - 1 ? ', ' : '') }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Manage Permission</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination justify-content-center">
                        {{ $roles->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection