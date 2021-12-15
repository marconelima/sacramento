$(() => {

     $('.navbar-toggler').on('click', event => {
 
         $('.navbar').toggleClass('sidebar-open');
 
         if ($('.navbar').hasClass('sidebar-open')) {
 
             $('<div class="backdrop"></div>').appendTo('body');
 
         } else {
 
             $('.backdrop').remove();
 
         }
 
         $('.backdrop').on('click', event => {
 
             $('.navbar').removeClass('sidebar-open');
             $(event.target).remove();
 
         });
 
     });
 
 });