@extends("Admin.layouts")

@section("content")

@section('title', 'ALL Users')


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
<div class="alert alert-info d-flex justify-content-center" style="width:100%" role="alert">{{ session('success') }}</div>
@endif

<div class="box w-80">
    <div class="box-header">
        <hr>
        <div class="box-body">
            {{-- {{ $dataTable->table( attributes:["class" => 'dataTable table table-striped table-bordered table-hover']),true}} --}}
<form id="formdata"  action="{{route('UsersDelete')}}" method="post">
    @csrf
    @method('DELETE')
    {!! $dataTable->table(['class'=>'dataTable table table-striped table-hover  table-bordered w-100'],true) !!}
</form>
            <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="delmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Users delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 0;">
            <div class="non-empty invisible">
				<h4 class="modal-title w-100" style="text-align: center;" >Are you sure?</h4>
                    <div class="modal-body">
                        <p>Do you really want to delete these users <span class="count" style="color: red;"></span>? This process cannot be undone.</p>
                    </div>
            </div>
            <div class="empty invisible">
				<h4 class="modal-title w-100" style="text-align: center;padding:0;" >please select users to delete :)</h4>
            </div>
        </div>
        <div class="modal-footer non-empty invisible">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary delete_item">Delete All</button>
        </div>

        <div class="modal-footer empty invisible">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
  </div>

        </div>
    </div>
</div>
@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

<script>
    delete_all();
</script>

{{ $dataTable->scripts() }}

@endpush
@endsection


