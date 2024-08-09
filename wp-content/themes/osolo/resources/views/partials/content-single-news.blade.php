@php
  use App\View\Composers\News;
@endphp
<article @php post_class('c-news container') @endphp>
  <div class="row">
    <section class="main-content col-12 col-md-8 col-lg-6 offset-lg-1">
      <header>
        <div class="c-news__news-info news-info">
          <div class="c-news__news-info--news-date">
            <span class="month sub-label">{{ $newsDate }}</span>
          </div>
          <div class="c-news__news-info--term">
            <p class="term sub-label">{!! News::getTermName($post->ID) !!}</p>
          </div>
        </div>
        <h1 class="entry-title">
          {!! $title !!}
        </h1>
        @if (has_excerpt())
          <p class="puff-size excerpt-area">{!! the_excerpt() !!}</p>
        @endif

        @if ($listImage)
          {!! wp_get_attachment_image($listImage['ID'], 'large', false, ['class' => 'w-100 event-image']) !!}
        @endif
      </header>

      <div class="entry-content">
        @php the_content() @endphp
      </div>
    </section>
    <div class="sidebar c-latest-news col-12 col-md-4 col-lg-3 offset-lg-1">
      <div class="c-filter-links">
        <a href="/news">
          {{ __('View all', 'osolo') }}
        </a>
        @foreach ($allTerms as $term)
          <a href="/news?type={{ $term->slug }}">
            {!! $term->name !!}
          </a>
        @endforeach
        @if (count($years) > 1)
          <div class="c-filter-dropdown filterYear">
            <p class="placeholder-text">{{ __('Archive: Select year', 'osolo') }}</p>
            <div class="c-filters c-filter-dropdown__dropdown">
              <a href="/news">
                {{ __('Show all', 'osolo') }}
              </a>
              @foreach ($years as $year)
                <a href="/news?published-year={{ $year }}">
                  {{ $year }}
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>
      <h4>{{ __('Latest news', 'osolo') }}</h4>
      <?php $i = 0; ?>
      @foreach ($allNews->posts as $news)
        @if ($news->ID == get_the_id())
          @php continue @endphp
        @endif
        <a href="{{ get_permalink($news->ID) }}" class="c-latest-news__news">
          <span class="date sub-label">{{ get_the_date('Y/m/d', $news->ID) }}</span>
          <p class="bold-font">{{ get_the_title($news->ID) }}</p>
          <p>{{ wp_trim_words(get_the_excerpt($news->ID), 25, '...') }}</p>
        </a>
        <?php
        $i++;
        if ($i == 5) {
            break;
        }
        ?>
      @endforeach
    </div>

  </div>
</article>
