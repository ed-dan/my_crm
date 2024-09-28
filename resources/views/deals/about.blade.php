@extends('layouts.admin-lte')

@section('content')
    <section class="content w-80 mt-5 ml-3 mr-2" style="">
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <div class="card-header" id="app">
                                @guest
                                @else
                                    <div class="mt-3 mb-3  ">
                                        <div style="width: 100%" class="">
                                            <div class=" float-left mb-3 ml-2" style="width: 100px;">
                                                <div class="text-black">
                                                    <h5>
                                                        Start
                                                    </h5>
                                                </div>
                                                <div>
                                                    {{$deal->lead_created_at}}
                                                </div>
                                            </div>
                                            <div class=" float-right mb-3" style="width: 140px;">
                                                <div class="text-black">
                                                    <h5>
                                                        Close Date
                                                    </h5>
                                                </div>
                                                <div>
                                                    @if($deal->status_id == 1)
                                                        {{$deal->closing_date}}
                                                    @elseif($deal->status_id >= 3)
                                                        {{$deal->closing_date}}
                                                    @else
                                                        Not closed
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="step-progress">
                                            @foreach($stages as $stage)
                                                @if($deal->stage_id==$stage->id)
                                                    @if($deal->status_id > 2 )
                                                        <div class="step active-red ">{{$stage->title}}</div>
                                                    @endif
                                                    @if($deal->status_id == 1 )
                                                        <div class="step active-green ">{{$stage->title}}</div>
                                                    @endif
                                                    @if($deal->status_id == 2 )
                                                        <div class="step active-yellow ">{{$stage->title}}</div>
                                                    @endif
                                                @else
                                                    <div class="step ">{{$stage->title}}</div>
                                                @endif
                                            @endforeach
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
@section('content1')
    <section class="content w-80 ml-3 mr-2" style="">
        <div class="container-fluid">
            <div class="mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                    </div>
                                    <div style="width: 50%">
                                        <div style="float: right">
                                        </div>
                                        <div class=" ml-2" style="">
                                            <h5 class="ml-3">
                                                Manager Data:
                                            </h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-3 ml-5 d-inline">
                                        <div class="form-group row  ml-5  ">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Deal Owner</label>
                                            <div class="col-sm-6 d-inline">

                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter your name"
                                                       value="{{$deal->user_name}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Email</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter address" name="address" id="search"
                                                       value="{{$deal->user_email}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Stage</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter address" name="address" id="search"
                                                       value="{{$deal->stage_title}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5 ">
                                            @php
                                                @endphp
                                            @if(($deal->stage_id == 2 or 3) and $deal->status_id == 2)
                                                <label for="name"
                                                       class="col-sm-1 col-form-label">Callback date</label>
                                                <div class="col-sm-6 " style="float: left">
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Enter city name" name="city"
                                                           id="tags"
                                                           value="{{$task_deadline[0]->deadline}}" disabled>
                                                </div>
                                            @else
                                                <label for="name"
                                                       class="col-sm-1 col-form-label">Last call date</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Enter city name" name="city"
                                                           id="tags"
                                                           value="{{$deal->updated_at}}" disabled>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Status</label>
                                            <div class="col-sm-2 ">
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
                                                    <div class="">
                                                        <div class="alert alert-success-yellow mb-0" role="alert">
                                                            <h6 class="mt-0 mb-0 ml-3">
                                                                Call later
                                                            </h6>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Reason of rejection</label>
                                            <div class="col-sm-6">
                                                @if($deal->status_id == 1 )
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Closed successfully" name="address" id="search"
                                                           value="" disabled>
                                                @elseif($deal->status_id == 2 )
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Not Closed" name="address" id="search"
                                                           value="" disabled>
                                                @else
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Enter address" name="address" id="search"
                                                           value="{{$deal->status}}" disabled>
                                                @endif
                                            </div>
                                        </div>
                                        @if($deal->employee_id == $user->id)
                                            @if(($deal->stage_id == 2) and $deal->status_id == 2)
                                                <button type="submit" class="btn btn-outline-warning d-inline ml-5"
                                                        style="width: 15%; float: none">
                                                    <a class="text-black" href={{ route('deal.edit', $deal->id)}} >
                                                        Callback
                                                        <ion-icon name="call-outline" class="ml-3 mt-0"></ion-icon>
                                                    </a>
                                                </button>
                                            @elseif(($deal->stage_id == 3) and $deal->status_id == 2)
                                                <button type="submit" class="btn btn-outline-warning d-inline ml-5"
                                                        style="width: 15%; float: none ">
                                                    <a class="text-black" href={{ route('deal.show', $deal->id)}} >
                                                        Callback
                                                        <ion-icon name="call-outline" class="ml-3 mt-0"></ion-icon>
                                                    </a>
                                                </button>
                                            @endif
                                        @endif
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

