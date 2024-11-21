@extends('layouts.admin-lte')

@section('content')

@include('partials.home-pages._up-statistic-data')

@endsection


{{-- 
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
@endsection --}}

@section('content1')

<section class="content " id="left">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="ml-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header" id="">
                                <h3 class="ml-3">
                                 Statistic:
                                </h3>

                                <div id="container" class="reverseScroll" style="overflow-y: scroll">
                                    <div style="margin: 5px" id="left">
                                        
                                        <div class="homePageTable">
                                            <div>
                                                
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
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          {{-- @endif --}}
                            </div>
                      <!-- /.row -->
                         </div>
                  <!-- /.card-footer -->
                    </div>
              <!-- /.card -->
                </div>
             </div>
          <!-- /.col -->
    </div>
</section>

@endsection


@section('content3')

<section class="content " id="right">
    <div class="container-fluid ">
        <!-- Info boxes -->
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                        
                                <h2 class="ml-3">
                                    Today's Callbacks:
                                </h2>
                                   <div id="container" class="reverseScroll" style="overflow-y: scroll">
                                    <div style="margin: 5px" id="right">
                                        <div class="homePageTable">
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
                                    
                                    </div>
                                </div>
                           

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.col -->
    </div>
</section>

@endsection


<script>
    import Index from "@/Pages/Lead";

    export default {
        components: {Index}
    }
</script>
