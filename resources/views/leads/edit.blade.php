@extends('layouts.admin-lte')
@section('edit')
    @include("partials._script")
@endsection
@section('content')
    <section class="content w-80 mt-5" style="float:right; width: 750px">
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-5">
                            <div class="">
                                <ul class="nav nav-treeview" style="float: right;">
                                    <li class="nav-item">
                                        <button type="button" style="height: 35px; width: 40px" class=" btn  btn-danger ">
                                            <a class="link-color-red text-black" href="#">
                                                <ion-icon name="close-outline"></ion-icon>
                                            </a>
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-header " id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                        <div class="card-footer ">
                                            <div class="row">
                                                <div class="col">
                                                    <ul id="progress-bar" class="progressbar">
                                                        <li class="active">Awareness</li>
                                                        <li>Interest</li>
                                                        <li>Decision</li>
                                                        <li>Action</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method="POST"
                                              action="{{ route('lead.update', $lead->id) }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <h3 class="mt-3">
                                                Lead data:

                                            </h3>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                           id="name" placeholder="Enter your name"
                                                           value="{{$lead->name}}">
                                                </div>
                                                @error('name')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label">
                                                    Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="email"
                                                           placeholder="Enter your email"
                                                           value=" {{$lead->email}}">
                                                </div>
                                                @error('email')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label">
                                                    Number</label>
                                                <div class="col-sm-10">
                                                    <input id="" maxlength="12" type="text"
                                                           class="form-control" name="phone"
                                                           placeholder="Required format 000 00 00 000"
                                                           value="{{$lead->phone}}">
                                                </div>
                                                @error('phone')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">Source</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="source"
                                                           placeholder="Enter your name"
                                                           value="{{$lead->source}} " disabled>
                                                </div>
                                                @error('source')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">Product</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter your name"
                                                           value="{{$product->title}}" disabled>
                                                </div>
                                            </div>

                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="/" class="text-black"> Back </a>
                                                </button>
                                                <button type="submit" class="btn btn-default ml-5" style="width: 120px;">
                                                    <a href="/" class="text-black"> Create Task  </a>
                                                </button>
                                                <button type="submit" class="btn btn-info float-right">Next
                                                </button>
                                            </div>
                                            <!-- /.card-footer -->
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

{{--        <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css')}}"--}}
{{--              rel="stylesheet">--}}
{{--        <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>--}}
{{--        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}"></script>--}}
{{--        <link rel="stylesheet"--}}
{{--              href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>--}}
