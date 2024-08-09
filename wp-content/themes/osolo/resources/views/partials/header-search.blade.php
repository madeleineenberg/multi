   <form action="/" method="GET">
     <label>
       @svg('images.icon_search')
       <input autocomplete="off" name="s" placeholder="{{ __('Sök på webbplatsen', 'osolo') }}"
         value="{{ get_search_query() }}" type="text">
     </label>
   </form>
