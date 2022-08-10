$(document).ready(function (){
  //$('.accordion-title').attr('tabindex', '0');
  //This is what happens when you click the title on mobile or desktop.
  $('.accordion-title').click(function (){
    $(this).next('.accordion-content').toggleClass('show-me');
    $(this).toggleClass('active');

    if ($('.accordion-title').hasClass('active')) {
      $(this).attr('aria-expanded', 'true');
    } else {
      $('.accordion-title').attr('aria-expanded', 'false');
    }
  });
});
