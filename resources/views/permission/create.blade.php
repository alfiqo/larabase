@extends('adminlte::page')

@section('title', 'Permission')

@section('content_header')
<h1>Permission</h1>
@stop

@section('content')

@php
    $id = null;
    $route_name = 'permissions.store';
@endphp

@isset($permission->id)
    @php
        $id = $permission->id;
        $route_name = 'permissions.update';
    @endphp
@endisset

<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add New</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($route_name, $id) }}" method="POST">
                @csrf
                @isset($permission->id)
                    @method('PUT')
                @endisset
                <input type="hidden" name="id" value="@isset($permission->id) {{$permission->id}} @endisset">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Permission</label>
                        <input type="text" name="name" value="@isset($permission->name){{$permission->name}}@endisset" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukan permission">
                        @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{route('permissions.index')}}" class="btn btn-default">Cancel</a>
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
