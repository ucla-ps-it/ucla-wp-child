$(document).ready(function (){

  let searchButton = document.getElementById('search-button');
  let svgButton = document.getElementById('search-svg');

  searchButton.onclick = function clickSearch (){

    let secondLevelNav = $('li.has-child > ul');

    if ($(this).hasClass('is-active')) {

      $('.search-block-form').removeClass('is-active');
      $(this).removeClass('is-active');
      svgButton.attr('src', '/wp-content/themes/ucla-wp/images/icons/denotive/search--blue.svg');

      // Display other submenus is search menu is not active
      for (let i = 0; i < secondLevelNav.length; i += 1) {
        secondLevelNav[i].style.display = '';
      }


    } else {
      $('.search-block-form').addClass('is-active');
      $(this).addClass('is-active');
      svgButton.attr('src', '/wp-content/themes/ucla-wp/images/icons/denotive/close--white.svg');

      // DO NOT Display other submenus is search menu is not active
      for (let i = 0; i < secondLevelNav.length; i += 1) {
        secondLevelNav[i].style.display = 'none';
      }

    }
  };

});
