(function ($) {
    'use strict';

    $('[data-toggle="offcanvas"]').on("click", function (e) {
        $('.row-offcanvas').toggleClass('active');
    });

   
   $('.mobile-menu-toggle').on("click", function (e) {
        $(this).toggleClass('on');
    });

   //$('.mega-menu .dropdown-title').append('<div class="dropdown-divider"></div>');


    // sticky Transparent Header
    var headerTransparent = $('.header-transparent'); 
    if( headerTransparent.length > 0 ) {

        function stickyHeader() {
            if( $(window).scrollTop() > 100 ) {
                $('.top-header').slideUp();
                headerTransparent.addClass('bg-dark');
            }
            else  {
                $('.top-header').slideDown();
                headerTransparent.removeClass('bg-dark');
            }
        }

        $(window).resize(function() {
            stickyHeader();
        });
        $(window).scroll(function() {       
            stickyHeader();
        });

    }
 // dropdown-toggle class not added for submenus by current WP Bootstrap Navwalker as of November 15, 2017.
// $('.dropdown-menu > .dropdown > a').addClass('dropdown-toggle');



$('.dropdown:not(.mega-menu) .dropdown-menu .dropdown-toggle').on('click', function(e) {
  // if (!$(this).next().hasClass('show')) {
  //   $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  // }
  $(this).next(".dropdown-menu").toggleClass('show');

  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-menu > .dropdown .show').removeClass("show");
  });
  return false;
});

$('.mega-menu .dropdown-menu .dropdown-toggle').on('click', function(e) {
    e.preventDefault();
     return false;
});


    
// $('.site-header').height($('.site-header').outerHeight());


// var HeaderHeight = $('.top-header').outerHeight() + $('.site-header').outerHeight();
// $('.site-body').css({
//     'margin-top': HeaderHeight
// });

    //    $('.navbar-nav').find('li').addClass('nav-item');
    //    $('.navbar-nav > li').find('a').addClass('nav-link');
    // var nav = $('.navbar-nav > li');
    // if( nav.hasClass('mega-menu') ) {
    //     nav.find('ul').removeClass('dropdown-menu').addClass('dropdown-menu');
    //     //$('.mega-menu > .mega').addClass('row');
    // }

        // $('.mega-menu > .dropdown-toggle').on("hover", function () {
        //     $(this).next('ul').css({ 'display': 'none' });
        // },
        //     function () {
        //         $(this).next('ul').css({ 'display': 'flex' });
        //     }
        // );

           // $('.mega-menu').on('hover', function (e) {
           //      //$('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
           //      $(this).find('ul').toggleClass('on');
           //      //$('b', this).toggleClass("caret caret-up");                
           //  },
           //  function() {
           //      //$('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
           //      $(this).find('ul').toggleClass('on');
           //      //$('b', this).toggleClass("caret caret-up");                
           //  });


    // Mega Menu  
    // var media = $(window).width();
    // if (media < 768) {

    //     $('.mobile-menu-toggle').on("click", function (e) {
    //         e.preventDefault();
    //         $(this).toggleClass('on');
    //         $('.menu').toggle(300);

    //     });
    //     $('.megamenu > ul > li:has( > ul)').addClass('mobile-dropdown');

    //     if ($('.megamenu > ul > li').hasClass('mobile-dropdown')) {
    //         $('.mobile-dropdown > a').append('<span class="dropdown-icon"><i class="fas fa-plus"></i></span>');
    //     }

    //     $(".mobile-dropdown").on("click", function (e) {
    //         e.preventDefault();
    //         $(this).find("ul").toggleClass('d-block p-1');
    //         $(this).find('svg').toggleClass('fa-plus fa-minus');
    //     });
    // }
// $('.menu').find('a').addClass('nav-link');

//     // $('.menu-item-has-children a').on('hover', function (e) {
//     //     e.preventDefault();
//     //     $(this).next('ul').toggleClass('on');
//     // });

