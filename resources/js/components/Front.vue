<template>
    <div>
        <h1>
            123123
        </h1>
    </div>
    <!-- @foreach($companies as $company)
                        <div class="col-md-4">
                            <div class="card mt-0">
                                <div class="card-header" id="">
                                    <div class="bg-company-logo p-3">
                                        <div class="d-inline-block mt-2">
                                            <h5>
                                                {{ $company->name }}
                                            </h5>
                                        </div>
                                        <div style="float: right;">
                                            <div class="d-inline-block mr-1 " style="float: right;">
                                                <button type="button" class="btn btn-block btn-outline-light ">
                                                    <a class="text-black" href={{ route("company.show", $company->id)}} >
                                                        <ion-icon name="search-outline"></ion-icon>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Company address:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                {{ $company->address }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Company phone:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                {{ $company->company_phone }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Company website:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                {{ $company->website }}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="d-inline-block mt-3 ml-1">
                                            <h6>
                                                Product List:
                                            </h6>
                                        </div>
                                        <div class="d-inline-block mt-3 mr-2" style="float: right;">
                                            <div style="">
                                                {{-- @foreach($products as $product)
                                                    @if($product->company_id == $company->id)
                                                        <h6>{{ $product->title }}</h6>
                                                    @endif
                                                @endforeach --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <link rel="stylesheet" href="/css/app.css">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach -->
</template>
