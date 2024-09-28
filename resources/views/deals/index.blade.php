@extends('layouts.admin-lte')

@section('content')
    <section class="content w-80 mt-5" style="">

        {{--        @foreach($leads as $lead)--}}
        {{--            {{ $lead->name }}--}}
        {{--        @endforeach--}}
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12 mt-5">
                        @include('partials._search')
                        <div class="card">
                            <div class="card-header" id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                        <table class="table m-0">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <h5>Client Name</h5>
                                                </th>
                                                <th>
                                                    <h5>Client Phone</h5>
                                                </th>
                                                <th>
                                                    <h5>Products</h5>
                                                </th>
                                                <th>
                                                    <h5>Amount</h5>
                                                </th>
                                                <th>
                                                    <h5>Stage</h5>
                                                </th>
                                                <th>
                                                    <h5>City</h5>
                                                </th>

                                                <th>
                                                    <h5>Closing Date</h5>
                                                </th>
                                                <th>
                                                    <h5>Deal Owner</h5>
                                                </th>
                                                <th class="mr-5">
                                                    <h5 class="mr-5">Status</h5>
                                                </th>
                                                <th>
                                                    <h5>Action</h5>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($deals as $deal)
                                                <tr>
                                                    <td>
                                                        <h6 class="mt-3">{{$deal->name}}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-3">+{{$deal->phone}}</h6>
                                                    </td>
                                                    <td>
                                                        @foreach($products as $product)
                                                            @php
                                                                $product_name = "";
                                                                    $product_list = explode(" ", $deal->products);
//                                                                    foreach ($product_list as $p){
                                                                        $p = explode("*", $product_list[0]);
                                                                            if ($product->id == $p[0]){
                                                                            $product_name = $product->title;
//                                                                    }
                                                                    }
                                                            @endphp
                                                            <h6 class="mb-0 mt-3">{{$product_name}}</h6>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-3">{{$deal->amount}},00$</h6>
                                                    </td>
                                                    <td>
                                                        @foreach($stages as $stage)
                                                            @if($deal->stage_id == $stage->id)
                                                                <h6 class="mt-3">{{$stage->title}}</h6>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if( $deal->city == "")
                                                            <h6 class="mt-3">Unselected</h6>
                                                        @endif
                                                        <h6 class="mt-3">{{$deal->city}}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-3">{{$deal->closing_date}}</h6>
                                                    </td>
                                                    <td>
                                                        @foreach($employees as $employee)
                                                            @if($deal->employee_id == $employee->id)
                                                                <h6 class="mt-3">{{$employee->name}}</h6>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if($deal->status_id > 2 )
                                                            <div class="alert alert-danger-red mb-0" role="alert">
                                                                <h6 class="mt-0 mb-0 ml-3">
                                                                    Reject
                                                                </h6>
                                                            </div>
                                                        @endif
                                                        @if($deal->status_id == 1 )
                                                            <div class="alert alert-success-green mb-0" role="alert">
                                                                <h6 class="mt-0 mb-0 ml-3">
                                                                    Confirm
                                                                </h6>
                                                            </div>
                                                        @endif
                                                        @if($deal->status_id == 2 )
                                                            <div class="alert alert-success-yellow mb-0"  role="alert">
                                                                <h6 class="mt-0 mb-0 ml-3">
                                                                    Callback
                                                                </h6>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="md:inline" data-color="#00a65a"
                                                             data-height="20">
                                                            <div class="btn-group">
                                                                <form action="">
                                                                    <button type="button"
                                                                            class="btn btn-block btn-default">
                                                                        <a class="link-color-blue text-black"
                                                                           href="{{route("deal.about", $deal->id)}}">
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
                                        {{ $deals->links() }}
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
