@extends('Admin.layouts')

@section('content')

@section('title', 'ALL Brands')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-info d-flex justify-content-center" style="width:100%" role="alert">{{ session('success') }}
    </div>
@endif


<div class="container">
    <!-- Button Create trigger modal -->
    <button type="button" class="btn btn-success float-end mb-2 mt-2" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Create New Brand
    </button>

    <!-- Create Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="myForm"  enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Brand Name</label>
                                <input name="name" type="text" class="form-control">
                            </div>
                            <div class="col-6">
                                <label>Brand description</label>
                                <input name="description" type="text" class="form-control">
                            </div>
                            <div class="col-6 mt-4">
                                <label>Brand image</label>
                                <input type="file" class="form-control" name="image" id="photo">
                            </div>
                            <div class="col-6 mt-2">
                                <h6 class="mb-2 pb-1">Status: </h6>
                                <input class="form-check-input" type="radio" name="is_active" id="Active"
                                    value="1" checked />
                                <label class="form-check-label" for="Active">Active</label>

                                <input class="form-check-input" type="radio" name="is_active" id="inactive"
                                    value="0" />
                                <label class="form-check-label" for="inactive">InActive</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateForm" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input class="edit" type="hidden" name="id">
                        <div class="row">
                            <div class="col-6">
                                <label>Brand Name</label>
                                <input name="name" type="text" class="form-control edit">
                            </div>
                            <div class="col-6">
                                <label>Brand description</label>
                                <input name="description" type="text" class="form-control edit">
                            </div>
                            <div class="col-6 mt-4">
                                <label>Brand image</label>
                                <input type="file" class="form-control edit" name="image" id="editimage">
                            </div>
                            <div class="col-6 mt-2">
                                <h6 class="mb-2 pb-1">Status: </h6>
                                <input class="form-check-input edit" type="radio" name="is_active" id="Active"
                                    value="1" />
                                <label class="form-check-label" for="Active">Active</label>

                                <input class="form-check-input edit" type="radio" name="is_active" id="inactive"
                                    value="0" />
                                <label class="form-check-label" for="inactive">InActive</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="update" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <table id="Brands" class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>image</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Data Display
            var table = $('#Brands').DataTable({
                ajax: "{{ url('admin/Brands/create') }}",
                columns: [{
                        "data": 'name'
                    },
                    {
                        "data": 'description'
                    },
                    {
                        "data": "image",
                        render: function(data, row, type) {
                            return `<img src="${data}" width="50px">`
                        }

                    },
                    {
                        "data": null,
                        render: function(data, row, type) {
                            if (data.is_active == 1) {
                                return `<button class="btn btn-success">Active</button>`
                            } else {
                                return `<button class="btn btn-dark">InActive</button>`
                            }
                        }
                    },
                    {
                        "data": null,
                        render: function(data, row, type) {
                            return `<button data-id = "${data.id}" class="btn btn-info" id="edit" data-bs-toggle="modal" data-bs-target="#EditModal"><i class="bi bi-pencil-square"></i></button>`
                        }
                    },
                    {
                        "data": null,
                        render: function(data, row, type) {
                            return `<button data-id = "${data.id}" class="btn btn-danger" id="delete" ><i class="bi bi-trash"></i></button>`
                        }
                    },
                ],
            });
            //Data Insert Code
            $('#submit').click(function(e) {
                e.preventDefault();
                // Data Create
                var formData = new FormData();
                let name = $("input[name='name']").val();
                let description = $("input[name='description']").val();
                let is_active = $("input[name='is_active']:radio:checked").val();

                var photo = $('#photo').prop('files')[0];
                formData.append('image', photo);
                formData.append('name', name);
                formData.append('description', description);
                formData.append('is_active', is_active);
                $.ajax({
                    url: "{{ route('Brands.store') }}",
                    type: "POST",
                    contentType: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    data: formData,
                    success: function(response) {
                        $('#myForm')[0].reset();
                        $('#exampleModal').modal('hide');
                        console.log(response);
                        table.ajax.reload();
                    }
                });
            });

            // edit city code goes here
            $(document).on('click', '#edit', function() {
                $.ajax({
                    url: "{{ route('EditBrand') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        $('input[name="id"].edit').val(response.data.id);
                        $('input[name="name"].edit').val(response.data.name);
                        $('input[name="description"].edit').val(response.data.description);
                        $('input[name="is_active"]:radio.edit').each(function(){
                            if(this.value == (response.data.is_active)){
                                $(this).prop("checked",true);
                            }
                        })
                    }
                })
            })

            // Update city code goes here
            $(document).on('click', '#update', function() {
                if (confirm('Are you sure you want to update??')) {
                    var formData = new FormData();
                let name = $("input[name='name'].edit").val();
                let id = $("input[name='id'].edit").val();
                let description = $("input[name='description'].edit").val();
                let is_active = $("input[name='is_active']:radio:checked.edit").val();
                var photo = $('#editimage').prop('files')[0];
                formData.append('image', photo);
                formData.append('name', name);
                formData.append('id', id);
                formData.append('description', description);
                formData.append('is_active', is_active);
                    $.ajax({
                        url: '{{ route('UpdateBrand') }}',
                        type: 'post',
                        contentType: 'multipart/form-data',
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        data: formData,
                        success: function(response) {
                            $('#updateForm')[0].reset();
                            table.ajax.reload();
                            $('#EditModal').modal('hide')
                        }
                    })
                }
            })

            // delete city code goes here
            $(document).on('click', '#delete', function() {
                if (confirm('Are you sure you want delete??')) {
                    $.ajax({
                        url: "{{ route('DeleteBrand') }}",
                        type: "delete",
                        dataType: 'json',
                        data: {
                            "id": $(this).data('id')
                        },
                        success: function(response) {
                            table.ajax.reload();
                        }
                    })
                }
            })
        });
    </script>
@endpush

@endsection
