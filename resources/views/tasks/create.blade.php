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
                                        {{--                                        @include("partials._step-bar")--}}
                                        <form class="form-horizontal" method="POST"
                                              action="{{ route('task.store', $deal->id) }}"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <h5 class="mt-3">
                                                Create task:
                                            </h5>
                                            <hr>
                                            <div class="form-group row mt-4">
                                                <label for="title"
                                                       class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control"
                                                           placeholder="Enter your name"
                                                           value="{{$lead[0]->name}} Callback">
                                                    @error('title')
                                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-2 col-form-label ">Status</label>
                                                <div class="col-sm-10">
                                                    <select name="priority"  class="select-width form-control">
                                                        <option></option>
                                                        <option name="priority" value="Very High"> <h6>Very High</h6></option>
                                                        <option name="priority" value="High"><h6>High</h6></option>
                                                        <option name="priority" value="Medium"><h6>Medium</h6></option>
                                                        <option name="priority" value="Low"><h6>Low</h6></option>
                                                    </select>
                                                </div>
                                                @error('priority')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">DateTime</label>
                                                <div class="col-sm-10">
                                                    <div class="input-container">
                                                        <input type="date" name="deadline" class="form-control"
                                                               placeholder="Enter your name"
                                                               value="">
                                                        <input type="time" name="time" class="form-control mr-0"
                                                               placeholder=""
                                                               value="">
                                                        <style>
                                                            .input-container {
                                                                display: flex;
                                                            }
                                                            .input-container input {
                                                                width: 50%;
                                                                box-sizing: border-box;
                                                                margin-right: 10px;
                                                            }
                                                        </style>
                                                        <style>
                                                            .counter {
                                                                display: inline-block;
                                                                font-size: 24px;
                                                                text-align: center;
                                                                width: 100px;
                                                            }
                                                            .counter input {
                                                                width: 60px;
                                                                font-size: inherit;
                                                                text-align: center;
                                                            }
                                                            .counter button {
                                                                padding: 5px;
                                                                font-size: inherit;
                                                                cursor: pointer;
                                                                border: none;
                                                                background: none;
                                                                color: #333;
                                                                transition: color 0.3s ease;
                                                            }
                                                            .counter button:hover {
                                                                color: #555;
                                                            }
                                                            .arrow-up {
                                                                transform: rotate(180deg);
                                                            }
                                                        </style>
                                                    </div>
                                                </div>
                                                @error('date')
                                                <p class="">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group row  ">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">Note</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="subject" id="" cols="30" rows="8"></textarea>
                                                </div>
                                                @error('subject')
                                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="/" class="text-black"> Back </a>
                                                </button>

                                                <button type="submit"
                                                        class="btn btn-warning float-right text-black"
                                                        style="width: 120px;">
                                                    Create Task
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


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

@endsection
{{--    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>--}}
{{--    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}"></script>--}}
{{--                                            <style>--}}
{{--                                                .input-container {--}}
{{--                                                    display: flex;--}}
{{--                                                }--}}
{{--                                                .input-container input {--}}
{{--                                                    width: 50%;--}}
{{--                                                    box-sizing: border-box;--}}
{{--                                                    margin-right: 10px;--}}
{{--                                                }--}}
{{--                                            </style>--}}
{{--                                            <style>--}}
{{--                                                .counter {--}}
{{--                                                    display: inline-block;--}}
{{--                                                    font-size: 24px;--}}
{{--                                                    text-align: center;--}}
{{--                                                    width: 100px;--}}
{{--                                                }--}}
{{--                                                .counter input {--}}
{{--                                                    width: 60px;--}}
{{--                                                    font-size: inherit;--}}
{{--                                                    text-align: center;--}}
{{--                                                }--}}
{{--                                                .counter button {--}}
{{--                                                    padding: 5px;--}}
{{--                                                    font-size: inherit;--}}
{{--                                                    cursor: pointer;--}}
{{--                                                    border: none;--}}
{{--                                                    background: none;--}}
{{--                                                    color: #333;--}}
{{--                                                    transition: color 0.3s ease;--}}
{{--                                                }--}}
{{--                                                .counter button:hover {--}}
{{--                                                    color: #555;--}}
{{--                                                }--}}
{{--                                                .arrow-up {--}}
{{--                                                    transform: rotate(180deg);--}}
{{--                                                }--}}
{{--                                            </style>--}}
{{--                                            <script>--}}
{{--                                                let count = 0;--}}

{{--                                                function updateCount() {--}}
{{--                                                    count = parseInt(document.getElementById('count').value) || 0;--}}
{{--                                                }--}}

{{--                                                function increment() {--}}
{{--                                                    count++;--}}
{{--                                                    updateCount();--}}
{{--                                                    document.getElementById('count').value = count;--}}
{{--                                                }--}}

{{--                                                function decrement() {--}}
{{--                                                    if (count > 0) {--}}
{{--                                                        count--;--}}
{{--                                                        updateCount();--}}
{{--                                                        document.getElementById('count').value = count;--}}
{{--                                                    }--}}
{{--                                                }--}}
{{--                                            </script>--}}
{{--<script>--}}
{{--    $(function () {--}}
{{--        var availableTags = [--}}
{{--            "Kyiv",--}}
{{--            "Kharkiv",--}}
{{--            "Odesa",--}}
{{--            "Dnipro",--}}
{{--            "Lviv",--}}
{{--            "Zaporizhzhia",--}}
{{--            "Donetsk",--}}
{{--            "Zaporizhzhia",--}}
{{--            "Kryvyi Rih",--}}
{{--            "Mykolaiv",--}}
{{--            "Sevastopol",--}}
{{--            "Mariupol",--}}
{{--            "Luhansk",--}}
{{--            "Vinnytsia",--}}
{{--            "Makiivka",--}}
{{--            "Simferopol",--}}
{{--            "Chernihiv",--}}
{{--            "Kherson",--}}
{{--            "Poltava",--}}
{{--            "Khmelnytskyi",--}}
{{--            "Cherkasy",--}}
{{--            "Ivano-Frankivsk"--}}
{{--        ];--}}
{{--        $("#tags").autocomplete({--}}
{{--            source: availableTags--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
