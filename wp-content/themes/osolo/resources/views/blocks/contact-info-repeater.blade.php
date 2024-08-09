{{-- /
  Title: __('Upprepningsfält för kontaktperson eller information', 'osolo')
  Description: __('Använd detta fält för att visa kontaktpersoner eller dela annan information', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: contact info repeater kontakt upprepningsfält
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}


<div class="c-contactInfoRepeater container {{ $fade_block ? 'fade-block' : '' }}">
  <div class="row justify-content-md-center">
    <h2 class="text-center col-sm-12">{{ $heading }}</h2>
  </div>
  <div class="row justify-content-md-center">
    @foreach ($columns as $column)
      <div class="col-12 col-md-6 col-lg-4 c-contactInfoRepeater__column">
        @if ($column['image'])
          <img class="col-img" src="{{ $column['image']['url'] }}" alt="{{ $column['image']['alt'] }}">
        @else
          <img class="col-img" src="@asset('images/defaultperson.png')" alt="default_img">
        @endif
        @if ($column['subtitle'])
          <p class="sub-label">{{ $column['subtitle'] }}</p>
        @endif
        @if ($column['title'])
          <h3>{{ $column['title'] }}</h3>
        @endif
        @if ($column['phone'])
          <a href="tel: {{ $column['phone'] }}" class="phone">{{ $column['phone'] }}</a>
        @endif
        @if ($column['email'])
          <a href="mailto: {{ $column['email'] }}"> {{ $column['email'] }}</a>
        @endif
        @if ($column['linkedin'])
          <a rel="external nofollow" href="{{ $column['linkedin'] }}" target="_blank">
            <img class="svg otheme-logo" src="@asset('images/icon_linkedin.svg')" alt="{{ __('linkedin logo', 'osolo') }}">
          </a>
        @endif
        <span class="lightblue-border line"></span>
      </div>
    @endforeach
  </div>
</div>
