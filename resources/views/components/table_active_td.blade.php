@php
    $color = '';
    $text = '';
    
    switch ($item->status) {
        case 1:
            $color = 'green';
            $text = 'Active';
            break;
        case 2:
            $color = 'red';
            $text = 'Deleted';
            break;
        case 3:
            $color = 'IndianRed';
            $text = 'Canceled';
            break;
        case 4:
            $color = 'LightSalmon';
            $text = 'Waiting for approval';
            break;
        default:
            $color = 'black';
            $text = 'Unknown';
            break;
    }
@endphp

<td style="color: {{ $color }}; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;">
    {{ $text }}
</td>