@extends('layouts.main')
@section('title', 'Список Їжі')
@section('content')
@vite('resources/css/show.css')
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
                                :route="route('foods.create')"
                                buttonClass="btn btn-sm btn-primary add-new"
                                icon="fa fa-plus-circle">
                            </x-role-button>
                
                            <form action="{{ route('foods.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request()->get('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fa fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                                                        
                                    <select name="filter" class="form-control ml-2">
                                        <option disabled selected>Filtered by</option>>
                                        <option value="name" {{ request()->get('filter') == 'name' ? 'selected' : '' }}>By Name</option>
                                        <option value="created_at" {{ request()->get('filter') == 'created_at' ? 'selected' : '' }}>By Date</option>
                                        <option value="price" {{ request()->get('filter') == 'price' ? 'selected' : '' }}>By Price</option>
                                    </select>
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
                                <th>Price</th>
                                <th>Category</th>
                                @if(Auth::user()->roles->pluck('name')->intersect(['admin', 'editor'])->isNotEmpty()) 
                                    <th>Actions</th>
                                @endif
                                <th>View detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td> {{$loop->index + 1}}</td>
                                    <td> {{$food->name}} </td>
                                    <td> {{$food->price}} </td>
                                    <td> {{$food->category->name}} </td>
                                    @if(Auth::user()->roles->pluck('name')->intersect(['admin', 'editor'])->isNotEmpty())
                                        <td style="display: flex;">
                                            <x-role-button
                                                :roles="['admin', 'editor']"
                                                :route="route('foods.edit', ['food' => $food])"
                                                buttonClass="btn btn-primary btn-edit"
                                                icon="fa fa-pencil-alt">
                                            </x-role-button>
                                            <x-role-button
                                                :roles="['admin']"
                                                :route="route('foods.destroy', ['food' => $food->id])"
                                                buttonClass="btn btn-danger btn-delete"
                                                icon="fa fa-times"
                                                method="DELETE">
                                            </x-role-button>
                                            
                                        </td>
                                    @endif  
                                    <td class="view-detail">  <a href={{route('foods.show', ['food' => $food])}} class="btn btn-primary btn-success"><i class="fa fa-magnifying-glass"></i></a> </td>
                                </tr>
                            @endforeach
                        </tbody>           
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $foods->links() }}
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Ви впевнені, що хочете видалити цей елемент?');
    }
</script>   
@endsection

