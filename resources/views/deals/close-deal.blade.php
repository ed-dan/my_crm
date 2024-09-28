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
    <section class="content w-80 mt-5" style="float:right; width: 750px">
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-5">
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
                                                        <li class="active">Action</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-success-green" role="alert">
                                            <h4 class="alert-heading">Deal successfully closed!</h4>
                                            <p>Deal successfully saved.</p>

                                            <hr>
                                            <p class="mb-0">If you need to complete any tasks related to this deal don't forget to create a task.</p>
                                        </div>
                                        <div class="card-footer p">
                                            <button class="btn btn-default">
                                                <a href="/" class="text-black"> Main </a>
                                            </button>
                                            <button type="submit" class="btn btn-default ml-5 float-right"
                                                    style="width: 120px;">
                                                <a href="/deals" class="text-black"> My Deals </a>
                                            </button>
                                        </div>
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
