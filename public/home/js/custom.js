jQuery(document).ready(function() {
    "use strict";


/* ==================================================================
                PRELOADER
================================================================== */
// makes sure the whole site is loaded
jQuery(window).load(function() {
        // will first fade out the loading animation
    jQuery(".status").fadeOut();
        // will fade out the whole DIV that covers the website.
    jQuery(".preloader").delay(1000).fadeOut("slow");
});


/* ==================================================================
				Change the menu height on scroll
================================================================== */
	$(window).on('ready , scroll', function() {
	    if ($(window).scrollTop() > 30) {
	        $('.arvin-main-menu').addClass('minified');
	    } else {
	        $('.arvin-main-menu').removeClass('minified');
	    }
	});

/* ==================================================================
				hide menu on click
================================================================== */
  jQuery(".nav a").on("click", function () {
      jQuery("#nav-menu").removeClass("in").addClass("collapse");
  });

/* ==================================================================
				One Page Nav Settings
================================================================== */
	$('#nav-menu').onePageNav({
	    currentClass: 'active',
	    scrollSpeed: 500,
	    easing: 'linear'
	});

/* ==================================================================
					WoW Js
================================================================== */
var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       250,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    }
  }
);
wow.init();

/* ==================================================================
                		Counter
================================================================== */

$('.arvin-counter-section').waypoint(function(direction) {
	$('.arvin-counter').countTo({
        speed: 3000
    });
}, {
	offset: 800,
	triggerOnce: true
});


/* ==================================================================
                		Easy Pie Chart
================================================================== */
$('.arvin-skills-wrapper').waypoint(function(direction) {
    $('.chart').easyPieChart({
        barColor: '#fb724e',
        trackColor: '#dadada',
        scaleColor: false,
        easing: 'ease',
        lineCap: 'butt',
        lineWidth: 20,
        size: 200,
        animate: 1000,
        onStep: function(from, to, percent) {
			this.el.children[0].innerHTML = Math.round(percent);
		}
    });
}, {
	offset: 400
});

/* ==================================================================
                SCROLL UP Settings
================================================================== */
	$.scrollUp({
		scrollName: 'scrollUp', // Element ID
		scrollDistance: 300, // Distance from top/bottom before showing element (px)
		scrollFrom: 'top', // 'top' or 'bottom'
		scrollSpeed: 5000, // Speed back to top (ms)
		easingType: 'linear', // Scroll to top easing (see http://easings.net/)
		animation: 'fade', // Fade, slide, none
		animationInSpeed: 200, // Animation in speed (ms)
		animationOutSpeed: 200, // Animation out speed (ms)
		scrollText: 'Scroll to top', // Text for element, can contain HTML
		scrollTitle: false, // Set a custom <a> title if required. Defaults to scrollText
		scrollImg: true, // Set true to use image
		activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		zIndex: 2147483647 // Z-Index for the overlay
	});

/* ==================================================================
                			Lightbox
================================================================== */
	$('.arvin-featured-work-img').magnificPopup({
	  type: 'image',
	  gallery:{
	    enabled:true
	  }
	});

	$('.flickr-gallery-img').magnificPopup({
	  type: 'image',
	  gallery:{
	    enabled:true
	  }
	});


/********************************************************************
                		Carousals/Sliders
********************************************************************/
	// Team Slider
	$("#team-slider").owlCarousel({
		items : 2,
		itemsDesktop: [1199,2],
		itemsDesktopSmall: [979,2],
		itemsTablet: [768,2],
		itemsMobile : [520,1],
		autoPlay: 4000,
		navigation : false
	});

	// Feature Works
	$("#featured-work-slider").owlCarousel({
		items : 4,
		itemsDesktop: [1199,3],
		itemsTablet: [860,2],
		itemsMobile : [480,1],
		autoPlay: 4000,
		navigation : false
	});

	// Related Works
	$("#related-works-slider").owlCarousel({
		items : 4,
		itemsDesktop: [1199,3],
		itemsTablet: [860,2],
		itemsMobile : [480,1],
		autoPlay: 4000,
		navigation : false
	});

	// Feature Works
	$("#arvin-testimonial").owlCarousel({
		items : 1,
		itemsDesktop: [1199,1],
		itemsDesktopSmall: [979,1],
		itemsTablet: [768,1],
		itemsMobile : [520,1],
		autoPlay: 5000
	});

	// Client Logo
	$("#clients-logo-carousal").owlCarousel({
		items : 5,
		itemsDesktop: [1199,4],
		itemsDesktopSmall: [979,4],
		itemsTablet: [768,3],
		itemsMobile : [520,1],
		autoPlay: 3500,
		navigation : false,
		pagination: false
	});

	// Blog Section Carousal
	$("#arvin-blog-carousal").owlCarousel({
		items : 3,
		itemsDesktop: [1199,2],
		itemsDesktopSmall: [979,2],
		itemsTablet: [768,2],
		itemsMobile : [520,1],
		autoPlay: 4000,
		navigation : false,
		pagination: false
	});

	// Gallery Blog Post
	$(".arvin-gallery-carousal").owlCarousel({
		items : 1,
		itemsDesktop: [1050,1],
		itemsDesktopSmall: [979,1],
		itemsTablet: [768,1],
		itemsMobile : [520,1],
		autoPlay: 4000,
		navigation : true,
		navigationText: ["",""],
		pagination: false
	});


