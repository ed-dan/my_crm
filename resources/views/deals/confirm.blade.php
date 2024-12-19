@extends('layouts.admin-lte')


@section('edit')
    <section class="content pl-3 " style="float:left;width: 500px">
        <div class="p-5"></div>
        <h2>
            YOUR SCRIPT
        </h2>
        <div>
           Script Example
        </div>
    </section>
@endsection
@section('content')
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>
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
                                        <link rel="stylesheet" href="/css/app.css">
                                        <div class="card-footer ">
                                            <div class="row">
                                                <div class="col">
                                                    <ul id="progress-bar" class="progressbar">
                                                        <li class="active">Awareness</li>
                                                        <li class="active">Interest</li>
                                                        <li class="active">Decision</li>
                                                        <li>Action</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="mt-3">
                                            Confirm order:
                                        </h5>
                                        <hr>
                                        <div class="form-group row mt-4">
                                            <label for="name"
                                                   class="col-sm-2 col-form-label">Receiver</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                       placeholder="Enter your name"
                                                       value="{{$deal->lead->name}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="name"
                                                   class="col-sm-2 col-form-label ">Product list</label>
                                            <textarea style="width: 566px" class="form-control  ml-1" name="name" id="" cols="30" rows="4" disabled>{{$product_names}}</textarea>
                                              </div>

                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-sm-2 col-form-label">Total price</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                       placeholder="Enter your name"
                                                       value=" {{$amount}} $" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-sm-2 col-form-label">City</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                       placeholder="Enter city name" name="city"
                                                       id="tags"
                                                       value="{{$deal->city}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                       placeholder="Enter address" name="address" id="search"
                                                       value="{{$deal->address}}" disabled>
                                            </div>
                                        </div>
                                        <div class="card-footer p">
                                            <button class="btn btn-default">
                                                <a href="/" class="text-black"> Back </a>
                                            </button>
                                            <button class="btn btn-default ml-5" style="width: 120px;">
                                                <a href="{{route("task.create", $deal->id)}}" class="text-black">
                                                    Create Task </a>
                                            </button>
                                            <button class="btn btn-success float-right" style="width: 100px;">
                                                <a href="{{ route('deal.success', $deal->id) }}" class="text-black">
                                                    Confirm</a>
                                            </button>
                                        </div>
                                        {{--                                        </form>--}}
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

@endsection
