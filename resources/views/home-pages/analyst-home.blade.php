@extends('layouts.admin-lte2')

@section('content3')

    <div style="height: 120px">
        <div>
            <h3> Today's Statistic </h3>
            <hr>
            <div class="d-inline-block">
                <h5> Number of calls: </h5>
            </div>
            <div class="d-inline-block mr-5" style="float: right;">
                <h5> {{$today_calls . "  calls"}}  </h5>
            </div>
        </div>
        <div>
            <div class="d-inline-block">
                <h5> Successful deals: </h5>
            </div>
            <div class="d-inline-block mr-5" style="float: right;">
                <h5> {{$confirmed_deals . "  deals"}}  </h5>
            </div>
        </div>
    </div>
@endsection


@section('content4')

    <div style="height: 126px">
        <div><h3> Today's Calls </h3>
            <table class="table m-0">

                <tbody>
                @foreach($today_history as $tod)
                    <tr>
                        <td>
                            <h6> {{$tod->name}}</h6>
                        </td>
                        <td>
                            <h6>+{{ $tod->phone }}</h6>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('content')
    <div>
        <style>
            @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

            @keyframes bake-pie {
                from {
                    transform: rotate(0deg) translate3d(0, 0, 0);
                }
            }

            body {
                font-family: "Open Sans", Arial;
                background: #EEE;
            }

            main {
                width: 500px;
                margin: 30px auto;
            }

            section {
                margin-top: 30px;
            }

            .pieID {
                display: inline-block;
                vertical-align: top;
            }

            /*to remove stat change width*/
            .pie {
                height: 200px;
                width: 200px;
                position: relative;
                margin: 0 30px 30px 0;
            }

            .pie::before {
                content: "";
                display: block;
                position: absolute;
                z-index: 1;
                width: 100px;
                height: 100px;
                background: #343a40;
                border-radius: 50%;
                top: 50px;
                left: 50px;
            }

            .pie::after {
                content: "";
                display: block;
                width: 120px;
                height: 2px;
                background: rgba(0, 0, 0, 0.1);
                border-radius: 50%;
                box-shadow: 0 0 3px 4px rgba(0, 0, 0, 0.1);
                margin: 220px auto;

            }

            .slice {
                position: absolute;
                width: 200px;
                height: 200px;
                clip: rect(0px, 200px, 200px, 100px);
                animation: bake-pie 1s;
            }

            .slice span {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                background-color: black;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                clip: rect(0px, 200px, 200px, 100px);
            }

            .legend {
                list-style-type: none;
                padding: 0;
                margin: 0;
                background: #343a40;
                padding: 15px;
                font-size: 13px;
                box-shadow: 1px 1px 0 #343a40,
                2px 2px 0 #343a40;
            }

            .legend li {
                width: 110px;
                height: 1.25em;
                margin-bottom: 0.7em;
                padding-left: 0.5em;
                border-left: 1.25em solid black;
            }

            .legend em {
                font-style: normal;
            }

            .legend span {
                float: right;
            }

            footer {
                position: fixed;
                bottom: 0;
                right: 0;
                font-size: 13px;
                background: #9f9e9e;
                padding: 5px 10px;
                margin: 5px;
            }

        </style>
        <main>
            <section>
                <div class="pieID pie " style="float: left; width: 200px">
                </div>
                <ul class="pieID legend mt-5 mt-5">
                    <div class="mt-5">
                        <div class="mt-5">
                            @if(array_sum($deal_statistic) == 0)
                                <li style="width: 210px; " class="">
                                    <h5 class="mt-3">
                                        <em>No Information</em>
                                        <span>1 </span>
                                    </h5>
                                </li>
                            @else
                                @foreach($deal_statistic as $key => $value)
                                    <li style="width: 220px; " class="">
                                            <em>{{$key}}</em>
                                            <span>{{$value}}</span>
                                    </li>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </ul>
            </section>
        </main>
        <script>
            function sliceSize(dataNum, dataTotal) {
                return (dataNum / dataTotal) * 360;
            }

            function addSlice(sliceSize, pieElement, offset, sliceID, color) {
                $(pieElement).append("<div class='slice " + sliceID + "'><span></span></div>");
                var offset = offset - 1;
                var sizeRotation = -179 + sliceSize;
                $("." + sliceID).css({
                    "transform": "rotate(" + offset + "deg) translate3d(0,0,0)"
                });
                $("." + sliceID + " span").css({
                    "transform": "rotate(" + sizeRotation + "deg) translate3d(0,0,0)",
                    "background-color": color
                });
            }

            function iterateSlices(sliceSize, pieElement, offset, dataCount, sliceCount, color) {
                var sliceID = "s" + dataCount + "-" + sliceCount;
                var maxSize = 179;
                if (sliceSize <= maxSize) {
                    addSlice(sliceSize, pieElement, offset, sliceID, color);
                } else {
                    addSlice(maxSize, pieElement, offset, sliceID, color);
                    iterateSlices(sliceSize - maxSize, pieElement, offset + maxSize, dataCount, sliceCount + 1, color);
                }
            }

            function createPie(dataElement, pieElement) {
                var listData = [];
                $(dataElement + " span").each(function () {
                    listData.push(Number($(this).html()));
                });
                var listTotal = 0;
                for (var i = 0; i < listData.length; i++) {
                    listTotal += listData[i];
                }
                var offset = 0;
                var color = [
                    "olivedrab","orange","tomato",
                    "cornflowerblue","crimson","purple",
                    "turquoise","forestgreen","navy",
                ];
                for (var i = 0; i < listData.length; i++) {
                    var size = sliceSize(listData[i], listTotal);
                    iterateSlices(size, pieElement, offset, i, 0, color[i]);
                    $(dataElement + " li:nth-child(" + (i + 1) + ")").css("border-color", color[i]);
                    offset += size;
                }
            }

            createPie(".pieID.legend", ".pieID.pie");

        </script>
    </div>
