@extends('layouts.admin-lte')

@section('content')
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>


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
                                                    <ul id="progress-bar" class="progressbar-yellow">
                                                        @foreach($stages as $stage)
                                                            @if($stage->id <= $deal->stage_id)
                                                                <li class="active">{{$stage->title}}</li>
                                                            @else
                                                                <li>{{$stage->title}}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-success-yellow" role="alert">
                                            <h4 class="alert-heading">Task successfully created!</h4>
{{--                                            <p>Task successfully saved.</p>--}}

                                            <hr>
                                            <p class="mb-0">Don't forget to do all of today's tasks</p>
                                        </div>
                                        <div class="card-footer p">
                                            <button class="btn btn-default">
                                                <a href="/" class="text-black"> Main </a>
                                            </button>
                                            <button type="submit" class="btn btn-default ml-5 float-right"
                                                    style="width: 120px;">
                                                <a href="/tasks" class="text-black"> My Tasks </a>
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


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

@endsection
