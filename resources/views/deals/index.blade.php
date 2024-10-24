@extends('layouts.admin-lte')

@section('content')
    <section class="content w-80 mt-5" style="">


        <div class="container-fluid">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12 mt-5">
                        @include('partials._search')
                        <div class="card">
                            <div class="card-header" id="app">
                                @guest
                                @else
                                    <div class="app mt-3">
                                        <link rel="stylesheet" href="/css/app.css">
                                        <table class="table m-0">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <h5>Client Name</h5>
                                                </th>
                                                <th>
                                                    <h5>Client Phone</h5>
                                                </th>
                                                <th>
                                                    <h5>Product list</h5>
                                                </th>
                                                <th>
                                                    <h5>Amount</h5>
                                                </th>
                                                <th>
                                                    <h5>Stage</h5>
                                                </th>
                                                <th>
                                                    <h5>City</h5>
                                                </th>

                                                <th>
                                                    <h5>Closing Date</h5>
                                                </th>
                                                <th>
                                                    <h5>Deal Owner</h5>
                                                </th>
                                                <th class="mr-5">
                                                    <h5 class="mr-5">Status</h5>
                                                </th>
                                                <th>
                                                    <h5>Action</h5>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                        
                                            @foreach($deals as $deal)
                                                @can("viewAny", App\Models\Deal::class)  
                                                    @include('partials._deal-list')
                                                @elsecan("viewOnly", $deal)
                                                    @include('partials._deal-list')
                                                @endcan
                                            @endforeach
                                       
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3 float-right">
                                        {{ $deals->links() }}
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