@endsection


@section('content2')
    <div style=" width: 600px">
        <form class="row " action="/">
            <div>
                <div>
                    <hr>
                    <div class="d-inline-block">
                        <h6> Count Capacity: </h6>
                        <select name="period" class="select-width form-control " style="width: 150px">
                            <option name="period" value="0"></option>
                            <option name="period" value="d{{date("d")}}">Per Day</option>
                            <option name="period" value="m{{date("m")}}">Per Month</option>
                            <option name="period" value="Y{{date("Y")}}">Per Year</option>
                        </select>
                    </div>
                    <div class="d-inline-block mt-1" style="float: right;">
                        <button type="submit" class="btn btn-primary mt-4">Count</button>
                    </div>

                    <div class="d-inline-block mr-2 " style="float: right;width: 100px">
                        <h6> Capacity: </h6>
                        <input type="text" class="form-control" value="{{ $capacity }}%" placeholder="capacity" disabled>
                    </div>
                    <div class="d-inline-block ml-2">
                        <h6> Choose Manager: </h6>
                        <select name="manager" class="select-width form-control " style="width: 150px">
                            <option value="0"></option>
                            @foreach($users as $user)
                                <option name="manager" value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                </div>
            </div>
        </form>
        {{--                    //////////////////////////////////////--}}
        <form class="row mt-2" action="/">
            <div>
                <div>
                    <div class="d-inline-block">
                        <h6> Count Profit: </h6>
                        <select name="period2" class="select-width form-control " style="width: 150px">
                            <option value="0"></option>
                            <option name="period2" value="d{{date("d")}}">Per Day</option>
                            <option name="period2" value="m{{date("m")}}">Per Month</option>
                            <option name="period2" value="Y{{date("Y")}}">Per Year</option>
                        </select>
                    </div>
                    <div class="d-inline-block mt-1" style="float: right;">
                        <button type="submit" class="btn btn-primary mt-4">Count</button>
                    </div>
                    <div class="d-inline-block mr-2" style="float: right;width: 100px">
                        <h6> Profit: </h6>
                        <input type="text" class="form-control " value="{{$profit}} $" placeholder="profit" disabled>
                    </div>
                    <div class="d-inline-block ml-2">
                        <h6> Choose Manager: </h6>
                        <select name="manager2" class="select-width form-control " style="width: 150px">
                            <option value="0"></option>
                            @foreach($users as $user)
                                <option name="manager" value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                </div>
            </div>
        </form>
        {{--                    ///////////////////////////////////////--}}
        {{--        <form class="row " action="/">--}}
        {{--            <div>--}}
        {{--                <div>--}}
        {{--                    <div class="d-inline-block">--}}
        {{--                        <h6> Count Profit: </h6>--}}
        {{--                        <select name="status" class="select-width form-control " style="width: 150px">--}}
        {{--                            <option></option>--}}
        {{--                            <option name="status" value="city">Per Day</option>--}}
        {{--                            <option name="status" value="name">Per Week</option>--}}
        {{--                            <option name="status" value="title">Per Month</option>--}}
        {{--                        </select>--}}
        {{--                    </div>--}}
        {{--                    <div class="d-inline-block mt-1" style="float: right;">--}}
        {{--                        <button type="submit" class="btn btn-primary mt-4">Count</button>--}}
        {{--                    </div>--}}
        {{--                    <div class="d-inline-block mr-2 MT-1" style="float: right;width: 100px">--}}
        {{--                        <input type="text" class="form-control mt-4 " value="" placeholder="profit" disabled>--}}
        {{--                    </div>--}}
        {{--                    <div class="d-inline-block ml-2">--}}
        {{--                        <h6> Choose Manager: </h6>--}}
        {{--                        <select name="status" class="select-width form-control " style="width: 150px">--}}
        {{--                            <option></option>--}}
        {{--                            <option name="status" value="city">Per Day</option>--}}
        {{--                            <option name="status" value="name">Per Week</option>--}}
        {{--                            <option name="status" value="title">Per Month</option>--}}
        {{--                        </select>--}}
        {{--                    </div>--}}
        {{--                    <hr>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </form>--}}
    </div>

@endsection


<script>
    import Index from "@/Pages/Lead";

    export default {
        components: {Index}
    }
</script>
