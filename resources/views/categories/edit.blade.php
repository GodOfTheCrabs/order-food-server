@extends('layouts.main')
@section('title', 'Створення нового запису')
@section('content')
@vite('resources/js/showImage.js')
<div class="container">

    <form class="well form-horizontal admin-form" action={{route('categories.update', $category->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset class="field-form">

        <!-- Form Name -->
        <legend>Edit Category № {{$category->id   }} </legend>

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
                    <input name="name" placeholder="Name" class="form-control  @error('name') is-invalid @enderror"  type="text" value="{{ old('name', $category->name) }}">
                </div>          
            </div>
        </div>
        @error('name')
            <div class="alert alert-danger  error-block">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Edit category image</label>
            <input id="imageInput" class="form-control @error('image') is-invalid @enderror" type="file" name="image" accept="image/*">
            <div class="mt-3 d-flex justify-content-center" >
                <img id="imagePreview" src="{{asset("storage/$category->image")}}" alt="Image Preview" class="img-thumbnail" style="max-width: 300px;">
            </div>
        </div>

        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
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