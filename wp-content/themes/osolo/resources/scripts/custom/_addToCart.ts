const localize = (window as any).localize;

export default function () {
  $('body').on('added_to_cart', () => {
    $.ajax({
      url: '/wp-json/otheme/cart',
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-WP-Nonce', localize.nonce);
      },
      success: (response) => {
        $('.cart-count').text(response);
      },
    });
  });
}
