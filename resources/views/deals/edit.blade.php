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
        <div>
{{--            <h3>About Product</h3>--}}
            <div>

                {{$deal->lead->products[0]->description}}
                @php

                    //                $about_product = $product->description;
                    //                echo $about_product;

                @endphp
            </div>
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
                                        @include("partials._step-bar")
                                        <form class="form-horizontal" method="POST"
                                              action="{{ route('deal.update', $deal->id) }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')

                                            <h5 class="mt-3">
                                                Product data:
                                            </h5>
                                            <hr>
                                            <div class="form-group row mt-4">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter your name"
                                                           value="{{ $deal->lead->products[0]->title }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">Price</label>
                                                <div class="col-sm-10">
                                                    <div class="input-container">
                                                        <input type="text" class="form-control col-sm-10"
                                                               placeholder="Enter your name"
                                                               value="{{ $deal->lead->products[0]->price }} $" disabled>
                                                        <input class="form-control mr-0" id="count"
                                                               type="number" name="count{{$deal->lead->products->first()->id}}" value="1">
                                                    </div>
                                                </div>
                                            </div>
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
                                            <script>
                                                let count = 0;

                                                function updateCount() {
                                                    count = parseInt(document
                                                        .getElementById('count').value) || 0;
                                                }

                                                function increment() {
                                                    count++;
                                                    updateCount();
                                                    document.getElementById('count').value = count;
                                                }

                                                function decrement() {
                                                    if (count > 0) {
                                                        count--;
                                                        updateCount();
                                                        document.getElementById('count').value = count;
                                                    }
                                                }
                                            </script>
                

                                            <h5 class="mt-3">
                                                Logistic data:
                                            </h5>
                                            <hr>
                                            <div class="form-group row mt-4">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter city name" name="city"
                                                           id="tags"
                                                           value="{{$deal->city}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter address" name="address" id="search"
                                                           value="{{$deal->address}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class=""><h5>
                                                        Similar products:
                                                    </h5></label>
                                                <div class="" style="width: 700px">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            
                                                        @foreach($products as $prod)
                                                    
                                                            <tr>
                                                                @if($deal->lead->products->first()->id == $prod->id)
                                                                @else
                                                                    <td>
                                                                        <label class="form-check-label"
                                                                               for="flexCheckDefault">

                                                                            <h6 class="mt-2"> {{$prod->title}} <br></h6>
                                                                        </label>
                                                                    </td>
                                                                    <td style="width: 100px">
                                                                        <input class="form-control" id="count"
                                                                               type="number"
                                                                               name="count{{$prod->id}}" value="0">
                                                                    </td>
                                                                    <td>
                                                                        <h6 class="mt-2">{{$prod->price}} $ <br></h6>
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-check-input mt-2"
                                                                               type="checkbox"
                                                                               value="{{$prod->id}}"
                                                                               name="id{{$prod->id}}">
                                                                    </td>
                                                                @endif
                                                            </tr> 
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="{{ url()->previous() }}" class="text-black"> Back </a>
                                                </button>
                                                <button class="btn btn-default ml-5" style="width: 120px;">
                                                    <a href="{{route("task.create", $deal->id)}}" class="text-black">
                                                        Create Task </a>
                                                </button>
                                                <button type="submit" class="btn btn-info float-right">Next
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

    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        var path = "{{ route('autocomplete') }}";
        $("#search").autocomplete({
            classes: {},
            source: function (request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#search').val(ui.item.label);
                console.log(ui.item);
                return false;
            }
        });
        // $("#street").autocomplete({
        //     classes: {},
        //     source: function (request, response) {
        //         $.ajax({
        //             url: path2,
        //             type: 'GET',
        //             dataType: "json",
        //             data: {
        //                 search: request.term
        //             },
        //             success: function (data) {
        //                 response(data);
        //             }
        //         });
        //     },
        //     select: function (event, ui) {
        //         $('#street').val(ui.item.label);
        //         console.log(ui.item);
        //         return false;
        //     }
        // });

    </script>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script>
        $(function () {
            var availableTags = [
                "Kyiv",
                "Kharkiv",
                "Odesa",
                "Dnipro",
                "Lviv",
                "Zaporizhzhia",
                "Donetsk",
                "Zaporizhzhia",
                "Kryvyi Rih",
                "Mykolaiv",
                "Sevastopol",
                "Mariupol",
                "Luhansk",
                "Vinnytsia",
                "Makiivka",
                "Simferopol",
                "Chernihiv",
                "Kherson",
                "Poltava",
                "Khmelnytskyi",
                "Cherkasy",
                "Ivano-Frankivsk"
            ];
            $("#tags").autocomplete({
                source: availableTags
            });
        });
    </script>
@endsection
