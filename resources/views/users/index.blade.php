@extends('layouts.main')
@section('title', 'Список Користувачів')
@section('content')
<div class="container-table">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 d-flex justify-content-between">               
                            <form action="{{ route('users.index') }}" method="GET" class="form-inline">
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
                                <th>Email</th>
                                <th>Phone</th>
                                @if(Auth::user()->roles->pluck('name')->intersect(['admin'])->isNotEmpty())
                                    <th>Actions</th>
                                @endif
                                <th>View detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td> {{$loop->index + 1}}</td>
                                    <td> {{$user->email}} </td>
                                    <td> {{$user->phone}} </td>
                                    @if(Auth::user()->roles->pluck('name')->intersect(['admin'])->isNotEmpty())
                                        <td style="display: flex;">
                                            <x-role-button
                                                :roles="['admin']"
                                                :route="route('users.destroy', ['user' => $user->id])"
                                                buttonClass="btn btn-danger btn-delete"
                                                icon="fa fa-times"
                                                method="DELETE">
                                            </x-role-button>
                                        </td>
                                    @endif
                                    <td class="view-detail">  <a href={{route('users.show', ['user' => $user])}} class="btn btn-primary btn-success"><i class="fa fa-magnifying-glass"></i></a> </td>
                                </tr>
                            @endforeach       
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $users->links() }}
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Ви впевнені, що хочете видалити цей елемент?');
    }
</script>   
@endsection