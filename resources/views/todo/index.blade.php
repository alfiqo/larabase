@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Todo</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        @if (session('status'))
        <div class="alert alert-{{session('alert')}}">
            {{ session('status') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Todo List</h3>
                <div class="float-right">
                    <a href="{{route('todos.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 50px">#</th>
                            <th>Task</th>
                            <th style="width: 160px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $number = 1;
                        $perPage = Config::get('custom.perPage');
                        $pageNumber = null !== request()->query('page') ? (int)request()->query('page') : 1;
                        $currentNumber = ($pageNumber - 1) * $perPage + $number;
                        @endphp

                        @forelse($todos as $key => $todo)
                        <tr>
                            <td>{{$currentNumber++}}</td>
                            <td>{{$todo->name}}</td>
                            <td class="text-center">
                                <div class="form-inline d-inline-flex">
                                    <a href="{{route('todos.edit', $todo->id)}}" class="btn btn-secondary btn-small" title="edit"><i class="fa fa-edit"></i></a>
                                    &nbsp;
                                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-small" title="hapus"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <center> <i class="fa fa-exclamation-circle"></i> Tidak ada data</center>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $todos->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('css')
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"></script>
@stop

@section('js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
</script>
@stop
