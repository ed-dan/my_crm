@extends('layouts.admin-lte')

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
                                                    <ul id="progress-bar" class="progressbar-red">
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

                                        <form class="form-horizontal" method="POST"
                                              action="{{ route('deal.close', $deal->id) }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="alert alert-danger-red" role="alert">
                                                <h4 class="alert-heading">Customer canceled the order</h4>
                                                <p></p>
                                                <hr>
                                                <p class="mb-0">Don't forget to choose the reason why the client refused.</p>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="mt-4">
                                                    <h4 class="alert-heading "> Choose the reason</h4>
                                                </div>
                                                <hr>
                                                <select name="status"  class="select-width form-control ">
                                                    <option></option>
                                                    <option name="status" value="3">Too expensive</option>
                                                    <option name="status" value="4">Changed his mind</option>
                                                    <option name="status" value="5">Disloyal customer</option>
                                                </select>

                                                @error('status')
                                                    <p class="text-red-500 text-xs mt-1">Don't foget to choose the reason </p>
                                                    @enderror
                                            </div>
                                            <div class="p-4">

                                            </div>
                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="/" class="text-black"> Main </a>
                                                </button>
                                                <button class="btn btn-default ml-5"
                                                        style="width: 120px;">
                                                    <a href="/" class="text-black"> Create Task </a>
                                                </button>
                                                <button type="submit" class="btn btn-danger float-right" style="width: 120px;">
                                                    Close Deal
                                                </button>
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



