 jQuery(document).ready(function() {
 "use strict";
 
 // Responsive slider
 
 jQuery(".owl-carousel").owlCarousel({
 
      nav: true, // Show next and prev buttons
      pagination:false,
      slideSpeed : 500,
      paginationSpeed : 400,
  	  items : 1,
  	  autoplay: true,
  	  lazyLoad : true,
      singleItem:true,
      autoHeight:true,
      loop:true
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
  
// Dropdown menu
   
    function thDropdownMenu() {
        var wWidth = jQuery(window).width();
        if(wWidth > 1024) {
            jQuery('.navigation ul.sub-menu, .navigation ul.children').hide();
            var timer;
            var delay = 100;
            jQuery('.navigation li').hover( 
              function() {
                var $this = jQuery(this);
                timer = setTimeout(function() {
                    $this.children('ul.sub-menu, ul.children').slideDown('fast');
                }, delay);
                
              },
              function() {
                jQuery(this).children('ul.sub-menu, ul.children').hide();
                clearTimeout(timer);
              }
            );
            //keynavigation
       jQuery(".menu-item a").focusin(function(){
            jQuery(this).parent().prev().find('.sub-menu').css("display","none");
            jQuery('+ .sub-menu', this).css("display","block");
           });
        } else {
            jQuery('.navigation li').unbind('hover');
            jQuery('.navigation li.active > ul.sub-menu, .navigation li.active > ul.children').show();
        }
    }

    thDropdownMenu();

    jQuery(window).resize(function() {
        thDropdownMenu();
    });

  // Vertical menus toggles

    jQuery('.widget .menu-menu-1-container, .navigation .menu').addClass('toggle-menu');
    jQuery('.toggle-menu ul.sub-menu, .toggle-menu ul.children').addClass('toggle-submenu');
    jQuery('.toggle-menu ul.sub-menu').parent().addClass('toggle-menu-item-parent');

    jQuery('.toggle-menu .toggle-menu-item-parent').prepend('<span class="toggle-caret" tabindex="0"><i class="fa fa-plus"></i></span>');

    jQuery('.toggle-caret').click(function(e) {
        e.preventDefault();
        jQuery(this).parent().toggleClass('active').children('.toggle-submenu').slideToggle('fast');
    });

    //keynavigation keypress
    jQuery('.toggle-caret').keypress(function(e) {
        e.preventDefault();
        jQuery(this).parent().toggleClass('active').children('.toggle-submenu').slideToggle('fast');
    });

    // Esc key close menu
            document.addEventListener( 'keydown', function( event ) {
            if ( event.keyCode === 27 ) {
              event.preventDefault();
              document.querySelectorAll( '.mobile-menu-active' ).forEach( function( element ) {
                jQuery('body').removeClass('mobile-menu-active');
              }.bind( this ) );
              document.querySelectorAll( '.mobile-above-menu-active' ).forEach( function( element ) {
                jQuery('body').removeClass('mobile-above-menu-active');
              }.bind( this ) );
              document.querySelectorAll( '.mobile-bottom-menu-active' ).forEach( function( element ) {
                jQuery('body').removeClass('mobile-bottom-menu-active');
              }.bind( this ) );
            }
          }.bind( this ) );

            //keynavigation close on last item
jQuery(".navigation .menu>.menu-item:nth-last-child(1) a").focusout(function(){
            jQuery('body').removeClass('mobile-menu-active');
           });

// Show-hide Scroll to top & move-to-top arrow

  jQuery("body").prepend("<a id='move-to-top' class='animate ' href='#header'><i class='fa fa-angle-up'></i></a>");
    
  var scrollDes = 'html,body';  
  /*Opera does a strange thing if we use 'html' and 'body' together so my solution is to do the UA sniffing thing*/
  if(navigator.userAgent.match(/opera/i)){
    scrollDes = 'html';
  }
  //show ,hide
  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 160) {
      jQuery('#move-to-top').addClass('filling').removeClass('hiding');
    } else {
      jQuery('#move-to-top').removeClass('filling').addClass('hiding');
    }
  });


// Make all anchor links smooth scrolling & scroll handler

  var scrollToAnchor = function( id, event ) {
    // grab the element to scroll to based on the name
    var elem = jQuery("a[name='"+ id +"']");
    // if that didn't work, look for an element with our ID
    if ( typeof( elem.offset() ) === "undefined" ) {
      elem = jQuery("#"+id);
    }
    // if the destination element exists
    if ( typeof( elem.offset() ) !== "undefined" ) {
      // cancel default event propagation
      event.preventDefault();

      // do the scroll
      var scroll_to = elem.offset().top;
      jQuery('html, body').animate({
              scrollTop: scroll_to
      }, 600, 'swing', function() { if (scroll_to > 46) window.location.hash = id; } );
    }
  };
  // bind to click event
  jQuery("a").click(function( event ) {
    // only do this if it's an anchor link
    var href = jQuery(this).attr("href");
    if ( href && href.match("#") && href !== '#' ) {
      // scroll to the location
      var parts = href.split('#'),
        url = parts[0],
        target = parts[1];
      if ((!url || url == window.location.href.split('#')[0]) && target)
        scrollToAnchor( target, event );
    }
  });
  
// Responsive Navigation

/* <![CDATA[ */
var themehunk_customscript = {"responsive":"1","nav_menu":"secondary"};
/* ]]> */
if (themehunk_customscript.responsive && themehunk_customscript.nav_menu != 'none') {
    jQuery(document).ready(function($){
        // merge if two menus exist
        if (themehunk_customscript.nav_menu == 'both') {
            jQuery('.navigation').not('.mobile-menu-wrapper').find('.menu').clone().appendTo('.mobile-menu-wrapper').hide();
        }
    
        jQuery('.toggle-mobile-menu').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            jQuery('body').toggleClass('mobile-menu-active');
        });
        
        // prevent propagation of scroll event to parent
        jQuery(document).on('DOMMouseScroll mousewheel', '.mobile-menu-wrapper', function(ev) {
            var $this = jQuery(this),
                scrollTop = this.scrollTop,
                scrollHeight = this.scrollHeight,
                height = $this.height(),
                delta = (ev.type == 'DOMMouseScroll' ?
                    ev.originalEvent.detail * -40 :
                    ev.originalEvent.wheelDelta),
                up = delta > 0;
        
            var prevent = function() {
                ev.stopPropagation();
                ev.preventDefault();
                ev.returnValue = false;
                return false;
            }

            if ( jQuery('a#pull').css('display') !== 'none' ) { // if toggle menu button is visible ( small screens )
        
              if (!up && -delta > scrollHeight - height - scrollTop) {
                  // Scrolling down, but this will take us past the bottom.
                  $this.scrollTop(scrollHeight);
                  return prevent();
              } else if (up && delta > scrollTop) {
                  // Scrolling up, but this will take us past the top.
                  $this.scrollTop(0);
                  return prevent();
              }
            }
        });
    }).on('click', function(event) {

        var $target = jQuery(event.target);
        if ( ( $target.hasClass("fa") && $target.parent().hasClass("toggle-caret") ) ||  $target.hasClass("toggle-caret") ) {// allow clicking on menu toggles
            return;
        }

        jQuery('body').removeClass('mobile-menu-active');
    });
}

 // Scroll down header
  function init() {
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 250,
                header = document.querySelector("header");
            if (distanceY > shrinkOn) {
                classie.add(header,"smaller");
                jQuery( ".main-heading" ).addClass( "smaller" );
            } else {
                if (classie.has(header,"smaller")) {
                    classie.remove(header,"smaller");
                    jQuery( ".main-heading" ).removeClass( "smaller" );
                }
            }
        });
    jQuery('iframe').wrap('<div class="video-wrapper" />');
    }
    window.onload = init();

	});

 