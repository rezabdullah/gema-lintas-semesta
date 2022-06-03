@extends('backoffice.layouts.main', [
    'title' => 'Add new user',
    'contentTitle' => 'Users'
])

@section('content-page')
    <div class="row">
        <div class="col-12 col-md-7">
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
                        <p style="font-size: 0.9rem;" class="mb-0">Password default untuk user baru berupa alamat email yang diinput pada form di bawah.</p>
                    </div>
                    <form action="/bo/users" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Fullname</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailConfirmation">Email Confirmation</label>
                            <input type="email" class="form-control @error('emailConfirmation') is-invalid @enderror" id="emailConfirmation" name="emailConfirmation" placeholder="name@example.com" value="{{ old('emailConfirmation') }}">

                            @error('emailConfirmation')
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