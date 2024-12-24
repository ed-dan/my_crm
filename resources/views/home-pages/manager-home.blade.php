@extends('layouts.admin-lte')

@section('content')
@include('partials.home-pages._up-statistic-data')
@endsection

@section('content2')

<section class="content " id="left">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="ml-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header" id="">
                                <h3 class="ml-3">
                                    Manager Statistic:
                                </h3>
                                <div id="container" class="reverseScroll" style="overflow-y: scroll">
                                    <div style="margin: 5px" id="left">
                                        
                                        <div class="homePageTable">
        
                                            <table class="table m-0">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <h5>Name</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Phone</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Source</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Action</h5>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($leads as $lead)
                                                    <tr>
                                                        <td>
                                                            <h6>{{ $lead->name }}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>+{{ $lead->phone }}</h6>
                                                        </td>
                                    
                                                        <td>
                                                            <h6>{{ $lead->source }}</h6>
                                                        </td>
                                                        <td>
                                                            <div class="md:inline" data-color="#00a65a"
                                                                 data-height="20">
                                                                <div class="btn-group">
                                                                    <form action="">
                                                                        <button type="button" class="btn btn-block btn-outline-success ">
                                                                            <a class="text-black" href={{ route('lead.edit', $lead->id)}} >
                                                                                <ion-icon name="call-outline"></ion-icon>
                                                                            </a>
                                                                        </button>
                                                                    </form>
                                                                    <link rel="stylesheet" href="/css/app.css">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
                        <div class="card-header ">
                        
                                <h2 class="ml-3 ">
                                    Today's Callbacks:
                                </h2>
                                   <div id="container" class="reverseScroll" style="overflow-y: scroll">
                                    <div style="margin: 5px" id="right">
                                        <div class="homePageTable">
                                            <table class="table m-0">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <h5> Callback Title</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Deadline</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Priority</h5>
                                                    </th>
                                    
                                                    <th>
                                                        <h5>Stage</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Action</h5>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tasks as $task)
                                                    @if($task->stage_id != 4)
                                                        <tr>
                                                            <td>
                                                                <h6>{{ $task->title }}</h6>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $task->deadline = explode(" ", (string)$task->deadline);
                                                                @endphp
                                                                <h6>{{ $task->deadline[1] }}</h6>
                                                            </td>
                                                            <td>
                                                                <h6>{{ $task->priority }}</h6>
                                                            </td>
                                                            <td>
                                                                @foreach($stages as $stage)
                                                                    @if($stage->id === $task->deal->stage_id)
                                                                        <h6>{{ $stage->title }}</h6>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <div class="md:inline" data-color="#00a65a"
                                                                     data-height="20">
                                                                    <div class="btn-group">
                                                                        <form action="">
                                                                            <button type="button" class="btn btn-block btn-outline-warning ">
                                                                                @if($task->deal->stage_id == 2)
                                                                                    <a class="text-black" href={{ route('deal.about', $task->deal_id)}} >
                                                                                        <ion-icon name="arrow-forward-outline"></ion-icon>
                                                                                    </a>
                                                                                @elseif($task->deal->stage_id == 3)
                                                                                    <a class="text-black" href={{ route('deal.about', $task->deal_id)}} >
                                                                                        <ion-icon name="arrow-forward-outline"></ion-icon>
                                                                                    </a>
                                                                                @endif
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                      </div>
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
