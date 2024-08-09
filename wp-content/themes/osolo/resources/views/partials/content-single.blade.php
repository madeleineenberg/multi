<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title">
      {!! $title !!}
    </h1>
    @php the_excerpt() @endphp
  </header>

  <div class="entry-content">
    @php the_content() @endphp
  </div>

</article>