//            $('.mega-menu').on('hover', function (e) {
//                 $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
//                 $(this).find('ul').toggleClass('on');
//                 $('b', this).toggleClass("caret caret-up");                
//             },
//             function() {
//                 $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
//                 $(this).find('ul').toggleClass('on');
//                 $('b', this).toggleClass("caret caret-up");                
//             });


    // Navbar Search
    $(".megamenu .nav-search").on("click", function (e) {
        e.preventDefault();
        $(".top-search").toggle(300);
        $(this).find('svg').toggleClass('fa-search fa-times');
        setTimeout(function () {
            $('.top-search .form-control').focus();
        }, 20);

    });
    // Bootstrap edit
    $('table').addClass('table table-striped');
    $('blockquote').addClass('blockquote');
    
    // Carousel
    // var headerHeight = $('.top-header').outerHeight() + $('.site-header').outerHeight(),
    //     windowsHeight = $(window).height();
    // // Check if height not changed since the min height is 300px
    // if( $('.carousel-item').height() === 300 ) {
    //     $('.carousel-item').height( (windowsHeight - headerHeight) );
    // }



    // var element  = $('.site-header').height(), 
    //     adminBar = $('#wpadminbar'),
    //     elHeight = ( adminBar.length ) ? adminBar.height() : 0;

    // $('.autoSticky').css({
    //     'top' :  element + elHeight,
    //     'position' : 'sticky',
    //     '-webkit-position' : 'sticky',
    //     'z-index'  : '1021'
    // });
    // 
    // 
    // 
    
    // Auto Sticky elemets plugin
    $.prototype.isStick = function() {
        var header   = $('.site-header').height(),
            adminBar = ( $('.admin-bar').length ) ? 32 : 0;





        //$(this).wrap('<div class="sticky-wrapper"></div>');
        $(this).css({
            'top' : (adminBar + header),
            'position' : 'sticky',
            '-webkit-position' : 'sticky',
            'z-index'  : '1019',
            '-webkit-transition' : 'all .3s ease 0s',
            'transition' : 'all 0.3s'
        });
    };

    //$('.is-sticky').isStick();
    $(window).scroll(function(event) {
        $('.is-sticky').isStick();
    });

    $('article.sticky').addClass('jumbotron');







    // To top
    $(window).on( 'scroll', function() {
        if ($(window).scrollTop() > 600)
            $('.to-top').addClass('in');
        else
            $('.to-top').removeClass('in');
    });
    $('.to-top').on("click", function (e) {
        e.preventDefault();
        $('html, body').animate({ 'scrollTop': 0 }, 1200);
    });



    // $.fn.isCenter = function(parent) {
    //     parent.css({
    //         'height' : $('.featurette-image').height(),
    //         'position' : 'relative'
    //     });
    //     $(this).css({
    //         'position' : 'absolute',
    //         'top' : '50%',
    //         'transform' : 'translateY(-50%)'
    //     });
    // };

    $.fn.isCenter = function (p) {
        p.css({
            'position': 'relative',
            'height': '100vh'
        });
        $(this).css({
            'position': 'absolute',
            'top': (p.height() - this.height()) / 2,
            'left': (p.width() - this.width()) / 2,
        });
    };


    // $('.text-box').isCenter($('.box-center'));


    // Declare Carousel jquery object
    //var owl = $('.owl-carousel');

    // Carousel initialization
    // owl.owlCarousel({
    //     loop:1,
    //     autoplay:1,
    //     autoplayHoverPause:1,
    //     nav:0,
    //     dots:0,
    //     items:1
    // });

    // Add icon to sidebar links
    $('.sidebar-module li > a').prepend('<i class="fas fa-angle-right"></i> ');

    // $('.typewriter').one('webkitAnimationEnd animationend', function() {
    //     $('.typewriter').hide();
    // });

})(jQuery);

