{{-- /
  Title: __('Kolumner', 'osolo')
  Description: __('Block med text och bild i två kolumner', 'osolo')
  Category: formatting
  Icon: columns
  Keywords: text image columns kolumner bild
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-columns container-fluid {{ $fade_block ? 'fade-block' : '' }}">
  <div class="row h-100 justify-content-md-center">
    <div class="col-lg-10 col-12">
      <div class="row">
        <div class="c-columns__column col-lg-6 {{ $columns['center_left_text'] ? 'center' : '' }}">
          {!! $columns['column_left'] !!}
        </div>
        <div class="c-columns__column col-lg-6 {{ $columns['center_right_text'] ? 'center' : '' }}">
          {!! $columns['column_right'] !!}
        </div>
      </div>
    </div>
  </div>
</div>
