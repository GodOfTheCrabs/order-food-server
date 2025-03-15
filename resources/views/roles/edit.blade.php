@extends('layouts.main')
@section('title', 'Створення нового запису')
@section('content')
<div class="container">

    <form class="well form-horizontal admin-form" action={{route('roles.update', $role->id)}} method="POST">
        @csrf
        @method('PUT')
        <fieldset class="field-form">

        <!-- Form Name -->
        <legend>Edit Role № {{$role->id   }} </legend>

        {{-- Error Block --}}

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
 

        <!-- Text area -->
        
        <div class="form-group">
            <label class="control-label" >Category name</label> 
            <div class="inputGroupContainer">
                <div class="input-group">
                    <input name="name" placeholder="Name" class="form-control  @error('name') is-invalid @enderror"  type="text" value="{{ old('name', $role->name) }}">
                </div>          
            </div>
        </div>
        @error('name')
            <div class="alert alert-danger  error-block">{{ $message }}</div>
        @enderror

        <!-- Button -->
        <div class="form-group">
            <label class="control-label"></label>
            <div class="">
                <button type="submit" class="btn btn-warning" >Edit <span class="glyphicon glyphicon-send"></span></button>
            </div>
        </div>

        </fieldset>
    </form>

</div><!-- /.container -->
@endsection