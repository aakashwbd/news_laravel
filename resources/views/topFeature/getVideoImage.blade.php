@if (!empty($videoImg->thumbnail))
    <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $videoImg->thumbnail }}" alt="{{ $videoImg->title }}"
        title="{{ $videoImg->title }}" />
@else
    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
@endif
