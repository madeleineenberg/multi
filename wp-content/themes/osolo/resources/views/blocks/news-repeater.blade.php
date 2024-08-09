{{-- /
  Title: __('Nyhetsblock', 'osolo')
  Description: __('Visar tre senaste nyheterna', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: news list repeater upprepa nyheter lista
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

@php
  use App\View\Composers\News;
@endphp

<div class="c-newsBlock container {{ $fade_block ? 'fade-block' : '' }}">
  <div class="row h100">
    <h2>
      {{ $blockHeading }}
    </h2>

    @while ($allNews->have_posts())
      @php
        $allNews->the_post();
      @endphp

      @include('partials.news-list-item', [
          'link' => get_permalink(),
          'heading' => get_the_title() ?: '',
          'excerpt' => get_the_excerpt(),
          'date' => get_the_date('Y/m/d'),
          'term' => News::getTermName(),
      ])

      @php
        if ($allNews->current_post === 3) {
            break;
        }
      @endphp
    @endwhile

    @php
      wp_reset_postdata();
    @endphp
  </div>
</div>
