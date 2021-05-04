@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
<h1>User</h1>
@stop

@section('content')

@php
$id = null;
$route_name = 'users.store';
@endphp

@isset($user->id)
@php
$id = $user->id;
$route_name = 'users.update';
@endphp
@endisset

<div class="row">
    <div class="col-12">
        @if (session('message'))
        <div class="alert alert-{{session('alert')}}">
            {{ session('message') }}
        </div>
        @endif
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add New User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($route_name, $id) }}" method="POST">
                @csrf
                @isset($user->id)
                @method('PATCH')
                @endisset
                <input type="hidden" name="id" value="@isset($user->id) {{$user->id}} @endisset">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="@isset($user->name){{$user->name}}@endisset" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" required>
                        @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="@isset($user->email){{$user->email}}@endisset" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" required>
                        @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password" @empty($user->id) required @endempty>
                        @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')
<script>

</script>
@stop
