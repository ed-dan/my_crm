<section class="content Scroll mr-4">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="mt-5 ml-2">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mt-5">
                        <div class="card-header" id="">
                            <h3 class="ml-2">Welcome: {{ Auth::user()->name, }}</h3>
                            <hr>
                            <h5 class="ml-2">Email: {{ auth()->user()->email, }}</h5>
                            <h5 class="ml-2">Position: {{ auth()->user()->position->title }}</h5>
                            <div id="container" class="Scroll" style="overflow-y: scroll">
                                <div style="margin: 5px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mt-5">
                        <div class="card-header" id="">

                            <div id="container">
                                <div style="margin: 5px">
                                    {{-- @yield('content3') --}}

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" style="float: right">
                    <div class="card mt-5">
                        <div class="card-header" id="">

                            <div id="container" class="reverseScroll" style="overflow-y: scroll">
                                <div style="margin: 5px">
                                    {{-- @yield('content4') --}}

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
