@extends('backoffice.layouts.main', [
    'title' => 'Update role permission',
    'contentTitle' => 'Roles'
])

@section('content-page')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Permissions</h6>
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

                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name">Permissions</label>

                            <div class="row px-3">
                                @foreach ($role->permissions as $permission)
                                    <label class="mr-3" role="button">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}" {{ $permission['isChoosed'] ? 'checked' : '' }}> {{ $permission['name'] }}
                                    </label>
                                @endforeach
                            </div>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Save</button>

                            <a href="{{ route('roles') }}" class="btn btn-default">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection