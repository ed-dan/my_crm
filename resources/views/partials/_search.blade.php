<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="form-inline">
                <div class="mt-3 ml-5 mb-3">
                    <form class="row g-3 " action="/deals">
                        <div class="col-auto col-auto mt-3 ">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <select name="status" class="select-width form-control ">
                                <option></option>
                                <option name="status" value="city">By City</option>
                                <option name="status" value="name">By Name</option>
                                <option name="status" value="title">By Stage</option>
                                <option name="status" value="5">By Owner</option>
                            </select>
                            <button type="submit" class="btn btn-primary mr-2">Search</button>
                            Sort by:
                            <select name="sort" class="select-width form-control ml-1 mr-3">
                                <option></option>
                                <option name="sort" value="amount">By Amount</option>
                                <option name="sort" value="closing_date">By Date</option>
                            </select>
                            Direction:
                            <select name="direction" class="select-width form-control ml-1">
                                <option></option>
                                <option name="direction" value="desc">Descending</option>
                                <option name="direction" value="asc">Ascending</option>
                            </select>
                            <button type="submit" class="btn btn-secondary ">Sort</button>
                            @if(($position == "Admin") or $position == "Analytical expert")
                                Choose Manger:
                                <select name="employee" class="select-width form-control ml-1">
                                    <option></option>
                                    @foreach($employees as $employee)
                                        <option name="employee" value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                                <button style="width: 80px" type="submit" class="btn btn-secondary mr-5">Choose</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
