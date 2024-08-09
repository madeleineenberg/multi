export default function () {
  const $block = $('.c-archive');
  const $list = $('.c-archive__grid');
  const $loadBtn = $('.c-grid-bottom__load-more');
  const $spinner = $('.c-spinner');
  const $count = $('.c-grid-bottom__count');
  const posts_per_page = 6;
  const post_type = $('.c-archive').data('cpt');
  let count = $list.find('.c-list-item').length;

  $('.c-filter-links .c-filter-dropdown .placeholder-text').on('click', (e) => {
    $(e.target).closest('p').toggleClass('open');
    $(e.target).closest('p').next().slideToggle();
  });

  if ($block.length === 0) {
    return;
  }

  $('.c-filterArea .c-filter-dropdown .placeholder-text').on('click', (e) => {
    $(e.target).closest('p').toggleClass('open');
    $(e.target).closest('p').next().toggleClass('open');
  });

  /**
   * On filter button press
   */
  $('.c-filters__filter').on('click', (e) => {
    const $filter = $(e.target).closest('li');

    $(e.target).closest('.c-filters').find('li').removeClass('active');

    if ($filter.data('text') !== undefined) {
      $(`.c-filters__filter[data-text="${$filter.data('text')}"]`)
        .closest('.c-filters')
        .find('li')
        .removeClass('active');
      $(`.c-filters__filter[data-text="${$filter.data('text')}"]`).addClass(
        'active',
      );
    } else {
      $filter.addClass('active');
    }

    $('.c-filter-dropdown .placeholder-text').removeClass('open');
    $('.c-filter-dropdown__dropdown').removeClass('open');

    filter();
  });

  /**
   * On "load more" button press
   */
  $('.c-archive .c-grid-bottom__load-more').on('click', () => {
    const offset = count;

    filter({ offset });
  });

  function filter(object = {}) {
    type data = {
      [key: string]: any;
      post_type: string;
      posts_per_page: number;
    };

    let data: data = {
      ...object,
      post_type,
      posts_per_page,
    };

    $('.c-filters__filter').each(function (i, element) {
      const $filter = $(element).closest('li');

      if ($filter.hasClass('active')) {
        if ($filter.data('text') !== undefined) {
          data.terms = $filter.data('text');
          if ($filter.data('text')) {
            $('.c-filter-dropdown.filterType .placeholder-text span').text(
              $filter.text(),
            );
          } else {
            $('.c-filter-dropdown.filterType .placeholder-text span').text(
              'Select type',
            );
          }
          urlHandler($filter.data('text'), 'type');
        }

        if ($filter.data('status') !== undefined) {
          data.status = $filter.data('status');
          urlHandler(
            $filter.data('status') === 'completed-events'
              ? 'completed-events'
              : 'upcoming-events',
            'status',
          );
        }

        if ($filter.data('value') !== undefined) {
          data.year = $filter.data('value');

          if ($filter.data('value')) {
            $('.c-filter-dropdown.filterYear .placeholder-text span').text(
              $filter.text(),
            );
          } else {
            $('.c-filter-dropdown.filterYear .placeholder-text span').text(
              'Select year',
            );
          }
          urlHandler($filter.data('value'), 'published-year');
        }
      }
    });

    $.ajax({
      url: '/wp-json/otheme/filter',
      data,
      beforeSend: () => {
        $loadBtn.hide();
        $count.hide();
        $spinner.addClass('c-spinner--show');
      },
      success: (response) => {
        $spinner.removeClass('c-spinner--show');
        $loadBtn.show();
        $count.show();

        if (!data.offset) {
          count = response.post_count;
          $list.html(response.html);
        } else {
          count += response.post_count;
          $list.append(response.html);
        }

        $block.find('.count').text(count);
        $block.find('.total').text(response.found_posts);

        if (count >= response.found_posts) {
          $loadBtn.hide();
        }
      },
    });
  }

  function urlHandler(value, queryString) {
    const urlParams = new URLSearchParams(window.location.search);

    if (value) {
      urlParams.set(queryString, value);
    } else {
      urlParams.delete(queryString);
    }

    const url = urlParams.toString();
    history.replaceState({}, '', '?' + url);
  }
}
