@php
    use App\View\Composers\News;
@endphp
<div class="container c-archive c-news-archive" data-cpt="news">
    <div class="c-page-header container">
        <div class="row justify-content-md-center">
            <div class="c-page-header__content col-12 col-md-8 col-xl-6">
                @if ($archive_heading)
                    <h1>{!! $archive_heading !!}</h1>
                @endif
                @if ($archive_preamble)
                    <p class="puff-size">{{ $archive_preamble }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="c-filterArea">
        <ul class="c-filters desktop">
            <li class="c-filters__filter {{ isset($_GET['type']) ? '' : 'active' }}" data-text="">
                {{ __('View all', 'osolo') }}
            </li>

            @foreach ($allTerms as $term)
                <li class="c-filters__filter {{ isset($_GET['type']) && $_GET['type'] === $term->slug ? 'active' : '' }}"
                    data-text={{ $term->slug }}>
                    {!! $term->name !!}
                </li>
            @endforeach
        </ul>
        <div class="c-filter-dropdown filterType mobile">

            <p class="placeholder-text">
                <span>
                    {{ isset($_GET['type']) && $_GET['type'] ? $_GET['type'] : __('Select type', 'osolo') }}
                </span>
            </p>
            <ul class="c-filters c-filter-dropdown__dropdown">
                <li class="c-filters__filter {{ isset($_GET['type']) ? '' : 'active' }}" data-text="">
                    {{ __('Show all', 'osolo') }}</li>
                @foreach ($allTerms as $term)
                    <li class="c-filters__filter {{ isset($_GET['type']) && $_GET['type'] === $term->slug ? 'active' : '' }}"
                        data-text={{ $term->slug }}>
                        {!! $term->name !!}
                    </li>
                @endforeach
            </ul>
        </div>
        @if (count($years) > 1)
            <div class="c-filter-dropdown filterYear">
                <p class="placeholder-text">{{ __('Archive: ', 'osolo') }}
                    <span>{{ $_GET['published-year'] ? $_GET['published-year'] : __('Select year', 'osolo') }}</span>
                </p>
                <ul class="c-filters c-filter-dropdown__dropdown">
                    <li class="c-filters__filter {{ isset($_GET['published-year']) ? '' : 'active' }}" data-value="">
                        {{ __('Show all', 'osolo') }}</li>
                    @foreach ($years as $year)
                        <li class="c-filters__filter {{ $_GET['published-year'] === $year ? 'active' : '' }}"
                            data-value="{{ $year }}">{{ $year }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="row c-news-archive__grid c-archive__grid">
        @foreach ($getNews->posts as $news)
            @include('partials.news-list-item', [
                'link' => get_permalink($news->ID),
                'heading' => get_the_title($news->ID) ?: '',
                'excerpt' => get_the_excerpt($news->ID),
                'newsDate' => get_the_date('Y/m/d', $news->ID),
                'image' => get_field('image_list_view', $news->ID),
                'term' => News::getTermName($news->ID),
            ])
        @endforeach
    </div>

    <div class="c-grid-bottom">
        <span class="c-grid-bottom__count" style="">
            <span class="count">{{ $getNews->post_count }}</span> {{ __('of', 'osolo') }} <span
                class="total">{{ $getNews->found_posts }}</span>
        </span>
        <div class="c-spinner">
            <img src="@asset('images/load.svg')" alt="{{ __('Loading icon', 'osolo') }}">
        </div>

        <button
            class="c-grid-bottom__load-more theme-btn {{ $getNews->post_count < $getNews->found_posts ? 'show' : 'hide' }}"
            style="">
            {{ __('More news', 'osolo') }}
        </button>
    </div>
</div>
