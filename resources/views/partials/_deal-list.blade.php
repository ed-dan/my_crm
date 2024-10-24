<tr>
    <td>
        <h6 class="mt-3">{{$deal->lead->name}}</h6>
    </td>
    <td>
        <h6 class="mt-3">+{{$deal->lead->phone}}</h6>
    </td>
    <td>

        @if($deal->products)
        <h6 class="mb-0 mt-3">{{ $deal->products[0]->title ?? "Empty" }}</h6>
        @else
        @endif
    
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
