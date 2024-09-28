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
                                        <div class="bg-company-logo p-3 ">
                                            <h5>
                                                Add new Product:
                                            </h5>
                                            <div class="row">
                                                <div class="col">
                                                    <ul id="progress-bar" class="progressbar-yellow">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method="POST"
                                              action="{{route('product.store')}}"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <hr>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Product Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name" class="form-control"
                                                           placeholder="Enter company name"
                                                           value="{{old("name")}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Category</label>
                                                <div class="col-sm-9">
                                                    <select name="category_id" class="select-width form-control">
                                                        <option></option>
                                                        @foreach($categories as $category)
                                                            <option name="category_id" value="{{$category->id}}">
                                                                <h6>{{$category->title}}</h6>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Company</label>
                                                <div class="col-sm-9">
                                                    <select name="company_id" class="select-width form-control">
                                                        <option></option>
                                                        @foreach($companies as $company)
                                                            <option name="company_id" value="{{$company->id}}">
                                                                <h6>{{$company->name}}</h6>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Product price</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="address" class="form-control"
                                                           placeholder="Enter company address"
                                                           value="{{old("address")}}">
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Identifier</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="website" class="form-control"
                                                           placeholder="Enter company website"
                                                           value="{{old("website")}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" id="" cols="30" rows="8"></textarea>
                                                </div>
                                            </div>



                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="/" class="text-black"> Back </a>
                                                </button>

                                                <button type="submit"
                                                        class="button float-right text-black"
                                                        style="width: 150px;">
                                                    Add Product
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
