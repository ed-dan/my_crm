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

    <div style=" width: 600px">
        <table class="table m-0">
            <thead>
            <tr>
                <th>
                    <h5>Name</h5>
                </th>
                <th>
                    <h5>Email</h5>
                </th>
                <th style="width: 130px">
                    <h5>Calls Count</h5>
                </th>
                <th style="width: 140px">
                    <h5>Deals  Count</h5>
                </th>

                <th>
                    <h5>Action</h5>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>
                        <h6>{{ $employee->name }}</h6>
                    </td>
                    <td>

                        @foreach($positions as $position)
                            @if($position->id === $employee->position_id)
                                <h6>{{ $position->title }}</h6>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @php
                            $employee_lead = DB::table("employee_leads")->where("employee_id", "=", $employee->id);

                        @endphp

                            <h6>
                                {{count($employee_lead->get())}} calls
                            </h6>
                    </td>
                    <td>
                        @php
                            $deal_employee = DB::table("deal_employees")->where("employee_id", "=", $employee->id);
                        @endphp
                        <h6>
                           {{count($deal_employee->get())}} deals
                        </h6>
                    </td>

                    <td>
                        <div class="md:inline" data-color="#00a65a"
                             data-height="20">
                            <div class="btn-group">
                                <form action="">
                                    <button type="button" class="btn btn-block btn-outline-info ">
                                        <a class="text-black" href="deals?&employee={{$employee->id}}" >
                                            <ion-icon name="arrow-forward-outline"></ion-icon>
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
@endsection



@section('content2')

    <div style=" width: 600px">
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
                    <h5>Manager</h5>
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
                            @foreach($employees as $employee)
                                @if($employee->id === $task->employee_id)
                                    <h6>{{ $employee->name }}</h6>
                                @endif
                            @endforeach
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
                                                <a class="text-black" href={{ route('deal.about', $task->deal->id)}} >
                                                    <ion-icon name="search-outline"></ion-icon>
                                                </a>
                                            @elseif($task->deal->stage_id == 3)
                                                <a class="text-black" href={{ route('deal.about', $task->deal->id)}} >
                                                    <ion-icon name="search-outline"></ion-icon>
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
@endsection


<script>
    import Index from "@/Pages/Lead";

    export default {
        components: {Index}
    }
</script>
