// Custom sorting plugin
(function($) {
  $.fn.sorted = function(customOptions) {
    var options = {
      reversed: false,
      by: function(a) { return a.text(); }
    };
    $.extend(options, customOptions);
    $data = $(this);
    arr = $data.get();
    arr.sort(function(a, b) {
      var valA = options.by($(a));
      var valB = options.by($(b));
      if (options.reversed) {
        return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
      } else {		
        return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
      }
    });
    return $(arr);
  };
})(jQuery);

// mainnav magic
function mainmenu(){
$("#nav ul").css({display: "none"}); // Opera Fix
$("#nav>li>a").append('<span class="dot nav"></span>');
$("#nav ul").find('a').append('<span class="dot subnav"></span>');
$("#nav>li>ul").find('ul').prev().append('<span class="more-items"><i class="icon16 icon-arrow-down"></i></span>');
$("#nav li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(0);
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});
}

$.preloadImages = function()
{
   for(var i = 0; i<arguments.length; i++)
   {
        $("<img />").attr("src", arguments[i]);
   }
}

// document ready function
$(document).ready(function() {

	// Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    })

	//******************** Initialize main menu ******************//
	mainmenu();

	
	//******************** Back to top ******************//
	// hide #back-top
	$("#back-top").hide();
	
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

	//******************** Media player ******************//
    $('audio,video').mediaelementplayer();

	//******************** Initialize prettyphoto plugin ******************//
	$(".links a[data-rel^='prettyPhoto']").prettyPhoto ({
		animation_speed:'normal',
		social_tools:false
		/*theme:'facebook'*/
	});

	$(".image a[data-rel^='prettyPhoto']").prettyPhoto ({
		animation_speed:'normal',
		social_tools:false
		/*theme:'facebook'*/
	});

	//******************** Quicksand plugin for portfolio ******************//
	
	var read_button = function(class_names) {
    var r = {
      selected: false,
      type: 0
    };
    
    for (var i=0; i < class_names.length; i++) {
      if (class_names[i].indexOf('selected-') == 0) {
        r.selected = true;
      }
      if (class_names[i].indexOf('segment-') == 0) {
        r.segment = class_names[i].split('-')[1];
      }
    };
    return r;
  };
  
  var determine_sort = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var determine_kind = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var $preferences = {
    duration: 800,
    easing: 'easeInOutQuad',
    adjustHeight: 'dynamic',
  };
  
  var $list = $('#items');
  var $data = $list.clone();
 
  var $controls = $('ul.filter');
  
  $controls.each(function(i) {
    
    var $control = $(this);
    var $buttons = $control.find('a');
    
    $buttons.bind('click', function(e) {
      
      var $button = $(this);
      var $button_container = $button.parent();
      var button_properties = read_button($button_container.attr('class').split(' '));      
      var selected = button_properties.selected;
      var button_segment = button_properties.segment;

      if (!selected) {

        $buttons.parent().removeClass('selected-0').removeClass('selected-1').removeClass('selected-2');
        $button_container.addClass('selected-' + button_segment);
        
        var sorting_type = determine_sort($controls.eq(1).find('a'));
        var sorting_kind = determine_kind($controls.eq(0).find('a'));
        
        if (sorting_kind == 'all') {
          var $filtered_data = $data.find('li');
        } else {
          var $filtered_data = $data.find('li.' + sorting_kind);
        }

        var $sorted_data = $filtered_data.sorted({
	        by: function(v) {
	          return $(v).find('strong').text().toLowerCase();
	        }
	      });

        
        $list.quicksand($sorted_data, $preferences, function(){ 
        	$("a[rel^='prettyPhoto']").prettyPhoto();
        	$('.links').addClass('animated fadeInDown'); 
        	
        });
      }
      
      e.preventDefault();
    });
    
  }); 
	
	//******************** Google maps ******************//
	if ($('#map').length > 0) {
		function start() {
		var myLatlng = new google.maps.LatLng(51.557436,-0.106409);
		var myOptions = {
		  zoom: 17,
		  center:  myLatlng ,
		  mapTypeId: google.maps.MapTypeId.ROADMAP,
		  mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}

		};

		map = new google.maps.Map(document.getElementById("map"), myOptions);

		var marker = new google.maps.Marker({
	        position: myLatlng, 
	        map: map,
	        title:"Location on our office"
    	}); 

	}
	start();
	} 	

	//******************** Form validation plugin ******************//
	// validate the comment form when it is submitted
	$(".form-comment").validate();
	$(".form-contact").validate();

	//******************** Misc ******************//

	// Placeholder 
	$('input , textarea').watermark();
	
	//css animation for links
	$('.links').addClass('animated fadeInDown');

	$('.social-links').addClass('animated fadeInLeft');

	//css animation for headlines
	$('.view-all').addClass('animated fadeInLeftBig');

	//css animation for box icons
	$('.box').hover(function(){
		$(this).find('.center.i').addClass('animated swing');
	},function(){
		$(this).find('.center.i').removeClass('animated swing');
	});

	//css animation for service icons
	$('#services .span3').hover(function(){
		$(this).find('i').addClass('animated swing');
	},function(){
		$(this).find('i').removeClass('animated swing');
	});

	//error page animation
	/*$('#errorPage .center i').addClass('animated pulsar');*/

	// make code pretty
    window.prettyPrint && prettyPrint()

    // add tipsies to grid for scaffolding
    if ($('#grid-system').length) {
      $('#grid-system').tooltip({
          selector: '.show-grid > div'
        , title: function () { return $(this).width() + 'px' }
      })
    }
  	

});