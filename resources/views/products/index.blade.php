@extends('layouts.admin-lte')

@section('content')
    <section class="content w-80 mt-5" style="">

        {{--        @foreach($leads as $lead)--}}
        {{--            {{ $lead->name }}--}}
        {{--        @endforeach--}}
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="card mt-5">
                                <div class="card-header" id="">
                                    <div class="col-md-12">
                                        <div class="form-inline">
                                            <div class=" ">
                                                <form class="row g-3 " action="/products">
                                                    <div class="col-auto col-auto mt-3 ">
                                                        <input type="text" class="form-control" name="search"
                                                               placeholder="Search">

                                                        <button type="submit" class="btn btn-primary mr-3">Search
                                                        </button>
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
                                                        <button type="submit" class="btn btn-secondary mr-5">Select
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            @if(auth()->user()->position_id == App\Models\User::ADMIN_ID)
                                            <div style="float: right">
                                                Add new Product
                                                <button type="submit" class=" button mr-3 ml-3">
                                                    <a class="text-black" href="{{route("product.create")}}">
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
                        <div class="card mr-2 ml-1">
                            <div class="card-header" id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                        <table class="table m-0">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <h5>Product Title</h5>
                                                </th>
                                                <th>
                                                    <h5>Product Category</h5>
                                                </th>
                                                <th>
                                                    <h5>Product Company</h5>
                                                </th>
                                                <th>
                                                    <h5>Identifier</h5>
                                                </th>
                                                <th>
                                                    <h5>Product Price</h5>
                                                </th>
                                                <th>
                                                    <h5>Quantity</h5>
                                                </th>

                                                <th>
                                                    <h5>Action</h5>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>
                                                        <h6>{{$product->title}}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{$product->category_title}}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{$product->company_title}}</h6>
                                                    </td>

                                                    <td>
                                                        <h6>{{"id: " .  $product->identifier}}</h6>
                                                    </td>

                                                    <td>
                                                        <h6>{{$product->price . ".00 $"}}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{rand(20,200) }}  pcs.</h6>
                                                    </td>

                                                    <td>
                                                        <div class="md:inline" data-color="#00a65a"
                                                             data-height="20">
                                                            <div class="btn-group">
                                                                <form action="">
                                                                    <button type="button"
                                                                            class="btn btn-block btn-default">
                                                                        <a class="link-color-blue text-black"
                                                                           href="">
                                                                            About
                                                                        </a>
                                                                    </button>
                                                                </form>

                                                                <link rel="stylesheet" href="/css/app.css">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3 ">
{{--                                        {{ $deals ->links() }}--}}
                                        {{--                                        {{ $deals->links() }}--}}
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
