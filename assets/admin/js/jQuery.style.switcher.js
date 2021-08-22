
(function($) {
"use strict";
  // Theme color settings
  $(document).ready(function(){
    function store(name, val) {
      if (typeof (Storage) !== "undefined") {
        localStorage.setItem(name, val);
      } else {
        window.alert('Please use a modern browser to properly view this template!');
      }
    }
    $("*[data-theme]").on('click', function() {
        e.preventDefault();
          var currentStyle = $(this).attr('data-theme');
          store('theme', currentStyle);
          $('#theme').attr({href: 'css/colors/'+currentStyle+'.css'})
    });

    var currentTheme =  localStorage.getItem('theme');
    // color selector
    $("#imgInp").on('change', function() {
    $('#themecolors').on('click', 'a', function(){
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working')
    });

  });
})(jQuery);