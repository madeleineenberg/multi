@php
  use App\View\Composers\Events;
@endphp
<div class="container c-archive c-event-archive" data-cpt="events">
  @if ($completedEventsExist->found_posts > 0)
    <div class="c-filterArea">
      <ul class="c-filters">
        <li
          class="c-filters__filter {{ !isset($_GET['status']) || $_GET['status'] === 'upcoming-events' ? 'active' : '' }}"
          data-status="upcoming-events">
          {{ __('Upcoming events', 'osolo') }}
        </li>
        <li
          class="c-filters__filter {{ isset($_GET['status']) && $_GET['status'] === 'completed-events' ? 'active' : '' }}"
          data-status="completed-events">
          {{ __('Completed events', 'osolo') }}
        </li>
      </ul>
    </div>
  @endif
  <div class="row c-events-archive__grid c-archive__grid">
    @foreach ($upcomingEvents->posts as $event)
      @include('partials.event-list-item', [
          'link' => get_permalink($event->ID),
          'heading' => get_the_title($event->ID) ?: '',
          'date' => get_field('date_of_event', $event->ID),
          'place' => get_field('place', $event->ID),
          'image' => get_field('image_list_view', $event->ID),
          'term' => Events::getTermName($event->ID),
      ])
    @endforeach
  </div>
  <div class="c-grid-bottom">
    <span class="c-grid-bottom__count" style="">
      <span class="count">{{ $upcomingEvents->post_count }}</span> {{ __('of', 'osolo') }} <span
        class="total">{{ $upcomingEvents->found_posts }}</span>
    </span>
    <div class="c-spinner">
      <img src="@asset('images/load.svg')" alt="{{ __('Loading icon', 'osolo') }}">
    </div>

    <button
      class="c-grid-bottom__load-more theme-btn {{ $upcomingEvents->post_count < $upcomingEvents->found_posts ? 'show' : 'hide' }}"
      style="">
      {{ __('More events', 'osolo') }}
    </button>
  </div>
</div>
