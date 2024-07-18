@if($item->is_approved==0){
    <td>
        <form method="POST" action="{{route('UserApproval')}}" style="display:inline;">
            @csrf
            <input type="hidden" name="userid" value="{{ $item->id }}">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa-solid fa-check"></i>
            </button>
        </form>
    
    </td>
}
@else{

}
@endif