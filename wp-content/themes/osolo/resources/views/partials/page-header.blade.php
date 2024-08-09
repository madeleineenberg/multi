@php
  $wc_conditional = true;

  if (class_exists('Woocommerce')) {
      $wc_conditional = !is_cart() && !is_checkout() && !is_account_page();
  }
@endphp

@if (!is_front_page() && $wc_conditional)
  <div class="c-page-header container">
    <div class="row justify-content-md-center">
      <div class="c-page-header__content col-12 col-md-8 col-xl-6">
        <h1>{!! $title !!}</h1>
        @if ($preamble)
          <p class="puff-size">{{ $preamble }}</p>
        @endif
        <div class="page-top-section"></div>
      </div>
    </div>
  </div>
@endif
