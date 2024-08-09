{{-- /
  Title: __('Aktivitetsblock', 'osolo')
  Description: __('Visar tre kommande event', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: event list repeater upprepare lista aktivitet
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

@php
  use App\View\Composers\Events;
@endphp

<div class="c-upcomingEvents container {{ $fade_block ? 'fade-block' : '' }}">
  <div class="row h100">
    <h2>
      {{ $blockHeading }}
    </h2>

    @while ($upcomingEvents->have_posts())
      @php
        global $post;
        $upcomingEvents->the_post();
      @endphp

      @include('partials.event-list-item', [
          'link' => get_permalink(),
          'heading' => get_the_title() ?: '',
          'date' => get_field('date_of_event', get_the_ID()),
          'place' => get_field('place', get_the_ID()),
          'term' => Events::getTermName(),
      ])

      @php
        if ($upcomingEvents->current_post === 2) {
            break;
        }
      @endphp
    @endwhile

    @php
      wp_reset_postdata();
    @endphp
  </div>
</div>
