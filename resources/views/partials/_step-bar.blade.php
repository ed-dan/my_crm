
<div class="card-footer ">
    <div class="row">
        <div class="col">
            <ul id="progress-bar" class="progressbar">
                @foreach($stages as $stage)
                    @if($stage->id <= $deal->stage_id)
                        <li class="active">{{$stage->title}}</li>
                    @else
                        <li>{{$stage->title}}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>


{{--<div class="btn-container">--}}
{{--    <button class="btn" id="Next">Next</button>--}}
{{--    <button class="btn" id="Back">Back</button>--}}
{{--    <button class="btn" id="Reset">Reset</button>--}}
{{--</div>--}}

