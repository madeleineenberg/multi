{{-- /
  Title: __('Puff och formulär', 'osolo')
  Description: __('Två kolumner med puffyta och formulär', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: form formulär puff
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
  / --}}



<div class="c-puff-form-block container-fluid {{ $fade_block ? 'fade-block' : '' }}">
  <div class="row h-100 ">
    <div class="c-puff-form-block__textWrapper col-12 col-md-6 {{ $form_position ? 'left' : 'right' }}">
      @if ($image)
        <div class="c-puff-form-block__image-wrapper">
          {!! wp_get_attachment_image($image['ID'], 'large') !!}
          @if ($heading || $text)
            <div class="c-puff-form-block__textWrapper--text">
              <h2>{{ $heading }}</h2>
              <p class="puff-size">{{ $text }}</p>
            </div>
          @endif
        </div>
      @endif
    </div>

    <div class="c-puff-form-block__form col-12 col-md-6">
      <div class="c-puff-form-block__form-text">
        @if ($form_title)
          <h2 style="{{ $text_color ? 'color: ' . $text_color : '' }}">
            {{ $form_title }}
          </h2>
        @endif

        @if ($form_desc)
          <p style="{{ $text_color ? 'color: ' . $text_color : '' }}">
            {{ $form_desc }}
          </p>
        @endif
      </div>

      @if ($form_id)
        {!! do_shortcode('[ninja_form id="' . $form_id . '"]') !!}
      @endif
    </div>
  </div>
</div>
