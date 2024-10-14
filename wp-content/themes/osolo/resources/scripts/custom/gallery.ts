import { TweenMax } from 'gsap/gsap-core';
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);

export default function () {
  function setImages(images) {
    $images = images;
    detectScroll();
  }

  function detectScroll() {
    $(document).off('wheel');
    setTimeout(function () {
      $(document).on('wheel', function (e) {
        $('.ticker-wrap').addClass('hide');
        const originalEvent = e.originalEvent as WheelEvent | undefined;
        if (originalEvent) {
          if (originalEvent.deltaY < 0) {
            // Scroll up
            if ($images && $container) {
              insertImage($images, $container);
              $count++;
              if ($count === $images.length) {
                $count = 0;
              }
            }
          } else if (originalEvent.deltaY > 0) {
            // Scroll down
            if ($images && $container) {
              insertImage($images, $container);
              $count++;
              if ($count === $images.length) {
                $count = 0;
              }
            }
          }
          $(document).off('wheel', detectScroll);
        }
      });
    }, 100);
  }

  function insertImage(array, container) {
    if (!array || !container) return; // Ensure array and container are defined
    let image = $('<img/>');
    image.attr('class', 'image');
    image.attr('src', array[$count]);

    let randomNumberWidth = Math.floor(Math.random() * 30) + 40;
    let randomNumberHeight = Math.floor(Math.random() * 30) + 40;
    let randomNumberTop = Math.floor(Math.random() * 50) + -5;
    let randomNumberLeft = Math.floor(Math.random() * 70) + -5;

    image.css({
      top: randomNumberTop + '%',
      left: randomNumberLeft + '%',
      maxWidth: randomNumberWidth + '%',
      maxHeight: randomNumberHeight + '%',
    });
    image.appendTo(container);
    // TweenMax.to($('.image'), 10, {
    //   css: { scaleX: 1.1, scaleY: 1.1 },
    // });
    checkImage();
  }

  function checkImage() {
    // check if imagearray is more than 10, then start remove frist image
    let images = $('.image');
    let imageRemove = 0;

    if (images.length > 4) {
      images[imageRemove].remove();
      imageRemove++;
    }
  }

  function wrap(mouseX, mouseY) {
    let images = $('.image').toArray();
    let countImage = 0;

    images.forEach(function (e, index, array) {
      TweenMax.to(array[array.length - (1 + countImage)], 0.3, {
        width: 0,
        top: mouseY,
        left: mouseX,
        delay: countImage / 40,
      });
      setTimeout(function () {
        deleteAllImage(array);
      }, 3000);
      countImage++;
    });
  }

  function deleteAllImage(array) {
    array.forEach(function (e) {
      e.remove();
    });
  }

  gsap.config({
    nullTargetWarn: false,
  });
  let $images;
  let $container = $('.gallery-container');
  let $count = 0;

  const documentWidth = $(document).width();
  if (documentWidth !== undefined && documentWidth > 768) {
    setTimeout(function () {
      const $id = $('.gallery-title').data('id');
      let data = {
        id: $id,
      };

      $.ajax({
        url: '/wp-json/portfolio/gallery',
        data,
        beforeSend: () => {
          console.log('before send:' + data.id);
        },
        success: (response) => {
          if (response && response.images) {
            setImages(response.images);
          }
        },
      });
    }, 100);

    $(document).on('mousedown', function (e) {
      let mouseX = e.pageX;
      let mouseY = e.pageY;
      wrap(mouseX, mouseY);
      $('.ticker-wrap').removeClass('hide');
    });
  }

  // mobile image animation
  const images = gsap.utils.toArray('.img-responsive');

  images.forEach((image, i) => {
    const anim = gsap.fromTo(
      image as gsap.TweenTarget,
      { autoAlpha: 0, y: 100 },
      { duration: 4, autoAlpha: 1, y: 0 },
    );
    ScrollTrigger.create({
      trigger: image as gsap.DOMTarget,
      animation: anim,
      toggleActions: 'play none none none',
      once: true,
    });
  });
}

// import { TweenMax } from 'gsap/gsap-core';
// import gsap from 'gsap';
// import ScrollTrigger from 'gsap/ScrollTrigger';
// gsap.registerPlugin(ScrollTrigger);

// export default function () {
//   function setImages(images) {
//     $images = images;
//     detectMouseMove();
//   }

//   function detectMouseMove() {
//     $(document).off('mousemove');
//     let lastInsertTime = 0;
//     const delay = 500; // 500 milliseconds delay

