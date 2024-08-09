@php
  // Get current page URL
  $sb_url = urlencode(get_permalink());

  // Get current page title
  $sb_title = str_replace(' ', '%20', get_the_title());

  // Construct sharing URL without using any script
  $twitterURL = 'https://twitter.com/intent/tweet?text=' . $sb_title . '&amp;url=' . $sb_url . '&amp;via=wpvkp';
  $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $sb_url;
  $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $sb_url . '&amp;title=' . $sb_title;
@endphp

<div class="social-box">
  <p>Share</p>
  <div class="social-btn">
    <a class="col-2 sbtn s-linkedin" href="{{ $linkedInURL }}" rel="external nofollow" target="_blank" rel="nofollow">
      @svg('images.icon_linkedin')
    </a>
    <a class="col-1 sbtn s-twitter" href="{{ $twitterURL }}" rel="external nofollow" target="_blank" rel="nofollow">
      @svg('images.icon_twitter')
    </a>
    <a class="col-1 sbtn s-facebook" href="{{ $facebookURL }}" rel="external nofollow" target="_blank" rel="nofollow">
      @svg('images.icon_facebook')
    </a>
  </div>
</div>
