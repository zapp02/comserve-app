@extends('layout.app')

@section('title', 'Done Data')

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            List of request that has been done
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Request Date</th>
                        <th>ID Activity</th>
                        <th>Member</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection

@push('js')
    <script>
        $(function(){
            
            function date(date) {
                var date = new Date(date);
                var day = date.getDate(); //Date of the month: 2 in our example
                var months = ["January", "February", "March", "April", "May", "June", "July",
         "August", "September", "October", "November", "December"];
                var month = months[date.getMonth()]; //Month of the Year: 0-based index, so 1 in our example
                var year = date.getFullYear();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();

                return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
            }

            const token = localStorage.getItem('token')
            $.ajax({
                url : '/api/order/done',
                headers: {
                    "Authorization": "Bearer" + token
                },
                success : function ({data}) {
                    

                    let row;
                    data.map(function (val,index) {
                       row += `
                       <tr>
                            <td>${index+1}</td>
                            <td>${date(val.updated_at)}</td>
                            <td>${val.invoice}</td>
                            <td>${val.member.member_name}</td>
                            <td>${val.order_total}</td>
                        </tr>
                       `;
                    });
                    
                    $('tbody').append(row)
                }
            });

        });
    </script>
@endpush

