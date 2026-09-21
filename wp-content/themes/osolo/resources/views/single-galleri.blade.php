@extends('layouts.app')


@section('content')
    <div class="gallery-container">
        {{--
            Sticky via locomotive, inte CSS: position: sticky fungerar inte
            inuti [data-scroll-container] eftersom locomotive flyttar
            containern med transform.
        --}}
        <aside class="gallery-nav" data-scroll data-scroll-sticky data-scroll-target=".gallery-container">
            <ul class="gallery-nav__list">
                @foreach ($galleries as $gallery)
                    <li class="gallery-nav__item{{ $gallery->ID === get_the_ID() ? ' is-current' : '' }}">
                        <a href="{{ get_permalink($gallery->ID) }}"
                            @if ($gallery->ID === get_the_ID()) aria-current="page" @endif>
                            {{ $gallery->post_title }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Samma uppbyggnad som arkivlänken i image-reveal-blocket. --}}
            <div class="project-link-btn gallery-link">
                <a href="{{ $archive_url }}" class="link">
                    <div>
                        <span class="link-text">Archive</span>
                    </div>
                </a>
                <ion-icon name="arrow-up-outline"></ion-icon>
            </div>
        </aside>

        <h1 id="gallery-title" class="gallery-title" data-id="{{ get_the_ID() }}">{!! get_the_title() !!}</h1>

        <div class="gallery-flow">
            {{--
                Storlek och sidled väljs ur två cykler av olika längd, 5 och 7.
                Kombinationen upprepar sig först efter 35 bilder, så flödet ser
                oregelbundet ut utan att hoppa runt mellan sidladdningar.
                Varannan bild får data-scroll och släpar efter i scrollen, vilket
                är det som får den att glida in över sin granne. Släpet börjar på
                den första bilden, så att den glider upp mot titeln.
            --}}
            @foreach ($images as $i => $image)
                <figure class="gallery-flow__item pos-{{ $i % 7 }} size-{{ $i % 5 }}"
                    @if ($i % 2 === 0) data-scroll data-scroll-speed="1.4" @endif>
                    {!! wp_get_attachment_image($image['image']['ID'], 'large', false, [
                        'class' => 'gallery-flow__img',
                        'loading' => $i < 2 ? 'eager' : 'lazy',
                    ]) !!}
                </figure>
            @endforeach
        </div>
    </div>

    <div class="gallery-container--mobile">
        <h1 id="gallery-title" class="gallery-title" data-id="{{ get_the_ID() }}">{!! get_the_title() !!}</h1>

        <ul class="gallery-list">
            @foreach ($images as $image)
                <li class="gallery-list__item">
                    @php
                        echo wp_get_attachment_image($image['image']['ID'], 'large', ' ', [
                            'class' => 'img-responsive',
                        ]);
                    @endphp
                </li>
            @endforeach
        </ul>
    </div>
@endsection
