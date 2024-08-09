<div class="c-event c-list-item c-event-list-item col-12 col-md-6 col-lg-4">
  <a class="c-event__link" href="{{ $link }}">
    <div class="image-holder">
      @if (date('Y-m-d') > $date)
        <span class="completed">{{ __('completed', 'osolo') }}</span>
      @endif
    </div>
    <div class="c-event__event-info event-info">
      <div class="c-event__event-info--date">
        <span class="day sub-label">{{ wp_date('j', strtotime($date), null) }}</span>
        <span class="month sub-label">{{ wp_date('M', strtotime($date), null) }}</span>
      </div>
      <div class="c-event__event-info--info">
        <p class="term sub-label">{{ $term }}</p>
        <p class="place sub-label">Place: {{ $place }}</p>
      </div>
    </div>
    <p class="c-event__title">{{ $heading }}</p>
    <span class="lightblue-border line"></span>
  </a>
</div>
