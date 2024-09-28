@extends('layouts.admin-lte')


@section('edit')


    <section class="content " style="float:left;" >
        <div class="p-5"></div>
        <h2>
            YOUR SCRIPT
        </h2>

    </section>


    </div>
@endsection
@section('content')

    <div class="app mt-3">

        <link rel="stylesheet" href="/css/app.css">
        <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css')}}"
              rel="stylesheet">
        <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}"></script>
        <link rel="stylesheet"
              href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>
        @include("partials._step-bar")

        <form class="form-horizontal" method="POST" action="/employees" enctype="multipart/form-data">
            @csrf
            <h3>
                Lead data:
            </h3>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name"
                           value="{{$lead->name}}">
                </div>

                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label"> Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email"
                           value=" {{$lead->email}}">
                </div>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label"> Number</label>
                <div class="col-sm-10">
                    <input id="autogap" maxlength="10" type="text" class="form-control" name="phone"
                           placeholder="Required format 000 00 00 000" value="{{$lead->phone}}">
                </div>
                @error('phone')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Source</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                           value="{{$lead->source}}">
                </div>
                @error('source')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Source</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                           value="Product name">
                </div>
                @error('source')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="card-footer p">
                <button class="btn btn-default">
                    <a href="/" class="text-black"> Back </a>
                </button>
                <button type="submit" class="btn btn-info float-right">Create</button>
            </div>


            <h3>
                Product data:
            </h3>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                           value="{{$lead->name}}">
                </div>
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label"> Contact Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email"
                           value="{{old('email')}}">
                </div>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-10">
                    <input id="autogap" maxlength="10" type="text" class="form-control" name="phone"
                           placeholder="Required format 000 00 00 000" value="{{old('phone')}}">
                </div>
                @error('phone')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Source</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                           value="{{old('name')}}">
                </div>
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


            <div class="form-group row">
                <label for="date_of_employment" class="col-sm-2 col-form-label">Date of employment</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="date_of_employment"
                           placeholder="Example: Remote, Boston MA, etc" value="{{old('date_of_employment')}}">
                </div>
                @error('date_of_employment')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="head" class="col-sm-2 col-form-label">Head</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="search" name="head"
                           placeholder="You need to choose Head" value="{{old('head')}}">
                </div>

                @error('head')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


            <div class="card-footer">
                <button class="btn btn-default">
                    <a href="/" class="text-black"> Back </a>
                </button>
                <button type="submit" class="btn btn-info float-right">Create</button>
            </div>
            <!-- /.card-footer -->
        </form>

    </div>

@endsection
<script>
    import HelloComponent from "@/components/HelloComponent";

    export default {
        components: {HelloComponent}
    }
</script>
