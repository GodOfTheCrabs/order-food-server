@extends('layouts.main')
@section('title', $food['title'])
@section('content')
<div class="container">
    <div class="col-md-12 col-lg-12">
        <article class="post vt-post">
            <div class="row">

                <div class="col-xs-12 col-sm-5 col-md-4">
                    <div class="post-type post-img text-center">
                        <img src="{{ asset("storage/$food->image") }}" class="img-fluid rounded shadow" alt="image post" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="author-info author-info-2 mt-4 text-center">
                        <ul class="list-inline">
                            <li>
                                <div class="info">
                                    <p class="text-muted mb-1">Created At:</p>
                                    <strong>{{$food->created_at->format('d F Y, H:i')}}</strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-7 col-md-8">
                    <div class="caption p-3 bg-light border rounded">
                        <h3 class="md-heading mb-4 text-primary">Food № {{$food->id}}</h3>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Name:</h4>
                            <p class="col-8 mb-0"><b>{{$food->name}}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Price:</h4>
                            <p class="col-8 mb-0"><b>{{$food->price}}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Category:</h4>
                            <p class="col-8 mb-0"><b>{{$food->category->name}}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Recipe:</h4>
                            <p class="col-8 mb-0"><b>{{$food->recipe}}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Rating:</h4>
                            @if($food->ratings && count($food->ratings) > 0)
                                @php
                                     $averageRating = round($food->ratings->pluck('rating')->avg(), 1);
                                @endphp
                                <p class="col-8 mb-0"><b>{{ $averageRating }}/5</b></p>
                            @else
                                <p class="col-8 mb-0"><b>0/5</b></p>
                            @endif
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Calories:</h4>
                            <p class="col-8 mb-0"><b>{{$food->calories}} kcal</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Proteins:</h4>
                            <p class="col-8 mb-0"><b>{{$food->protein}} g</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Fats:</h4>
                            <p class="col-8 mb-0"><b>{{$food->fat}} g</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Carbons:</h4>
                            <p class="col-8 mb-0"><b>{{$food->carbohydrates}} g</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Fiber:</h4>
                            <p class="col-8 mb-0"><b>{{$food->fiber}} g</b></p>
                        </div>
                    </div>
                </div>


            <!-- Комментарии -->
            <div class="comments-section mt-5">
                <h3 class="mb-4">Comments</h3>

                @foreach ($food->comments as $comment)
                    <div class="comment d-flex mb-4 p-3 border rounded">
                        <div class="user-avatar">
                            <img src="{{ asset("storage/$user->photo_url") }}" alt="User Avatar" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                        </div>
                        <div class="comment-body ms-3">
                            <div class="d-flex justify-content-between">
                                <div class="user-name fw-bold">
                                    {{ $comment->user->name ?? 'Невідомий' }}
                                </div>
                                <div class="comment-date text-muted">
                                    {{ $comment->created_at->format('d-m-Y H:i') }}
                                </div>
                            </div>
                            <p class="mt-2">{{ $comment->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </article>
    </div>
</div>

@endsection

