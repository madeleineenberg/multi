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
                @php
                    $id = $image['image']['ID'];
                @endphp
                <figure class="gallery-flow__item pos-{{ $i % 7 }} size-{{ $i % 5 }}"
                    @if ($i % 2 === 0) data-scroll data-scroll-speed="1.4" @endif>
                    <button type="button" class="gallery-flow__trigger"
                        data-full="{{ wp_get_attachment_image_url($id, 'full') }}"
                        data-alt="{{ get_post_meta($id, '_wp_attachment_image_alt', true) }}"
                        aria-label="{{ sprintf('Öppna bild %d av %d', $i + 1, count($images)) }}">
                        {!! wp_get_attachment_image($id, 'large', false, [
                            'class' => 'gallery-flow__img',
                            'loading' => $i < 2 ? 'eager' : 'lazy',
                        ]) !!}
                    </button>
                </figure>
            @endforeach
        </div>
    </div>

    <div class="gallery-container--mobile">
        {{--
            gallery-title--static håller den här rubriken utanför SplitType och
            anime-tidslinjen i animateText. Den animationen väntar en sekund och
            tonar sedan in i två, vilket på mobil blir tre sekunders tom yta.
        --}}
        <h1 id="gallery-title-mobile" class="gallery-title gallery-title--static" data-id="{{ get_the_ID() }}">
            {!! get_the_title() !!}</h1>

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

    {{--
        Bildvisaren. JS flyttar ut den till body vid start: position: fixed
        biter inte inuti [data-scroll-container], som locomotive förskjuter
        med transform.
    --}}
    <div class="lightbox" role="dialog" aria-modal="true" aria-hidden="true"
        aria-label="{{ get_the_title() }}">
        <div class="lightbox__backdrop" data-lightbox-close></div>

        <button type="button" class="lightbox__close" data-lightbox-close aria-label="Stäng bildvisningen">
            <ion-icon name="close-outline"></ion-icon>
        </button>

        <button type="button" class="lightbox__nav lightbox__nav--prev" data-lightbox-prev
            aria-label="Föregående bild">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </button>

        <figure class="lightbox__stage">
            <img class="lightbox__img" src="" alt="">
        </figure>

        <button type="button" class="lightbox__nav lightbox__nav--next" data-lightbox-next aria-label="Nästa bild">
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </button>

        <p class="lightbox__counter" aria-live="polite"></p>
    </div>
@endsection
