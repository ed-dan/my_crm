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
                                        <div class="bg-product-update p-3 ">
                                            <h5>
                                                Update Product:
                                            </h5>
                                            <div class="row">
                                                <div class="col">
                                                    <ul id="progress-bar" class="progressbar-yellow">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method="POST"
                                              action="{{route('product.update', $product->id)}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            
                                            <hr>
                                            <div class="form-group row ">
                                                <label for="title"
                                                       class="col-sm-3 col-form-label">Product Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="title" class="form-control"
                                                           placeholder="Enter company name"
                                                           value="{{$product->title}}">
                                                     @error('title')
                                                        <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Category name</label>
                                                <div class="col-sm-9">
                                                    <select name="category_id" class="select-width form-control">
                                                        <option name="category_id" value="{{$product->category->id}}">
                                                            {{$product->category->title}}
                                                        </option>
                                                        
                                                        @foreach($categories->except($product->category->id) as $category)
                                                            <option name="category_id" value="{{$category->id}}">
                                                                <h6>{{$category->title}}</h6>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                    @enderror
                                                
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Company</label>
                                                <div class="col-sm-9">
                                                    
                                                        <select name="company_id" class="select-width form-control">
                                                            <option name="company_id" value="{{$product->company->id}}">
                                                                {{$product->company->name}}
                                                            </option>

                                                            @foreach($companies->except($product->company->id) as $company)
                                                                <option name="company_id" value="{{$company->id}}">
                                                                    <h6>{{$company->name}}</h6>
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('company_id')
                                                            <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Product price</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="price" class="form-control"
                                                           placeholder="Enter company address"
                                                           value="{{$product->price}}">
                                                        @error('price')
                                                           <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="identifier"
                                                       class="col-sm-3 col-form-label">Product Identifier</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="identifier" class="form-control"
                                                           placeholder="Enter company website"
                                                           value="{{$product->identifier}}">
                                                        @error('identifier')
                                                           <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" id="" cols="30" rows="8">{{$product->description}}</textarea>
                                                 
                                                </div>
                                            </div>

                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="{{route('product.show', $product->id)}}" class="text-black"> Back </a>
                                                </button>

                                                <button type="submit"
                                                        class="button float-right text-black"
                                                        style="width: 120px;">
                                                        <a type="submit" class="text-black">
                                                             Confirm 
                                                        </a>                                                
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
