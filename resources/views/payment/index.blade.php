@extends('layout.app')

@section('title', 'Payment Data')

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            List of payments
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Payment Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <form class="form-payment">
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="text" class="form-control" name="date" placeholder="Date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="ACCEPTED">ACCEPTED</option>
                            <option value="REJECTED">REJECTED</option>
                            <option value="AWAITING">AWAITING</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    
@endsection

@push('js')
    <script>
        $(function(){

            $.ajax({
                url : '/api/payments',
                success : function ({data}) {

                    let row;
                    data.map(function (val,index) {
                        pdate = new Date(val.created_at)
                        var months = ["January", "February", "March", "April", "May", "June", "July",
         "August", "September", "October", "November", "December"];
                        full_pdate = `${ pdate.getDate() }-${ months[pdate.getMonth()] }-${ pdate.getFullYear() }`

                       row += `
                       <tr>
                            <td>${index+1}</td>
                            <td>${full_pdate}</td>
                            <td>${val.id_order}</td>
                            <td>${val.status}</td>
                            <td>
                                <a data-toggle="modal" href="@modal-form" data-id="${val.id}" class="btn btn-warning modal-edit">Edit</a>
                            </td>

                        </tr>
                       `;
                    });
                    
                    $('tbody').append(row)
                }
            });
            

            $(document).on('click', '.btn-delete',function(){
                const id = $(this).data('id')
                const token = localStorage.getItem('token')

                confirm_dialog = confirm ('Are you sure?');

                if(confirm_dialog){
                    $.ajax({
                        url : '/api/payments/' + id,
                        type : "DELETE",
                        headers: {
                            "Authorization": "Bearer" + token
                        },
                        success : function(data){
                            if (data.message == 'success'){
                                alert('Data Deleted')
                                location.reload()
                            }
                        }
                    });
                }

            });

            function date(date) {
                var date = new Date(date);
                var day = date.getDate(); //Date of the month
                var months = ["January", "February", "March", "April", "May", "June", "July",
         "August", "September", "October", "November", "December"];
                var month = months[date.getMonth()]; //Month of the Year: 0-based index
                var year = date.getFullYear();

                return `${day}-${month}-${year}`;
            }

            $(document).on('click','.modal-edit', function(){
                $('#modal-form').modal('show')
                const id = $(this).data ('id');

                $.get('/api/payments/' + id,function({data}){
                    $('input[name= "date"]').val(date(data.created_at));
                    $('input[name= "total"]').val(data.total);
                    $('select[name= "status"]').val(data.status);
                });

                $('.form-payment').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : `api/payments/${id}?_method=PUT`,
                        type : 'POST',
                        data : frmdata,
                        cache :false,
                        contentType : false,
                        processData : false,
                        headers: {
                            "Authorization": "Bearer" + token
                        },
                        success : function(data){
                            if (data.success){
                                alert('Data Edited')
                                location.reload()
                            }
                        }
                    });
                });
            });

        });
    </script>
@endpush

