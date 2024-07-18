@if ($item->status == 4)
    {
    <td></td>
    <td></td>
    <td>
        <form method="POST" action="{{ route('PostApproval') }}" style="display:inline;">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa-solid fa-check"></i>
            </button>
        </form>

    </td>

    <td>
        <form method="POST" action="{{ route('PostCancel') }}" style="display:inline;">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="btn btn-warning btn-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </form>

    </td>
    }

@elseif($item->status == 3)
{
    <td>
    </td>
    <td>
       
    </td>
    }
    @elseif($item->status == 2)
{
    <td>
    </td>
    <td>

    </td>
    }
    @elseif($item->status == 1)
    {
        <td>
            <form action="{{ route('EditPost') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i>
                </button>
            </form>
        </td>
        <td>
            <form action="{{ route('PostDelete') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </td>
        }
@endif
