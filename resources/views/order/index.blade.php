@extends('layout.app')

@section('title', 'Order Data')

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            List of request
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
                        <th>Action</th>
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
                url : '/api/order/requested',
                headers: {
                    "Authorization": "Bearer" + token
                },
                success : function ({data}) {
                    

                    let row;
                    data.map(function (val,index) {
                       row += `
                       <tr>
                            <td>${index+1}</td>
                            <td>${date(val.created_at)}</td>
                            <td>${val.invoice}</td>
                            <td>${val.member.member_name}</td>
                            <td>${val.order_total}</td>
                            <td>
                                <a href ="#" data-id="${val.id}" class="btn btn-success btn-action">Approve</a>
                            </td>

                        </tr>
                       `;
                    });
                    
                    $('tbody').append(row)
                }
            });
            
            $(document).on('click','.btn-action',function () {
                const id = $(this).data ('id')

                $.ajax({
                    url : '/api/order/status_change/' + id,
                    type : 'POST',
                    data : {
                        status : 'Approved'
                    },
                    headers: {
                        "Authorization": "Bearer" + token
                    },
                    success : function(data){
                        location.reload();
                    }

                })
            });

        });
    </script>
@endpush

