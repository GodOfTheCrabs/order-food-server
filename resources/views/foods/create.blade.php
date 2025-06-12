@extends('layouts.main')
@section('title', 'Створення нового запису')
@section('content')
@vite('resources/js/showImage.js')
<div class="container">
    <form class="well form-horizontal admin-form" action={{route('foods.store')}} method="post"  enctype="multipart/form-data">
        @csrf
        <fieldset class="field-form">

        <!-- Form Name -->
        <legend>Create new product</legend>

        {{-- Error Block --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Text area -->

        <div class="form-group">
            <label class="control-label">Name</label>
            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input name="name" placeholder="Name" class="form-control  @error('name') is-invalid @enderror"  type="text" value="{{old('name')}}"}>
                </div>
            </div>
        </div>

        <!-- Text input-->

        <div class="form-group">
            <label class="control-label" >Price</label>
            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="price" placeholder="Price" class="form-control  @error('price') is-invalid @enderror"  type="number" value="{{old('price')}}"}>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Weight</label>
            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="weight" placeholder="Input weight" class="form-control  @error('weight') is-invalid @enderror"  type="number" step="0.1" value="{{old('weight')}}"}>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Select Category</label>
            <div class="selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                    <select name="category_id" class="form-control selectpicker @error('category_id') is-invalid @enderror" >
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="">
                <button type="button" id="showRecipeField" class="btn btn-warning">
                    Add recipe <span class="glyphicon glyphicon-send"></span>
                </button>
            </div>
        </div>

        <div class="form-group" id="recipeFieldContainer" style="display: none;">
            <label class="control-label">Recipe</label>
            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <textarea
                        class="form-control @error('recipe') is-invalid @enderror"
                        name="recipe"
                        placeholder="Recipe to product"
                    >{{ old('recipe')}}</textarea>
                </div>
            </div>
        </div>

            <div class="form-group">
                <div class="">
                    <button type="button" id="showDetailField" class="btn btn-warning">
                        Add detail<span class="glyphicon glyphicon-send"></span>
                    </button>
                </div>
            </div>

            <div class="form-group" id="detailField" style="display: none;">
                <label class="control-label">Calories</label>
                <div class="inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="calories" placeholder="Calories" class="form-control  @error('price') is-invalid @enderror"  type="number" value="{{old('calories')}}"}>
                    </div>
                </div>
                <label class="control-label">Fats</label>
                <div class="inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="fat" placeholder="Fats" class="form-control  @error('price') is-invalid @enderror"  type="number" value="{{old('fat')}}"}>
                    </div>
                </div>
                <label class="control-label">Carbons</label>
                <div class="inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="carbohydrates" placeholder="Carbons" class="form-control  @error('price') is-invalid @enderror"  type="number" value="{{old('carbohydrates')}}"}>
                    </div>
                </div>
                <label class="control-label">Proteins</label>
                <div class="inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="protein" placeholder="Proteins" class="form-control  @error('price') is-invalid @enderror"  type="number" value="{{old('protein')}}"}>
                    </div>
                </div>
                <label class="control-label">Fiber</label>
                <div class="inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="fiber" placeholder="Fiber" class="form-control  @error('price') is-invalid @enderror"  type="number" value="{{old('Fiber')}}"}>
                    </div>
                </div>
            </div>

        <div class="mb-3">
            <label class="form-label">Upload food image</label>
            <input id="imageInput" class="form-control @error('image') is-invalid @enderror" type="file" name="image" accept="image/*">
            <div class="mt-3 d-flex justify-content-center" >
                <img id="imagePreview" src="" alt="Image Preview" class="img-thumbnail" style="max-width: 300px; display: none;">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="control-label"></label>
            <div class="">
                <button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
            </div>
        </div>

        </fieldset>
    </form>
</div>
<script>
    document.getElementById('showRecipeField').addEventListener('click', function () {
        const recipeFieldContainer = document.getElementById('recipeFieldContainer');
        recipeFieldContainer.style.display = 'block';
        this.style.display = 'none';
    });

    document.getElementById('showDetailField').addEventListener('click', function () {
        const recipeFieldContainer = document.getElementById('detailField');
        recipeFieldContainer.style.display = 'block';
        this.style.display = 'none';
    });
</script>

@endsection
