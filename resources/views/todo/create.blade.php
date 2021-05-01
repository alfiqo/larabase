@extends('adminlte::page')

@section('title', 'Todo')

@section('content_header')
<h1>Todo</h1>
@stop

@section('content')

@php
    $id = null;
    $route_name = 'todos.store';
@endphp

@isset($todo->id)
    @php
        $id = $todo->id;
        $route_name = 'todos.update';
    @endphp
@endisset

<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add New Todo</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($route_name, $id) }}" method="POST">
                @csrf
                @isset($todo->id)
                    @method('PUT')
                @endisset
                <input type="hidden" name="id" value="@isset($todo->id) {{$todo->id}} @endisset">
                <div class="card-body">
                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" name="name" value="@isset($todo->name) {{$todo->name}} @endisset" class="form-control @error('name') is-invalid @enderror" id="task" placeholder="Masukan task">
                        @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{route('todos.index')}}" class="btn btn-default">Cancel</a>
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
