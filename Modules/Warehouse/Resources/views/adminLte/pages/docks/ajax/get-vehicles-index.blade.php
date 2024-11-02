@foreach($vehicles as $item)
    <tr>
        <td class="p-1 px-4">{{ $item->name }} <br> {{ $item->vin }}</td>
        <td class="p-1 px-4">{{ optional($item->client)->user->name }} <br> {{ optional($item->port)->name }}</td>
        <td class="p-1 px-4">{{ optional($item->workflow)->hat }}</td>
        <td class="p-1 px-4">{{ $item->weight }} KG <br> $ {{ $item->price }}</td>
        <td class="p-1 px-4">{{ $item->public_notes }} <br> {{ $item->private_notes }}</td>
        <td class="p-1 px-4">{{ optional($item->workflow)->title_number }}</td>
        <td class="p-1 px-4">
            @if($item->workflow && $item->workflow->title_number){
            <i class="fa-solid fa-square-check text-success"></i>
            @else
                <i class="fa-solid fa-square-check text-danger"></i>
            @endif
        </td>
        <td class="p-1 px-4">
            @if($item->workflow && count($item->getMedia('keys'))){
            <i class="fa-solid fa-square-check text-success"></i>
            @else
                <i class="fa-solid fa-square-check text-danger"></i>
            @endif

        </td>
        <td class="p-1 px-4"><i class="fa-regular fa-pen-to-square text-warning"></i></td>
        <td class="p-1 px-4"><i class="fa-regular fa-trash-can text-danger"></i></td>
    </tr>
    <input type="hidden" name="vehicles[]" value="{{ $item->id }}">
@endforeach

