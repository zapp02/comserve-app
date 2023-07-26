@extends('layout.app')

@section('title', 'Activity Report')

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Report
        </h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <form >
                    <div class="form-group">
                        <label for="">From</label>
                        <input type="date" name="from" id="from" class="form-control" value="{{ request()->input('from') }}">
                    </div>
                    <div class="form-group">
                        <label for="">To</label>
                        <input type="date" name="to" id="to" class="form-control" value="{{ request()->input('to') }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @if (request()->input('from'))
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Activity Name</th>
                        <th>Obtained</th>
                        <th>Request Quantity</th>
                        <th>Total Quantity</th>
                        <th>Points Given</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        @endif
    </div>
</div>
    
@endsection

@push('js')
<script>

    const from = '{{ request()->input('from') }}'
    const to = '{{ request()->input('to') }}'

    $(function(){
        const token = localStorage.getItem('token')
        $.ajax({
            url : `/api/reports?from=${from}&to=${to}`,
            headers: {
                "Authorization": "Bearer" + token
            },
            success : function ({data}) {
                    
                let row;
                data.map(function (val,index) {
                    row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.product_name}</td>
                            <td>${val.obtained}</td>
                            <td>${val.request_qty}</td>
                            <td>${val.total_qty}</td>
                            <td>${val.pts_given}</td>
                        </tr>
                        `;
                }); 
                $('tbody').append(row)
            }
        });
    });
</script>
@endpush
