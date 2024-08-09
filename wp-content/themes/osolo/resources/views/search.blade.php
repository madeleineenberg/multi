@extends('layouts.app')

@section('content')
  <div class="c-search container">
    <header class="c-search__header container">
      <h1>
        @if ($found_posts === 1)
          {{ sprintf(__('Din sökning på "%1$s" gav en träff.', 'osolo'), $search) }}
        @else
          {{ sprintf(__('Din sökning på "%1$s" gav %2$s träffar.', 'osolo'), $search, $found_posts) }}
        @endif
      </h1>
      <form action="/" method="GET">
        @svg('images.icon_search')
        <input value="{{ $search }}" name="s" type="text" placeholder="{{ __('Sök...', 'osolo') }}">
      </form>
    </header>

    <div class="c-search__list container">
      <ul class="c-search__results" data-search="{{ $search }}">
        @posts
          <li class="col-12 col-md-8  offset-lg-2">
            <a href="{{ get_permalink() }}">
              @if (has_post_thumbnail() && get_post_type() === 'product')
                {!! get_the_post_thumbnail(get_the_ID(), 'thumbnail', [
                    'class' => 'c-search__thumbnail',
                ]) !!}
              @elseif (get_post_type() === 'product_variation')
                {!! get_the_post_thumbnail(wp_get_post_parent_id(), 'thumbnail', [
                    'class' => 'c-search__thumbnail',
                ]) !!}
              @endif
              <h4>{!! get_the_title() !!}</h4>
            </a>
          </li>
        @endposts
      </ul>
    </div>
  </div>
@endsection
