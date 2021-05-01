@extends('adminlte::page')

@section('title', 'Permission')

@section('content_header')
<h1>Permission</h1>
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
                <h3 class="card-title">Permission List</h3>
                <div class="float-right">
                    <a href="{{route('permissions.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 50px">#</th>
                            <th>Permission</th>
                            <th style="width: 140px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $number = 1;
                        $perPage = Config::get('custom.perPage');
                        $pageNumber = null !== request()->query('page') ? (int)request()->query('page') : 1;
                        $currentNumber = ($pageNumber - 1) * $perPage + $number;
                        @endphp

                        @forelse($permissions as $key => $permission)
                        <tr>
                            <td>{{$currentNumber++}}</td>
                            <td>{{$permission->name}}</td>
                            <td class="text-center">
                                <div class="form-inline d-inline-flex">
                                    <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-secondary btn-sm" title="edit" @cannot('edit permissions') disabled="disabled" @endcannot><i class="fa fa-edit"></i></a>
                                    &nbsp;
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="delete" @cannot('delete permissions') disabled="disabled" @endcannot><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                <i class="fa fa-exclamation-circle"></i> Tidak ada data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $permissions->onEachSide(1)->links() }}
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
