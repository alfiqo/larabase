@extends('adminlte::page')

@section('title', 'Role Settings')

@section('content_header')
<!-- <h1>Role Settings</h1> -->
@stop

@section('content')
<div class="row">
    @if (session('status'))
    <div class="col-12">
        <div class="alert alert-{{session('alert')}}">
            {{ session('status') }}
        </div>
    </div>
    @endif
    <div class="col-4">
        <h3 class="text-secondary">Role Settings</h3>
        <p class="text-secondary">A permission can be revoked from a role</p>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h3 class="text-secondary">Role {{ucwords($role->name)}}</h3>
                <hr>
                <h4 class="text-secondary">Permission that granted: {{count($role->permissions)}}</h4>
                <ul class="list-group list-group-flush">
                    @foreach($role->permissions as $permission)
                    <li class="list-group-item py-2 d-flex">{{$permission->name}} &emsp;
                        <form action="{{ route('roles.revoke_permission', [$role->id, $permission->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary btn-xs" title="revoke permission"><i class="fa fa-times"></i></button>
                        </form>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h3 class="text-secondary">Available Permissions</h3>
        <p class="text-secondary">A permission can be given to a role</p>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="text-secondary">Permission list: {{count($permissions)}}</h4>
                <ul class="list-group list-group-flush">
                    @foreach($permissions as $permission)
                    <!-- <li class="list-group-item py-2">{{$permission->name}} &emsp;<a href="#" class="btn btn-xs btn-info" title="give permission for this role"><i class="fa fa-check"></i></a></li> -->
                    <li class="list-group-item py-2 d-flex">{{$permission->name}} &emsp;
                        <form action="{{ route('roles.give_permission', $role->id) }}" method="POST">
                            <input type="hidden" name="permission" value="{{$permission->name}}">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-info" title="give permission"><i class="fa fa-check"></i></button>
                        </form>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
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