@section('content2')
    <section class="content w-80 ml-3 mr-2" style="">
        <div class="container-fluid">
            <div class="mt-1">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header" id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                    </div>
                                    <div class=" ml-2" style="width: 20%">
                                        <h5 class="ml-3">
                                            Deal Data:
                                        </h5>
                                    </div>
                                    <hr>
                                    <div class="mt-3 ml-5">
                                        <div class="form-group row mt-4 ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Lead Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter your name"
                                                       value="{{$deal->name}}" disabled>
                                            </div>
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Product list</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Empty" name="address" id="search"
                                                       value="{{$product_list}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4 ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Phone</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter your name"
                                                       value="+{{$deal->phone}}" disabled>
                                            </div>
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Amount</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter address" name="address" id="search"
                                                       value="{{$deal->amount}}.00 $" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4 ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Lead Email</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter your name"
                                                       value="{{$deal->email}}" disabled>
                                            </div>
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Close Date</label>
                                            <div class="col-sm-5">
                                                @if($deal->status_id == 1)
                                                    @php
                                                        $closing_data = explode(" ", $deal->closing_date);
                                                    @endphp
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Enter address" name="address" id="search"
                                                           value="{{$closing_data[0]}}" disabled>
                                                @else
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Deal is not closed" name="address" id="search"
                                                           value="" disabled>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4 ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Source</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter your name"
                                                       value="{{$deal->source}}" disabled>
                                            </div>
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Close Time</label>
                                            <div class="col-sm-4">
                                                @if($deal->status_id == 1)
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Enter address" name="address" id="search"
                                                           value="{{$closing_data[1]}}" disabled>
                                                @else
                                                    <input type="text" class="form-control" style="border: none;"
                                                           placeholder="Deal is not closed" name="address" id="search"
                                                           value="" disabled>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4 ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Lead City</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="City not selected"
                                                       value="{{$deal->city}}" disabled>
                                            </div>
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Stage</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter address" name="address" id="search"
                                                       value="{{$deal->stage_title}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4 ml-5">
                                            <label for="name"
                                                   class="col-sm-1 col-form-label"> Address</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Address not selected"
                                                       value="{{$deal->address}}" disabled>
                                            </div>
                                            <label for="name"
                                                   class="col-sm-1 col-form-label">Updated by</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="border: none;"
                                                       placeholder="Enter address" name="address" id="search"
                                                       value="{{$deal->user_name}}" disabled>
                                            </div>
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

@section('content3')
    <section class="content w-80 ml-3 mr-2" style="">
        <div class="container-fluid">
            <div class="mt-1">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header" id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                    </div>
                                    <div class=" ml-2" style="width: 20%">
                                        <h5 class="ml-3">
                                            Shopping cart:
                                        </h5>
                                    </div>
                                    @if($product_list == "")
                                        <hr>
                                        <input type="text" class="form-control ml-4" style="border: none;"
                                               placeholder="Empty" disabled>
                                    @else
                                        <table class="table m-0 ml-3 p-3">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <h5>Product Title</h5>
                                                </th>
                                                <th>
                                                    <h5>Company Name</h5>
                                                </th>
                                                <th>
                                                    <h5>Category</h5>
                                                </th>
                                                <th>
                                                    <h5>Identifier</h5>
                                                </th>
                                                <th>
                                                    <h5>Price</h5>
                                                </th>
                                                <th>
                                                    <h5>Quantity</h5>
                                                </th>
                                                <th>
                                                    <h5>Amount</h5>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                @php
                                                    @endphp
                                                <tr>
                                                    <td>
                                                        <h6 class="mt-3">{{$product->title}}</h6>
                                                    </td>
                                                    <td>
                                                        @foreach($companies as $company)
                                                            @if($product->company_id == $company->id)
                                                                <h6 class="mt-3">{{$company->name}}</h6>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($categories as $category)
                                                            @if($product->category_id == $category->id)
                                                                <h6 class="mt-3">{{$category->title}}</h6>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-3">{{"id: " . $product->identifier}}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-3">{{$product->price . ",00 $"}}</h6>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $product_count = "";
                                                            if(strlen($deal->products) > 0){
                                                                $arr = explode(" ",$deal->products);
                                                              foreach ($arr as $a){
                                                                $a = explode("*",$a);
                                                                if($product->id == $a[0]){
                                                                    $product_count = $a[1];
                                                                }
                                                            }
                                                            }
                                                        @endphp
                                                        <h6 class="mt-3" style="text-align: center;">{{$product_count}}
                                                            x</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-3">{{$product->price* $product_count. ",00 $"}}</h6>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5">
        </div>
        <div class="mb-5">
        </div>
        <div class="mb-5">
        </div>
    </section>
@endsection

