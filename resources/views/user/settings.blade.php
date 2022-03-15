@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('user.nav')
        <div class="col-9 border-bottom border-start border-end rounded-bottom">
            <form method="post" action="{{ route('my-profile.global') }}">
                <div class="row">
                    <div class="mb-3">
                        <div>
                         Your pseudo : {{ $user->pseudo }}
                        </div>
                        <div>
                            @error('pseudo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="pseudo" class="form-label">Change my pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            Your email : {{ $user->email }}
                        </div>
                        <div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="email" class="form-label">Change my email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <form method="post" action="{{ route('my-profile.password') }}">
                <div class="row">
                    <div class="mb-3">
                        <div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="password" class="form-label">Your actual password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            @error('newpassword')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="newpass" class="form-label">New password</label>
                            <input type="password" class="form-control" id="newpass" aria-describedby="emailHelp" name="newpass">
                            <label for="newpassconfirm" class="form-label">Confirm new password</label>
                            <input type="password" class="form-control" id="newpassconfirm" aria-describedby="emailHelp" name="newpassconfirm">
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
