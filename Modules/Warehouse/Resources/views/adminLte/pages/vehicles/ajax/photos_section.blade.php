@if($model->getFirstMediaUrl('main'))
    <img src="{{ $model->getFirstMediaUrl('main') }}"
         class="rounded-5 border-red" alt="">
@endif
@if($model->getFirstMediaUrl('bill_of_lading'))
    <img src="{{$model->getFirstMediaUrl('bill_of_lading')}}"
         class="rounded-5 border-blue" alt="">
@endif
@foreach($model->getMedia('photos') as $photo)
    <img src="{{ $photo->getUrl() }}"
         class="rounded-5 border-gray" alt="">
@endforeach
