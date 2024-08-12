@extends('layouts.app')


@section('content')
    <div class="gallery-container">
        <div>
            <h1 id="gallery-title" class="gallery-title" data-id="{{ get_the_ID() }}">{!! get_the_title() !!}</h1>
        </div>
        <div class="ticker-wrap">
            <div class="ticker">
                <span class="item-collection-1">
                    @for ($i = 0; $i < 6; $i++)
                        <span class="item">Scroll - to create gallery </span>
                    @endfor
                </span>
                <span class="item-collection-2">
                    @for ($i = 0; $i < 6; $i++)
                        <span class="item">Scroll - to create gallery </span>
                    @endfor
                </span>
            </div>
        </div>
        <div class="ticker-wrap two">
            <div class="ticker">
                <span class="item-collection-1">
                    @for ($i = 0; $i < 6; $i++)
                        <span class="item">Scroll - to create gallery </span>
                    @endfor
                </span>
                <span class="item-collection-2">
                    @for ($i = 0; $i < 6; $i++)
                        <span class="item">Scroll - to create gallery </span>
                    @endfor
                </span>
            </div>
        </div>
    </div>

    <div class="gallery-container--mobile">
        <h1 id="gallery-title" class="gallery-title" data-id="{{ get_the_ID() }}">{!! get_the_title() !!}</h1>

        <ul class="gallery-list">
            @foreach ($images as $image)
                <li class="gallery-list__item">
                    @php
                        echo wp_get_attachment_image($image['image']['ID'], 'large', ' ', ['class' => 'img-responsive']);
                    @endphp
                </li>
            @endforeach
        </ul>
    </div>
@endsection
