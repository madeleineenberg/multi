@php
  use App\View\Composers\Events;
@endphp
<article @php post_class('c-event container') @endphp>
  <div class="row">
    <section class="main-content col-12 col-md-8 col-lg-6 offset-lg-1">
      <header>
        <div class="c-event__event-info event-info">
          <div class="c-event__event-info--date">
            <span class="day">{{ wp_date('j', strtotime($date), null) }}</span>
            <span class="month">{{ wp_date('M', strtotime($date), null) }}</span>
          </div>
          <div class="c-event__event-info--info">
            <p class="term">{{ Events::getTermName($post->ID) }}</p>
            <p class="place">{{ __('Place', 'osolo') }}: {{ $place }}</p>
          </div>
          @if (date('Y-m-d') > $date)
            <span class="completed">{{ __('completed', 'osolo') }}</span>
          @else
            <a class="has-orange-color scroll-to-link" href="#registration-area">
              {{ __('To registration', 'osolo') }}
            </a>
          @endif
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
      @if (date('Y-m-d') < $date)
        <span id="registration-area"></span>
        <div class="c-event__register">
          <div class="has-primary-background-color has-white-color">
            <div class="c-event__register--topInfo">
              <div>
                <p>{{ __('Date', 'osolo') }}: {{ wp_date('F j, Y', strtotime($date), null) }}</p>
                <p>{{ __('Time', 'osolo') }}: {{ $time }}</p>
                <p>{{ __('Place', 'osolo') }}: {{ $place }}</p>
              </div>
              <div class="theme-btn">{{ __('Register here', 'osolo') }}</div>
            </div>
            <hr />
            <p>{{ __('If you have any questions, please send an email to', 'osolo') }} {{ $infoMail }}</p>
          </div>
        </div>
      @endif

    </section>
    <div class="sidebar upcoming-events col-12 col-md-4 col-lg-3 offset-lg-1">
      @if ($completedEventsExist->found_posts > 0)
        <div class="c-filter-links">
          <a href="/events">
            {{ __('Upcoming events', 'osolo') }}
          </a>
          <a href="/events/?status=completed-events">
            {{ __('Completed events', 'osolo') }}
          </a>
        </div>
      @endif
      <h4>{{ __('Upcoming events', 'osolo') }}</h4>
      <?php $i = 0; ?>
      @foreach ($upcomingEvents->posts as $event)
        @if ($event->ID == get_the_id())
          @php continue @endphp
        @endif
        <a href="{{ get_permalink($event->ID) }}" class="upcoming-events__event">
          <span class="date">{{ wp_date('M', strtotime(get_field('date_of_event', $event->ID)), null) }}
            {{ wp_date('j', strtotime(get_field('date_of_event', $event->ID)), null) }}</span>
          <p class="sub-label">{{ Events::getTermName($event->ID) }}</p>
          <p class="sub-label">{{ __('Place', 'osolo') }}: {{ get_field('place', $event->ID) }}</p>
          <p>{{ get_the_title($event->ID) }}</p>
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
