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

                    <form action="{{ route('users.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name">Permissions</label>
                            {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="John Doe" value="{{ $user->name }}"> --}}
                            @foreach ($permissions as $permissionAvailable)
                                @foreach ($role->permissions as $permissionChoosed)
                                <input type="checkbox" name="permissions[]" value="{{ $permissionAvailable->id }}"> {{ $permissionAvailable->name }} <br>
                                @endforeach
                            @endforeach

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ $user->email }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailConfirmation">Email Confirmation</label>
                            <input type="email" class="form-control @error('emailConfirmation') is-invalid @enderror" id="emailConfirmation" name="emailConfirmation" placeholder="name@example.com" value="{{ $user->email }}">

                            @error('emailConfirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
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