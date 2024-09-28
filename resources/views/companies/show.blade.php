@extends('layouts.admin-lte')

@section('content')
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>


    <section class="content w-80 mt-5" style="float:left; width: 750px">
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
                                        <div class="card-footer ">
                                            <div class="row">
                                                <div class="col">


                                                </div>
                                            </div>
                                        </div>

                                        <form class="form-horizontal" method="POST"
                                              action=""
                                              enctype="multipart/form-data">
                                            @csrf

                                            <h5 class="mt-3">
                                                About company :
                                            </h5>
                                            <hr>
                                            <div class="form-group row mt-4">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control"
                                                           placeholder="Enter your name"
                                                           value=" Callback">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="priority"
                                                       class="col-sm-2 col-form-label ">Status</label>
                                                <div class="col-sm-10">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">DateTime</label>
                                                <div class="col-sm-10">
                                                    <div class="input-container">
                                                        <input type="date" name="date" class="form-control"
                                                               placeholder="Enter your name"
                                                               value="">
                                                        <input type="time" name="time" class="form-control mr-0"
                                                               placeholder=""
                                                               value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row  ">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">Note</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="subject" id="" cols="30" rows="8"></textarea>
                                                </div>
                                            </div>

                                            <div class="card-footer p">
                                                <button class="btn btn-default">
                                                    <a href="/" class="text-black"> Back </a>
                                                </button>

                                                <button type="submit"
                                                        class="btn btn-warning float-right text-black"
                                                        style="width: 120px;">
                                                    Create Task
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
