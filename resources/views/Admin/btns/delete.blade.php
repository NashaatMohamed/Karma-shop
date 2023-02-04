
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#del_user{{$id}}">
    <i class="bi bi-trash"></i>
  </button>
  <!-- Modal -->
  <div class="modal fade" id="del_user{{$id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">{{$fname .  " " . $lname}} Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteuser"  action="{{route('UserDelete',$id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                      <div>
                          <h4 class="modal-title w-100" style="text-align: center;" >Are you sure?</h4>
                          <div class="modal-body">
                              <p>Do you really want to delete these user? This process cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary delete_user">delete</button>
                    </div>
                </form>
      </div>
    </div>
  </div>


