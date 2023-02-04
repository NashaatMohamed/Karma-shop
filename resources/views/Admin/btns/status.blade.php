<a href="{{route('ChangeUserStatus',["id" => $id , "status" => $is_active == 1 ? 0 : 1])}}" class="btn btn-{{$is_active== 1 ? 'danger' : 'dark'}}">
    {{$is_active == 1 ? "Deativate" : "Activate"}}<a>

