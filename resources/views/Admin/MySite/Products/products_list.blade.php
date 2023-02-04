@extends('Admin.layouts')

@section('content')

@section('title', 'ALL Products')

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
        Create New Product
    </button>

    <!-- Create Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="myForm" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Product Name</label>
                                <input name="name" type="text" class="form-control">
                            </div>
                            <div class="col-6">
                                <label>Product description</label>
                                <input name="description" type="text" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label>Product color</label>
                                    <input name="color" type="color" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Product size</label>
                                    <input name="size" type="text" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Product stock</label>
                                    <input name="stock" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-4 mt-2">
                                <label>product Code</label>
                                <input type="text" class="form-control" name="productCode">
                            </div>

                            <div class="col-4 mt-2">
                                <label>product price</label>
                                <input type="number" class="form-control" name="price">
                            </div>

                            <div class="col-4 mt-2">
                                <label>product sale_price</label>
                                <input type="number" class="form-control" name="sale_price">
                            </div>

                            <div class="col-4 mt-2">
                                <label class="col-lg-3 col-form-label">Category</label>
                                <select class="form-control chosen-rtl select" name='categories_id' id='category'>
                                    <option selected>- Select Category- </option>
                                    {{-- <option>no Category</option> --}}
                                    @foreach ($Categories as $category)
                                        <option value='{{ $category->id }}'>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4 mt-2">
                                <label class="col-lg-3 col-form-label">SubCategory</label>
                                <select class="form-control chosen-rtl select" name='sub_categories_id'
                                    id="subcategory">
                                    <option selected>- Select SubCategory- </option>
                                </select>
                            </div>

                            <div class="col-4 mt-2">
                                <label class="col-lg-3 col-form-label">Brands</label>
                                <select class="form-control chosen-rtl select" name='brands_id' id='brands_id'>
                                    <option selected>- Select Brand- </option>
                                    {{-- <option>no Category</option> --}}
                                    @foreach ($brands as $brand)
                                        <option value='{{ $brand->id }}'>
                                            {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mt-3">
                                <label>product image</label>
                                <input type="file" class="form-control edit" name="image" id="photo">
                            </div>
                            <div class="col-6 mt-3">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateForm" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id" class="edit">
                        <div class="row">
                            <div class="col-6">
                                <label>Product Name</label>
                                <input name="name" type="text" class="form-control edit">
                            </div>
                            <div class="col-6">
                                <label>Product description</label>
                                <input name="description" type="text" class="form-control edit">
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label>Product color</label>
                                    <input name="color" type="color" class="form-control edit">
                                </div>
                                <div class="col-4">
                                    <label>Product size</label>
                                    <input name="size" type="text" class="form-control edit">
                                </div>
                                <div class="col-4">
                                    <label>Product stock</label>
                                    <input name="stock" type="number" class="form-control edit">
                                </div>
                            </div>
                            <div class="col-4 mt-2">
                                <label>product Code</label>
                                <input type="text" class="form-control edit" name="productCode">
                            </div>

                            <div class="col-4 mt-2">
                                <label>product price</label>
                                <input type="number" class="form-control edit" name="price">
                            </div>

                            <div class="col-4 mt-2">
                                <label>product sale_price</label>
                                <input type="number" class="form-control edit" name="sale_price">
                            </div>

                            <div class="col-4 mt-2">
                                <label class="col-lg-3 col-form-label">Category</label>
                                <select class="form-control chosen-rtl edit select" name='categories_id' id='category_edit'>
                                    <option selected>- Select Category- </option>
                                    {{-- <option>no Category</option> --}}
                                    @foreach ($Categories as $category)
                                        <option value='{{ $category->id }}'>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4 mt-2">
                                <label class="col-lg-3 col-form-label">SubCategory</label>
                                <select class="form-control edit chosen-rtl select" name='sub_categories_id'
                                    id="subcategory_edit">
                                    <option selected>- Select SubCategory- </option>

                                    @foreach ($sub_Categories as $subcategory)
                                    <option value='{{ $subcategory->id }}'>
                                        {{ $subcategory->name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-4 mt-2">
                                <label class="col-lg-3 col-form-label">Brands</label>
                                <select class="form-control edit chosen-rtl select" name='brands_id' id='brands_id'>
                                    <option selected>- Select Brand- </option>
                                    {{-- <option>no Category</option> --}}
                                    @foreach ($brands as $brand)
                                        <option value='{{ $brand->id }}'>
                                            {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mt-3">
                                <label>product image</label>
                                <input type="file" class="form-control edit" name="image" id="editimage">
                            </div>
                            <div class="col-6 mt-3">
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
    <table id="product" class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>description</th>
                <th>stock</th>
                <th>color</th>
                <th>size</th>
                <th>price</th>
                <th>sale_price</th>
                <th>image</th>
                <th>Category Name</th>
                <th>Subcategory Name</th>
                <th>brand Name</th>
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


            // get subcategory from category
            $('#category').on('change', function(e) {
                var cat_id = e.target.value;
                $.ajax({
                    url: "{{ route('CatSubCat') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id
                    },
                    success: function(data) {
                        $('#subcategory').empty();
                        $.each(data.subcategories[0].sub_categories, function(index,
                            subcategory) {
                            $('#subcategory').append('<option value="' +
                                subcategory.id + '">' + subcategory
                                .name + '</option>');
                        })
                    }
                })
            });

            // Data Display
            var table = $('#product').DataTable({
                ajax: "{{ route('productGet') }}",
                columns: [{
                        "data": 'productCode'
                    },
                    {
                        "data": 'name'
                    },
                    {
                        "data": 'description'
                    },
                    {
                        "data": 'stock'
                    },
                    {
                        "data": 'color'
                    },
                    {
                        "data": 'size'
                    },
                    {
                        "data": 'price'
                    },
                    {
                        "data": 'sale_price'
                    },
                    {
                        "data": "image",
                        render: function(data, row, type) {
                            return `<img src="${data}" width="50px">`
                        }
                    },
                    {
                        "data": 'categories_id'
                    },
                    {
                        "data": 'sub_categories_id'
                    },
                    {
                        "data": "brands_id",
                    },
                    {
                        "data": null,
                        render: function(data, row, type) {
                            console.log(data);
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
            // Data Insert Code
            $('#submit').click(function(e) {
                e.preventDefault();
                // Data Create
                var formData = new FormData();
                let name = $("input[name='name']").val();
                let description = $("input[name='description']").val();
                let stock = $("input[name='stock']").val();
                let size = $("input[name='size']").val();
                let color = $("input[name='color']").val();
                let price = $("input[name='price']").val();
                let sale_price = $("input[name='sale_price']").val();
                let productCode = $("input[name='productCode']").val();
                let categories_id = $("select[name='categories_id']").val();
                let sub_categories_id = $("select[name='sub_categories_id']").val();
                let brands_id = $("select[name='brands_id']").val();
                let is_active = $("input[name='is_active']:radio:checked").val();

                var photo = $('#photo').prop('files')[0];
                formData.append('image', photo);
                formData.append('name', name);
                formData.append('description', description);
                formData.append('stock', stock);
                formData.append('color', color);
                formData.append('price', price);
                formData.append('sale_price', sale_price);
                formData.append('productCode', productCode);
                formData.append('categories_id', categories_id);
                formData.append('sub_categories_id', sub_categories_id);
                formData.append('brands_id', brands_id);
                formData.append('is_active', is_active);
                $.ajax({
                    url: "{{ route('productStore') }}",
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
                    url: "{{ route('productEdit') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        $('input[name="id"].edit').val(response.data.id);
                        $('input[name="name"].edit').val(response.data.name);
                        $('input[name="description"].edit').val(response.data.description);
                        $('input[name="color"].edit').val(response.data.color);
                        $('input[name="size"].edit').val(response.data.size);
                        $('input[name="price"].edit').val(response.data.price);
                        $('input[name="sale_price"].edit').val(response.data.sale_price);
                        $('input[name="productCode"].edit').val(response.data.productCode);
                        $('input[name="stock"].edit').val(response.data.stock);
                        $('select[name="categories_id"].edit').val(response.data.categories_id);
                        $('select[name="sub_categories_id"].edit').val(response.data.sub_categories_id);
                        $('select[name="brands_id"].edit').val(response.data.brands_id);
                        $('input[name="is_active"]:radio.edit').each(function() {
                            if (this.value == (response.data.is_active)) {
                                $(this).prop("checked", true);
                            }

                            // get subcategory from category
            $('#category_edit').on('change', function(e) {
                var cat_id = e.target.value;
                $.ajax({
                    url: "{{ route('CatSubCat') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id
                    },
                    success: function(data) {
                        $('#subcategory_edit').empty();
                        $.each(data.subcategories[0].sub_categories, function(index,
                            subcategory) {
                            $('#subcategory_edit').append('<option value="' +
                                subcategory.id + '">' + subcategory
                                .name + '</option>');
                        })
                    }
                })
            });
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
                    let stock = $("input[name='stock'].edit").val();
                    let size = $("input[name='size'].edit").val();
                    let color = $("input[name='color'].edit").val();
                    let price = $("input[name='price'].edit").val();
                    let sale_price = $("input[name='sale_price'].edit").val();
                    let productCode = $("input[name='productCode'].edit").val();
                    let categories_id = $("select[name='categories_id'].edit").val();
                    let sub_categories_id = $("select[name='sub_categories_id'].edit").val();
                    let brands_id = $("select[name='brands_id'].edit").val();
                    let is_active = $("input[name='is_active']:radio:checked.edit").val();
                    var photo = $('#editimage').prop('files')[0];
                    formData.append('image', photo);
                formData.append('name', name);
                formData.append('id', id);
                formData.append('description', description);
                formData.append('stock', stock);
                formData.append('size', size);
                formData.append('color', color);
                formData.append('price', price);
                formData.append('sale_price', sale_price);
                formData.append('productCode', productCode);
                formData.append('categories_id', categories_id);
                formData.append('sub_categories_id', sub_categories_id);
                formData.append('brands_id', brands_id);
                formData.append('is_active', is_active);
                    $.ajax({
                        url: "{{ route('productUpdate') }}",
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
                        url: "{{ route('productDelete') }}",
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
