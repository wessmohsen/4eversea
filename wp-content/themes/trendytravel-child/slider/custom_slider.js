    jQuery(document).ready(function() {
     
      jQuery("#owl-demo").owlCarousel({	 

		  autoplay:true,
		  autoplayTimeout:4000,
		  autoplayHoverPause:false,
		  nav:true,
     
          items : 1,
		  loop:true,
          itemsDesktop : false,
          itemsDesktopSmall : false,
          itemsTablet: false,
          itemsMobile : false,
      });
	  jQuery('.play').on('click',function(){
			owl.trigger('play.owl.autoplay',[1000])
	  });
		
	  jQuery('.stop').on('click',function(){
			owl.trigger('stop.owl.autoplay')
	  });
     
    });