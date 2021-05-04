@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')
<h1>Role</h1>
@stop

@section('content')

@php
    $id = null;
    $route_name = 'roles.store';
@endphp

@isset($role->id)
    @php
        $id = $role->id;
        $route_name = 'roles.update';
    @endphp
@endisset

<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add New Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($route_name, $id) }}" method="POST">
                @csrf
                @isset($role->id)
                    @method('PUT')
                @endisset
                <input type="hidden" name="id" value="@isset($role->id) {{$role->id}} @endisset">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Role</label>
                        <input type="text" name="name" value="@isset($role->name){{$role->name}}@endisset" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="role">
                        @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{route('roles.index')}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