//     $(document).on('mousemove', function (e) {
//       const currentTime = new Date().getTime();
//       if (currentTime - lastInsertTime >= delay) {
//         $('.ticker-wrap').addClass('hide');
//         if ($images && $container) {
//           insertImage($images, $container, e.pageX, e.pageY);
//           $count++;

//           if ($images && $count === $images.length) {
//             $count = 0;
//           }
//         }
//         lastInsertTime = currentTime;
//       }
//     });
//   }

//   function insertImage(array, container, mouseX, mouseY) {
//     if (!array || !container) return; // Ensure array and container are defined
//     let image = $('<img/>');
//     image.attr('class', 'image');
//     image.attr('src', array[$count]);

//     let randomNumberWidth = Math.floor(Math.random() * 30) + 40;
//     let randomNumberHeight = Math.floor(Math.random() * 30) + 40;

//     image.css({
//       top: mouseY + 'px',
//       left: mouseX + 'px',
//       maxWidth: randomNumberWidth + '%',
//       maxHeight: randomNumberHeight + '%',
//       position: 'absolute',
//     });
//     image.appendTo(container);
//     // TweenMax.to($('.image'), 10, {
//     //   css: { scaleX: 1.1, scaleY: 1.1 },
//     // });
//     checkImage();
//   }

//   function checkImage() {
//     // check if imagearray is more than 10, then start remove frist image
//     let images = $('.image');
//     let imageRemove = 0;

//     if (images.length > 4) {
//       images[imageRemove].remove();
//       imageRemove++;
//     }
//   }

//   function wrap(mouseX, mouseY) {
//     let images = $('.image').toArray();
//     let countImage = 0;

//     images.forEach(function (e, index, array) {
//       TweenMax.to(array[array.length - (1 + countImage)], 0.3, {
//         width: 0,
//         top: mouseY,
//         left: mouseX,
//         delay: countImage / 40,
//       });
//       setTimeout(function () {
//         deleteAllImage(array);
//       }, 3000);
//       countImage++;
//     });
//   }

//   function deleteAllImage(array) {
//     array.forEach(function (e) {
//       e.remove();
//     });
//   }

//   function enlargeImage(image) {
//     // Remove all other images
//     $('.image').not(image).remove();

//     // Get the window dimensions
//     const windowWidth = $(window).width() ?? 0;
//     const windowHeight = $(window).height() ?? 0;

//     // Calculate the center position
//     const centerX = windowWidth / 2;
//     const centerY = windowHeight / 2;

//     // Get the image dimensions
//     const imageWidth = $(image).width() ?? 0;
//     const imageHeight = $(image).height() ?? 0;

//     // Calculate the new position to center the image
//     const newLeft = centerX - imageWidth / 2;
//     const newTop = centerY - imageHeight / 2;

//     // Enlarge the clicked image and center it
//     TweenMax.to(image, 0.5, {
//       scale: 1.5,
//       top: newTop,
//       left: newLeft,
//       ease: 'power2.out',
//     });
//   }

//   gsap.config({
//     nullTargetWarn: false,
//   });
//   let $images;
//   let $container = $('.gallery-container');
//   let $count = 0;

//   const documentWidth = $(document).width();
//   if (documentWidth !== undefined && documentWidth > 768) {
//     setTimeout(function () {
//       const $id = $('.gallery-title').data('id');
//       let data = {
//         id: $id,
//       };

//       $.ajax({
//         url: '/wp-json/portfolio/gallery',
//         data,
//         beforeSend: () => {
//           console.log('before send:' + data.id);
//         },
//         success: (response) => {
//           if (response && response.images) {
//             setImages(response.images);
//           }
//         },
//       });
//     }, 100);

//     $(document).on('mousedown', '.image', function (e) {
//       enlargeImage(this);
//       $('.ticker-wrap').removeClass('hide');
//     });
//   }

//   // mobile image animation
//   const images = gsap.utils.toArray('.img-responsive');

//   images.forEach((image, i) => {
//     const anim = gsap.fromTo(
//       image as gsap.TweenTarget,
//       { autoAlpha: 0, y: 100 },
//       { duration: 4, autoAlpha: 1, y: 0 },
//     );
//     ScrollTrigger.create({
//       trigger: image as gsap.DOMTarget,
//       animation: anim,
//       toggleActions: 'play none none none',
//       once: true,
//     });
//   });
// }
