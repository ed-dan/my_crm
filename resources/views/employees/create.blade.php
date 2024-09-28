@extends("layouts.admin-lte")
@section("content")
<div>

    {{--                <link rel="stylesheet" href="/css/app.css">--}}
    {{--        <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css')}}"--}}
    {{--              rel="stylesheet">--}}

    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>

    <form class="form-horizontal" method="POST" action="/employees" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Employee photo</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="photo"/>
                </div>
                @error('photo')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " name="name" id="search" placeholder="Enter your name"
                           value="{{old('name')}}">
                </div>

                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
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
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $("#search").autocomplete({
        classes:{

        },
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
</script>
@endsection


