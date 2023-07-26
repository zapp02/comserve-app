@extends('layout.app')

@section('title', 'SubCategory Data')

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            List of subcategory
        </h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
            <a href="#modal-form" class="btn btn-primary modal-add">Add Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Subcategory Name</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Image</th>
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
          <h5 class="modal-title">Subcategory Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <form class="form-subcategory">
                    <div class="form-group">
                        <label for="">Subcategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name" placeholder="Subcategory Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="id_category" id="id_category" class="form-control">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" placeholder="Description" class="form-control" id="" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="image">
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
                url : '/api/subcategories',
                success : function ({data}) {

                    let row;
                    data.map(function (val,index) {
                       row += `
                       <tr>
                            <td>${index+1}</td>
                            <td>${val.subcategory_name}</td>
                            <td>${val.category.category_name}</td>
                            <td>${val.description}</td>
                            <td><img src="/uploads/${val.image}" width="150"</td>
                            <td>
                                <a data-toggle="modal" href="@modal-form" data-id="${val.id}" class="btn btn-warning modal-edit">Edit</a>
                                <a href ="#" data-id="${val.id}" class="btn btn-danger btn-delete">Delete</a>
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
                        url : '/api/subcategories/' + id,
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

            $('.modal-add').click(function(){
                $('#modal-form').modal('show')
                $('input[name= "subcategory_name"]').val('')
                $('textarea[name= "description"]').val('')
                $('select[name = "id_category"]').val('');

                $('.form-subcategory').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : 'api/subcategories',
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
                                alert('Data Added')
                                location.reload()
                            }
                        }
                    })
                });
            });

            $(document).on('click','.modal-edit', function(){
                $('#modal-form').modal('show')
                const id = $(this).data ('id');

                $.get('/api/subcategories/' + id,function({data}){
                    $('input[name= "subcategory_name"]').val(data.subcategory_name);
                    $('select[name = "id_category"]').val(data.id_category);
                    $('textarea[name= "description"]').val(data.description);
                });

                $('.form-subcategory').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : `api/subcategories/${id}?_method=PUT`,
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

