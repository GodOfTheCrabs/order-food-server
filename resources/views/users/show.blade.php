@extends('layouts.main')
@section('title', 'Деталі')
@section('content')
<div class="container">
    <div class="col-md-12 col-lg-12">
        <article class="post vt-post">
            <div class="row">
                
                <div class="col-xs-12 col-sm-5 col-md-4">
                    <div class="post-type post-img text-center">
                        <img src="{{ asset("storage/$user->photo_url") }}" class="img-fluid rounded shadow" alt="User photo" style="max-width: 80%; height: auto;">
                    </div>
                    <div class="author-info author-info-2 mt-4 text-center">
                        <ul class="list-inline">
                            <li>
                                <div class="info">
                                    <p class="text-muted mb-1">Created At:</p>
                                    <strong>{{ $user->created_at->format('d F Y, H:i') }}</strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-7 col-md-8">
                    <div class="caption p-3 bg-light border rounded">
                        <h3 class="md-heading mb-4 text-primary">User № {{ $user->id }}</h3>
                        
                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Email:</h4>
                            <p class="col-8 mb-0"><b>{{ $user->email }}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Phone:</h4>
                            <p class="col-8 mb-0"><b>{{ $user->phone }}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">First name:</h4>
                            <p class="col-8 mb-0"><b>{{ $user->first_name }}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Last name:</h4>
                            <p class="col-8 mb-0"><b>{{ $user->last_name }}</b></p>
                        </div>

                        <div class="row align-items-center mb-5">
                            <h4 class="col-4 text-end text-muted mb-0">Gender:</h4>
                            <p class="col-8 mb-0"><b>{{ $user->gender }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <div class="clearfix"></div>
    </div>
</div>

@endsection

