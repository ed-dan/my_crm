@extends('layouts.admin-lte')

@section('content')

    <section class="content Scroll mr-4">
        <div class="container-fluid">
            <div class="mt-5 ml-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-5">
                            <div class="card-header" id="">
                                <div class="col-md-12">
                                    <div class="form-inline">
                                        <div class=" ">
                                            <form class="row g-3 " action="/tasks">
                                                <div class="col-auto col-auto mt-3 ">
                                                    <input type="text" class="form-control" name="search"
                                                           placeholder="Search">

                                                    <button type="submit" class="btn btn-primary mr-3">Search</button>
                                                    Sort by:
                                                    <select name="sort" class="select-width form-control ml-1 mr-3">
                                                        <option></option>
                                                        <option name="sort" value="asc">Date ascending</option>
                                                        <option name="sort" value="desc">Date descending</option>
                                                    </select>


                                                    Select Only:
                                                    <select name="only" class="select-width form-control ml-1">
                                                        <option></option>
                                                        <option name="only" value="=">Actual Tasks</option>
                                                        <option name="only" value=">">Upcoming Tasks</option>
                                                        <option name="only" value="<">Past-due Tasks</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-secondary mr-3">Select</button>
                                                    @if(($position == "Admin"))
                                                        Choose Manger:
                                                        <select name="employee" class="select-width form-control ml-1">
                                                            <option></option>
                                                            @foreach($employees as $employee)
                                                                <option name="employee" value="{{$employee->id}}">{{$employee->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <button style="width: 80px" type="submit" class="btn btn-secondary mr-5">Choose</button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    main /////////// --}}

                    @foreach($tasks as $task)
                        <div class="col-md-4">
                            <div class="card mt-0">
                                <div class="card-header" id="">
                                    <div>
                                        <div class="d-inline-block mt-3">
                                            <h6>
                                                {{ $task->title }}
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mr-1 " style="float: right;">
                                            <button type="button" class="btn btn-block btn-outline-warning ">
                                                @if(($task->stage_id == 2) or ($task->stage_id == 3))
                                                    @php
                                                    //dd($task->id);
                                                    @endphp
                                                    <a class="text-black" href={{ route("deal.about", $task->id)}} >
                                                        <ion-icon name="search-outline"></ion-icon>
                                                    </a>
{{--                                                @elseif($task->stage_id == 3)--}}
{{--                                                    <a class="text-black" href={{route("deal.about", $task->id)}} >--}}
{{--                                                        <ion-icon name="search-outline"></ion-icon>--}}
{{--                                                    </a>--}}
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <link rel="stylesheet" href="/css/app.css">
                                        @php
                                            $day = explode(" ", $task->deadline);
                                            $day = intval(substr($day[0], -2));
                                            $date = intval(date("d"));
                                        @endphp
                                        @if(($date - $day) == 0)
                                            <div class="d-inline-block alert-success-green p-1">
                                                {{$task->deadline}}
                                            </div>
                                        @elseif(($date - $day) < 0)
                                            <div class="d-inline-block alert-success-yellow p-1">
                                                {{$task->deadline}}
                                            </div>
                                        @elseif(($date - $day) > 0)
                                            <div class="d-inline-block alert-danger-red p-1">
                                                {{$task->deadline}}
                                            </div>
                                        @endif
                                        <div class="d-inline-block " role="alert" style="float: right;">
                                            <div class="mr-1">
                                                @if($position == "Admin")
                                                    <h6>
                                                        {{$task->name}}
                                                    </h6>
                                                @else
                                                    <h6>
                                                        {{$task->priority}}
                                                    </h6>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
