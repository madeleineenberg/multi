{{-- /
  Title: __('Sammarbetspartners', 'osolo')
  Description: __('Upprepningsfält för sammarbetspartners', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: list partners repeater list sammarbetspartners upprepning
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-partners container">
  <div class="row justify-content-md-center">
    <h2 class="text-center col-sm-12">{{ $heading }}</h2>
    <p class="text-center c-partners__textArea col-12 col-md-8 col-xl-6">{{ $textArea }}</p>

  </div>
  <div class="row justify-content-center">
    @foreach ($partners as $partner)
      <a class="col-4 col-sm-3 col-md-2 c-partners__partner" rel="external nofollow" href="{{ $partner['link']['url'] }}"
        target="_blank">
        <img src="{{ $partner['logo']['url'] }}" alt="{{ $partner['logo']['alt'] }}">
      </a>
    @endforeach
  </div>
</div>
