@extends('layouts.main')
@section('title', 'Список Ролей')
@section('content')
<div class="container-table">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 d-flex justify-content-between">
                            <x-role-button
                                :roles="['admin', 'creator']"
                                buttonText="Add new"
                                :route="route('roles.create')"
                                buttonClass="btn btn-sm btn-primary add-new"
                                icon="fa fa-plus-circle">
                            </x-role-button>
                
                            <form action="{{ route('roles.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request()->get('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fa fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                @if(Auth::user()->roles->pluck('name')->intersect(['admin', 'editor'])->isNotEmpty())
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td> {{$loop->index + 1}}</td>
                                    <td> {{$role->name}} </td>
                                    @if(Auth::user()->roles->pluck('name')->intersect(['admin', 'editor'])->isNotEmpty())
                                        <td style="display: flex;">
                                            <x-role-button
                                                :roles="['admin', 'editor']"
                                                :route="route('roles.edit', ['role' => $role])"
                                                buttonClass="btn btn-primary btn-edit"
                                                icon="fa fa-pencil-alt">
                                            </x-role-button>
                                            <x-role-button
                                                :roles="['admin']"
                                                :route="route('roles.destroy', ['role' => $role->id])"
                                                buttonClass="btn btn-danger btn-delete"
                                                icon="fa fa-times"
                                                method="DELETE">
                                            </x-role-button>                                    
                                        </td>
                                    @endif 
                                </tr>
                            @endforeach           
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $roles->links() }}
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Ви впевнені, що хочете видалити цей елемент?');
    }
</script>   
@endsection

