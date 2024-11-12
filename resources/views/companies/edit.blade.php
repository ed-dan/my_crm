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
                                                Update Company:
                                            </h5>
                                            <div class="row">
                                                <div class="col">
                                                    <ul id="progress-bar" class="progressbar-yellow">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method="POST"
                                              action="{{route('company.update', $company->id)}}"
                                              enctype="multipart/form-data">
                                              @csrf
                                              @method('patch')

                                            <hr>
                                            <div class="form-group row ">
                                                <label for="title"
                                                       class="col-sm-3 col-form-label">Company Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name" class="form-control"
                                                           placeholder="Add company name"
                                                           value="{{$company->name}}" >
                                                        @error('name')
                                                           <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                        @enderror
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Company Phone</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="company_phone" class="form-control"
                                                           placeholder="Add company phone"
                                                           value="{{$company->company_phone}}" >
                                                        @error('company_phone')
                                                           <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-3 col-form-label ">Company Website</label>
                                                <div class="col-sm-9 ">
                                                    <input type="text" name="website" class="form-control"
                                                           placeholder="Add company website"
                                                           value="{{$company->website}}" >
                                                        @error('website')
                                                           <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Company Adddress</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="address" class="form-control"
                                                           placeholder="Add company address"
                                                           value="{{$company->address}}" >
                                                        @error('address')
                                                           <p class="col-form-label ml-2 mt-0">{{$message}}</p>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Product List</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="identifier" class="form-control"
                                                           placeholder="No products"
                                                           value="" disabled>
                                                        
                                                </div>
{{--                                                 
                                                    <button
                                                        class="button float-right text-black mt-0"
                                                        style="width: 110px; height: 40px">
                                                        <a href="" class="text-black">
                                                             Add 
                                                        </a>                                                
                                                    </button> --}}
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-3 col-form-label">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" id="" cols="30" rows="8" >{{$company->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="{{route('company.show', $company->id)}}" class="text-black"> Back </a>
                                                </button>
                                                @if(auth()->user()->position_id == App\Models\User::ADMIN_ID)
                                                    <button
                                                        class="button float-right text-black" type="submit"
                                                        style="width: 150px;">
                                                        <a class="text-black" type="submit">
                                                              Confirm 
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
