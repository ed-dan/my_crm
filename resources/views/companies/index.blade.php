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
                                                    <button type="submit" class="btn btn-secondary mr-5">Select</button>


                                                </div>

                                            </form>

                                        </div>
                                        @if(auth()->user()->position_id == App\Models\User::ADMIN_ID)
                                            <div style="float: right">
                                                Add new Company
                                                <button type="submit" class=" button mr-3 ml-3">
                                                    <a class="text-black" href="{{route("company.create")}}">
                                                     Create
                                                    </a>

                                                </button>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    main /////////// --}}

                    @foreach($companies as $company)
                        <div class="col-md-4">
                            <div class="card mt-0">
                                <div class="card-header" id="">
                                    <div class="bg-company-logo p-3">
                                        <div class="d-inline-block mt-2">
                                            <h5>
                                                {{ $company->name }}
                                            </h5>
                                        </div>
                                        <div style="float: right;">
                                            <div class="d-inline-block mr-1 " style="float: right;">
                                                <button type="button" class="btn btn-block btn-outline-light ">
                                                    <a class="text-black" href={{ route("company.show", $company->id)}} >
                                                        <ion-icon name="search-outline"></ion-icon>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Company address:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                {{ $company->address }}
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Company phone:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                {{ $company->company_phone }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Company website:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                {{ $company->website }}
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div>--}}
{{--                                        <div class="d-inline-block mt-3 ml-1">--}}
{{--                                            <h6>--}}
{{--                                                Category:--}}
{{--                                            </h6>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">--}}
{{--                                            <div style="">--}}
{{--                                                @foreach($products as $product)--}}
{{--                                                    @if($product->company_id == $company->id)--}}
{{--                                                        {{ $product->category_title }}--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <hr>

                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Product List:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                @foreach($products as $product)
                                                    @if($product->company_id == $company->id)
                                                        <h6>{{ $product->title }}</h6>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <link rel="stylesheet" href="/css/app.css">

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
