import '@wordpress/edit-post';
import domReady from '@wordpress/dom-ready';

domReady(() => {
  (window as any).acf.add_filter('color_picker_args', function (args, $field) {
    args.palettes = [
      '#003641',
      '#29b8ce',
      '#0d0d0d',
      '#fff',
      '#f6f6f6',
      '#ec4b4a',
      '#eca4a0',
      '#fae3e0',
      '#569258',
      '#a8c4a7',
      '#e1efe3',
      '#7b5487',
      '#bcaac5',
      '#e9e5ec',
      '#eead4c',
      '#f4d2a5',
      '#fcf3e0',
      '#f59d3b',
      '#d9e7e3',
      '#156772',
    ];

    return args;
  });
});
