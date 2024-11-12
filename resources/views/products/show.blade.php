@extends('layouts.admin-lte')

@section('content')
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>


    <section class="content w-80    " style="float:right; width: 100%">
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header " id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                        <div class="bg-product-show p-3 ">
                                            <h5>
                                                About Product:
                                            </h5>
                                            <div class="row">
                                                <div class="col">
                                                    <ul id="progress-bar" class="progressbar-yellow">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method=""
                                              action=""
                                              enctype="multipart/form-data">
                                            

                                            <hr>
                                            <div class="form-group row ">
                                                <label for="title"
                                                       class="col-sm-3 col-form-label">Product Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="title" class="form-control"
                                                           placeholder="Enter company name"
                                                           value="{{$product->title}}" disabled>
                                                           
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Category name</label>
                                                <div class="col-sm-9">
                                                    <select disabled name="category_id" class="select-width form-control">
                                                        <option>{{$product->category->title}}</option>
                                                    
                                                    </select>
                                                        {{-- <input type="text" name="price" class="form-control"
                                                           placeholder="Enter company address"
                                                           value="{{$product->category->title}}" disabled> --}}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Company</label>
                                                <div class="col-sm-9 ">
                                                    <select disabled name="category_id" class="select-width form-control ">
                                                        <option>{{$product->company->name}}</option>
                                                    
                                                    </select>
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Product price</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="price" class="form-control"
                                                           placeholder="Enter company address"
                                                           value="{{$product->price}}.00 $" disabled>
                                                       
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Product Identifier</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="identifier" class="form-control"
                                                           placeholder="Enter company website"
                                                           value="id: {{$product->identifier}}" disabled>
                                                        
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" id="" cols="30" rows="8" disabled>{{$product->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="" class="text-black"> Back </a>
                                                </button>
                                                @if(auth()->user()->position_id == App\Models\User::ADMIN_ID)
                                                    <button
                                                        class="button float-right text-black"
                                                        style="width: 150px;">
                                                        <a href="{{route('product.edit', $product)}}" class="text-black">
                                                             Edit Product 
                                                        </a>                                                
                                                    </button>
                                                @endif
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
