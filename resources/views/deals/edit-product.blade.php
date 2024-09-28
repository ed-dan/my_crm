@extends('layouts.admin-lte')
@section('edit')
    @include("partials._script")
@endsection
@section('content')

    <link rel="stylesheet" href="/css/app.css">
    <section class="content w-80 mt-5" style="float:right; width: 750px">
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-5">
                            @include("partials._close-button")
                            <div class="card-header " id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <div class="card-footer ">
                                            <div class="row">
                                                <div class="col">
                                                    <ul id="progress-bar" class="progressbar">
                                                        <li class="active">Awareness</li>
                                                        <li class="active">Interest</li>
                                                        <li>Decision</li>
                                                        <li>Action</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method="POST" action="/employees"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <h3>
                                                Lead data:
                                            </h3>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name" id="name"
                                                           placeholder="Enter your name"
                                                           value="">
                                                </div>
                                                @error('name')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label"> Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="email"
                                                           placeholder="Enter your email"
                                                           value="">
                                                </div>
                                                @error('email')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label"> Number</label>
                                                <div class="col-sm-10">
                                                    <input id="autogap" maxlength="10" type="text" class="form-control"
                                                           name="phone"
                                                           placeholder="Required format 000 00 00 000" value="">
                                                </div>
                                                @error('phone')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">Source</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                           placeholder="Enter your name"
                                                           value="">
                                                </div>
                                                @error('source')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">Source</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                           placeholder="Enter your name"
                                                           value="Product ">
                                                </div>
                                                @error('source')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-default">
                                                    <a href="/" class="text-black"> Back </a>
                                                </button>
                                                <button type="submit" class="btn btn-info float-right">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
