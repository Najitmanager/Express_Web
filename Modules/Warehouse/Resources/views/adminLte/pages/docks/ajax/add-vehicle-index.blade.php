@foreach($vehicles as $item)
    <tr>
        <td class="p-1 px-4"><input type="checkbox" id="ids"  value="{{ $item->id }}"></td>
        <td class="p-1 px-4">{{ $item->name }} <br> {{ $item->vin }}</td>
        <td class="p-1 px-4">{{ optional($item->color)->name }}</td>
        <td class="p-1 px-4">{{ optional($item->port)->name }}</td>
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
    </tr>
@endforeach


