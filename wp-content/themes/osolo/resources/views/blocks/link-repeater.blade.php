{{-- /
  Title: __('Länklista', 'osolo')
  Description: __('Upprepningsfält för länklista', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: list link repeater upprepning lista länkar
  Mode: auto
  Align: center
  PostTypes: page post events news
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-linkRepeater">
  @foreach ($links as $link)
    <a href="{{ $link['link']['url'] }}" target="{{ $link['link']['target'] }}">{{ $link['link']['title'] }}</a>
  @endforeach
</div>
