// =================================================
// TABLE OF CONTENTS: Functions
// =================================================

// (0.0) General Variable and Functions
// ------------------------------------------- * * *
// (1) Commonly Used IDs
// (2) Add classes to Navigation items
// (3) Hamburger click Functionality

// (1.0) Desktop Functionality
// ------------------------------------------- * * *
// (1.1) Variables
// (1.2) Listeners and Keystroke Events

// (2.0) Mobile Functionality
// ------------------------------------------- * * *
// (2.1) Variables
// (2.2) Event Listeners
// (2.3) Keystroke Events

// (3.0) Select Functionality
// ------------------------------------------- * * *
// (3.1) Pick Menu
//

$(document).ready(function (){

  /*==================================================================
	0.0 General functions and variables
	================================================================= */

  // ad ID attribut to primary nav search form
  $('.search-form').attr('id', 'menu-search');
  $('#menu-main-menu > li > a:first').attr('id', 'first-nav-link');
  // Commonly used IDs
  let hamButton = document.getElementById('primary-ham');
  let priNav = document.getElementById('menu');
  let searchForm = document.getElementById('menu-search');
  let searchButDesk = document.getElementById('search-button');
  let header = document.getElementById('header');
  let secondNav = document.getElementById('second-nav');
  let childButtons = document.getElementsByClassName('has-child--button');
  let i;

  // close all menus when escape is pressed



  // Primary Navigation Hamburger click functionality
  hamButton.onclick = function hamClick () {
    hamButton.classList.toggle('is-active');

    if (hamButton.classList.contains('is-active')) {
      hamButton.setAttribute('aria-expanded', 'true');
      priNav.classList.add('is-active');
      header.classList.add('is-active');
      $(hamButton).attr('aria-label', 'Close mobile menu');
    } else {
      hamButton.setAttribute('aria-expanded', 'false');
      priNav.classList.remove('is-active');
      header.classList.remove('is-active');
      $(hamButton).attr('aria-label', 'Open mobile menu');
    }
  };

  $('#menu .menu-item-has-children').children('a').addClass('menu-item-has-children--link');
  $('a.menu-item-has-children--link').after('<button class="has-child--button"><svg role="img" aria-label="Down Arrow" class="down-arrow" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>Down Arrow</title><g class="Icon/Arrow-Down" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon class="Path-2" points="0 0 24 0 24 24 0 24"></polygon><polygon class="Path-polygon" fill="#00598C" points="7.41 8.59 12 13.17 16.59 8.59 18 10 12 16 6 10"></polygon></g></svg></button>');
  $('.form-search').attr('placeholder', 'Search');

  /* Select the size on load or reset the size of the submenu for desktop only. Resize the submenu when
	================================================================= */
  function desktopSubmenuResize () {
    let w = $('.ucla.campus.header').width() - 48,
      negOffset = (w + 10) * -1;

    //Add the width off the header wrap to the search dropdown
    $('.search-block-form').css({ // <a class="has-child--link">
      'width': w,
      'margin-left': negOffset
    });
    // console.log(w); // For Debuggin' Only
  }

  /*==================================================================
	1.0 Desktop Functionality
	================================================================= */
  function desktopMenu () {
    //load desktop nav functionality

    // let desktop = 1024; // For Debuggin' Only
    // console.log(desktop); // For Debuggin' Only
    // console.log('desktop'); // For Debuggin' Only

    desktopSubmenuResize();

    // Disable Click functionality for mobile nav submenu.
    $('.has-child--button').attr('tabindex', '-1');

    // Put the search form at the end of the nav
    $('#block-search').append(searchForm);

    $('#entity-wrap').append(secondNav);

    $('a.current-page').next('.has-child--button').addClass('current-page');

    $(document).keyup(function (e) {
      if (e.key === 'Escape') { // escape key maps to keycode `27`
        // if desktop sub menu is focus then unfocus and remove styles
        if ($('#menu-main-menu ul li a').is(':focus')) {
          document.activeElement.blur();
          $('.sub-menu').removeAttr('style');
          $('.menu-item-has-children--link').removeAttr('style');
          $('.menu-item').removeAttr('style');
          $('.has-child--button').removeAttr('style');
          $('.has-child--button').find('svg > g > .Path-polygon').attr('fill', '#00598C');
          // else if the mobile menu is open close it, focus on the hamburger and allow scrolling again.
        } else if (searchButDesk.classList.contains('is-active')) {
          $('#search-button').trigger('click');
          $('#search-button').focus();
        }
      }
    });

    // Desktop Menu keyboard functionality
    document.onkeydown = function () {

      let element = document.activeElement;
      /*eslint-disable */
      var evt = evt || window.event;
      /*eslint-enable */

      if ($('.menu-item-has-children--link').is(':focus')) {

        $(element).siblings('ul').css('display', 'block');

        if (evt.keyCode === 9 && event.shiftKey) {
          setTimeout(function () {
            $(element).siblings('ul').css('display', '');
          }, 100);
        } else if (evt.keyCode === 9) {
          // add styles to top level nav when sublevel is focused
          $(element).parent().css('background', '#0079BF'); // <li class="menu-item-has-children--link">
          $(element).css({ // <a>
            'border-bottom': '0',
            'color': '#fff'
          });
          $(element).next('button').css({ // <a class="has-child--link">
            'border-bottom': '0',
            'background': '#0079BF'
          });
          $(element).next('button').find('svg > g > .Path-polygon').attr('fill', '#fff'); // dropdown svg
        }

      } else if ($('li.menu-item-has-children > ul > li:first-of-type > a').is(':focus')) {

        if (evt.keyCode === 9 && event.shiftKey) {

          setTimeout(function () {
            // Remove styles to top level nav when sublevel is focused
            $(element).parent().parent().parent().removeAttr('style'); // <li class="has-child">
            $(element).parent().parent().prev().prev('a').removeAttr('style'); // <a class="has-child--link">
            $(element).parent().parent().prev().removeAttr('style'); // <a class="has-child--link">
            $(element).parent().parent().prev().find('svg > g > .Path-polygon').attr('fill', '#0079BF'); // dropdown svg
          }, 100);

        } else if (evt.keyCode === 9 && $('li.menu-item-has-children > ul > li:first-of-type > a').is(':focus') && $('li.menu-item-has-children > ul > li:last-of-type > a').is(':focus')) {
          console.log('whatup');
          $(element).parent().parent().removeAttr('style'); // <ul>
          // Remove styles to top level nav when sublevel is focused
          $(element).parent().parent().parent().removeAttr('style'); // <li class="has-child">
          $(element).parent().parent().prev().prev().removeAttr('style'); // <a class="has-child--link">
          $(element).parent().parent().prev().removeAttr('style'); // <a class="has-child--link">
          $(element).parent().parent().prev().find('svg > g > .Path-polygon').attr('fill', '#0079BF'); // dropdown svg
        }

      } else if ($('li.menu-item-has-children > ul > li:last-of-type > a').is(':focus')) {

        if (evt.keyCode === 9 && event.shiftKey) {
          // do nothing
        } else if (evt.keyCode === 9) {

          $(element).parent().parent().removeAttr('style'); // <ul>
          // Remove styles to top level nav when sublevel is focused
          $(element).parent().parent().parent().removeAttr('style'); // <li class="has-child">
          $(element).parent().parent().prev().prev().removeAttr('style'); // <a class="has-child--link">
          $(element).parent().parent().prev().removeAttr('style'); // <a class="has-child--link">
          $(element).parent().parent().prev().find('svg > g > .Path-polygon').attr('fill', '#0079BF'); // dropdown svg

        }
      }


    };

  }


  /*==================================================================
	2.0 Mobile Functionality
	================================================================= */
  function mobileMenu () {

    // let desktop = 1024; // For Debuggin' Only
    // console.log('mobile'); // For Debuggin' Only
    // console.log(desktop); // For Debuggin' Only

    // Put the search form at the beginning of the nav
    $('nav#menu').prepend(searchForm);

    // Put the header buttons at the end of the nav
    $('ul#menu-main-menu').append(secondNav);

    /* Disable Mobile scroll when menu is open CSS for no-scroll in stylesheet*/
    $('#primary-ham').on('click', scrollDisable);

    function scrollDisable () {
      if (hamButton.classList.contains('is-active')) {
        $('body').removeClass('no-scroll');
      } else {
        $('body').addClass('no-scroll');
      }
    }

    // Click functionality for mobile nav submenu buttons.
    $(document).on('click', '.has-child--button', function () {
      event.preventDefault();
      let elem = $(this);
      if (elem.next('ul').hasClass('is-active')) {
        setTimeout(function () {
          elem.removeClass('is-active');
          elem.next('ul').removeClass('is-active');
        }, 10);
        //console.log('menu closed'); // For Debuggin' Only
      } else {
        setTimeout(function () {
          elem.addClass('is-active');
          elem.next('ul').addClass('is-active');
        }, 10);
        //console.log('menu open'); // For Debuggin' Only
      }

    });

    $(document).keyup(function (e) {
      if (e.key === 'Escape') { // escape key maps to keycode `27`
        let found = false;
        // Check each submenu individually to see if any are open
        for (i = 0; i < childButtons.length; i++) {
          if (childButtons[i].classList.contains('is-active')) {
            // if open menus are found close them
            $('.sub-menu').removeClass('is-active');
            $('.has-child--button').removeClass('is-active');
            // Reset the found variable
            found = true;
            // stop what is happening, do not close the entire menu
            break;
          }
        }
        // if submenu is not open close entire menu
        if (!found && hamButton.classList.contains('is-active')){
          $('#primary-ham').trigger('click');
          $('#primary-ham').focus();
          $('body').removeClass('no-scroll');
        }
      }
    });

    // Enable Click functionality for mobile nav submenu.
    $('.has-child--button').removeAttr('tabindex');

    document.onkeydown = function (evt) {

      let element = document.activeElement;
      /*eslint-disable */
      var evt = evt || window.event;

      //console.log(element); // debuggin' only

      /*eslint-enable */

      // Start with skip Navigation at the top of the page
      if ($('#skip-to-nav').is(':focus')) {
        if (evt.keyCode === 13) {
          if ($('#primary-ham').hasClass('is-active')) {
            // do nothing
            // console.log('Menu is already open.');
          } else {
            $('#primary-ham').trigger('click');
          }

        }

      } else if ($('#entity-name').is(':focus') && !$('.hamburger.hamburger--squeeze').hasClass('is-active')) {

        $('#primary-ham').trigger('click');

      } else if ($('.hamburger.hamburger--squeeze').is(':focus')) {

        if (evt.keyCode === 9 && event.shiftKey) {

          if ($('.hamburger.hamburger--squeeze').hasClass('is-active')) {
            setTimeout(function () {
              $('#primary-ham').trigger('click');
              $('body').removeClass('no-scroll');
            }, 100);

          }

        } else if (evt.keyCode === 9) {

          if ($('.hamburger.hamburger--squeeze').hasClass('is-active')) {
            // do nothing
          } else {

            event.preventDefault();
            setTimeout(function () {
              $('#content').find('a:first').focus();
            }, 100);
          }

        }

      } else if ($('li.menu-item-has-children > a').is(':focus')) {

        $(element).siblings('ul').removeAttr('style');

      } else if ($('.menu-main-menu-container > ul > li:last-of-type > a.menu-item-has-children--link:last-of-type').is(':focus')) {

        if (evt.keyCode === 9) {
          setTimeout(function () {
            $(element).next('button').focus();
          }, 100);
        }

      // If you're focused on the last link in the main menu
      } else if ($('#second-nav> a:last-of-type').is(':focus')) {

        if (evt.keyCode === 9 && event.shiftKey) {
          // Do nothing

        } else if (evt.keyCode === 9) {
          event.preventDefault();
          setTimeout(function () {
            $('#primary-ham').trigger('click');
            $('#content').find('a:first').focus();
            $('body').removeClass('no-scroll');
          }, 100);
        }

      } else if ($('#content a:first').is(':focus') && !hamButton.classList.contains('is-active')) {
        if (evt.keyCode === 9 && event.shiftKey) {
          event.preventDefault();
          setTimeout(function () {
            $('#primary-ham').trigger('click');
            $('html, body').animate({ scrollTop: 0 }, 10);
            $('#second-nav').find('a:last-of-type').focus();
            $('body').addClass('no-scroll');
          }, 100);
        }
      }
    };

  }

  /* Everything above this paragraph breaks down the functionality of the menu into two categories, desktop and mobile. Everything below this paragrapgh define which functionality to run based on the users screen size.  */

  /*==================================================================
	3.0 Select FUNCTIONALITY
	================================================================= */

  function pickMenu () {
    let desktop = 1024;

    // For Debuggin' Only
    //console.log('i picked a menu');

    // This decides if the window is at dekstop size or not.
    if (window.innerWidth >= desktop) {

      // Reset or remove any menu classes
      $('.has-child--button, #menu, .hamburger, .header, .sub-menu').removeClass('is-active');
      $('body').removeClass('no-scroll');

      // Get and Run the dektop functionality
      desktopMenu();
      //console.log('i picked the desktop menu');

    // This decides if the window is at mobile size or not.
    } else if (window.innerWidth < desktop){

      // Reset or remove any menu classes

      // Get and Run the mobile menu functionality
      mobileMenu();
      //console.log('i picked the mobile menu');

    }
  }

  pickMenu();

  /*	Select which menu version to run (Desktop VS. Mobile) WHEN BROWSER RESIZES WITHOUT RELOADING
	================================================================= */
  let isSmall = false;
  $(window).resize(function () {

    //Pick menu only happens when you resize past the large breakpoint
    if ((window.innerWidth < 1024 && !isSmall) || (window.innerWidth >= 1024 && isSmall)) {

      isSmall = !isSmall;

      setTimeout(function () {
        pickMenu($);
      }, 10);
    }

    //Resize the submenu on all resizes above 1024px.
    if (window.innerWidth >= 1024) {
      desktopSubmenuResize();
    }

  });


});