/* ==================================================================
                		stellar
================================================================== */
$(window).stellar({
	responsive: true,
    positionProperty: 'position'
});


/* ==================================================================
                		ISoptope
================================================================== */
  var $container = $('.arvin-portfolio-items');

  // filter items on button click
   $container.isotope({
          filter: '*',
          itemSelector: '.item',
          animationOptions: {
              duration: 750,
              easing: 'linear',
              queue: false
          }
      });


  $('#arvin-portfolio-filter ul li a').on('click',function(){
      var selector = $(this).attr('data-filter');
      $container.isotope({
          filter: selector,
          animationOptions: {
              duration: 750,
              easing: 'linear',
              queue: false
          }
      });
    return false;
  });

  var $optionSets = $('#arvin-portfolio-filter ul'),
         $optionLinks = $optionSets.find('a');

         $optionLinks.on('click',function(){
            var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
            return false;
        }
     var $optionSet = $this.parents('#arvin-portfolio-filter ul');
     $optionSet.find('.selected').removeClass('selected');
     $this.addClass('selected');
  });

/* ==================================================================
                      Blog Post Masonry
================================================================== */
    var $blogContainer = $('#arvin-masonry-blog');

    $blogContainer.imagesLoaded(function(){
	    $blogContainer.isotope({
	        itemSelector : '.arvin-blog-items',
	        masonry: {
			    columnWidth: '.arvin-masonry-blog-content-wrapper .arvin-blog-items',
			    gutter:0
			  }
	    });
    });

/* ==================================================================
                			FitVids
================================================================== */
$(".arvin-video-post .arvin-blog-img").fitVids();
$(".arvin-single-video-post .arvin-single-post-top-wrapper").fitVids();

/* ==================================================================
                			Audio Player
================================================================== */
$('audio').mediaelementplayer({
	audioWidth: '100%',

});


/* ==================================================================
                		Flickr Feed
================================================================== */
$('#flickr-gallery').jflickrfeed({
	limit: 8,
	qstrings: {
		id: '35653055@N04'   /* Add your Flickr ID here. You can find your flickr id from http://idgettr.com/ */
	},
	itemTemplate:
	'<li>' +
		'<a class="flickr-gallery-img" href="{{image}}" title="{{title}}">' +
			'<img src="{{image_s}}" alt="{{title}}" />' +
		'</a>' +
	'</li>'
}, function(data) {
	$('.flickr-gallery-img').magnificPopup({
		type: 'image',
		  gallery:{
		    enabled:true
		  }
	});
});


/* ==================================================================
                		Homepage Slider
================================================================== */
$( '#index' ).sliderPro({
	width: '100%',
    height: 768,
    fade: true,
    arrows: true,
    waitForLayers: true,
    buttons: true,
    autoplay: true,
    autoScaleLayers: false,
    imageScaleMode: 'cover',
    slideAnimationDuration: 1500,
    loop: true,		//Change it to false if you used only 2 slides in homepage slider
    breakpoints: {
        600: {
            height: 480
        }
	}
});

/* ==================================================================
                		Contact Form
================================================================== */

	$("#submit-btn").on('click',function() {
	    var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields
		$("#contact-form input[required=true], #contact-form textarea[required=true]").each(function(){
			$(this).css('border-color','');
			if(!$.trim($(this).val())){ //if this field is empty
				$(this).css('border-color','red'); //change border color to red
				proceed = false; //set do not proceed flag
			}
			//check invalid email
			var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
				$(this).css('border-color','red'); //change border color to red
				proceed = false; //set do not proceed flag
			}
		});

        if(proceed) //everything looks good! proceed...
        {
			//get input field values data to be sent to server
            var post_data = {
				'name'		: $('input[name=name]').val(),
				'email'	: $('input[name=email]').val(),
				'message'		: $('textarea[name=message]').val(),
				'_token': $('#token').val()
			};
            var output = '';
            //Ajax post data to server
            $.post('/contact', post_data, function(response){
				if(response.type == 'error'){ //load json data from server and output message
					output = '<div class="error">'+response.text+'</div>';
				}else{
				    output = '<div class="success">'+response.text+'</div>';
					//reset values in all input fields
					$("#contact-form  input[required=true], #contact-form textarea[required=true]").val('');
					//$("#contact-form").slideUp(); //hide form after success
				}
				$("#contact-result").hide().html(output).slideDown();
            }, 'json');
        }else{
			$("#contact-result").hide().html('<div class="error">All fields are Required.</div>').slideDown();
		}
    });

    //reset previously set border colors and hide all message on .keyup()
    $("#contact-form  input[required=true], #contact-form textarea[required=true]").keyup(function() {
        $(this).css('border-color','');
        $("#contact-result").slideUp();
    });


});

