$(document).ready(function(){

    //Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

    $('.spoiler-content').css({'display':'none'});

});

(function($) {
	"use strict"

	// Fixed Nav
	var lastScrollTop = 0;
	$(window).on('scroll', function() {
		var wScroll = $(this).scrollTop();
		if ( wScroll > $('#nav').height() ) {
			if ( wScroll < lastScrollTop ) {
				$('#nav-fixed').removeClass('slide-up').addClass('slide-down');
			} else {
				$('#nav-fixed').removeClass('slide-down').addClass('slide-up');
			}
		}
		lastScrollTop = wScroll
	});

	// Search Nav
	$('.search-btn').on('click', function () {
		$('.search-form').addClass('active');
	});

	$('.search-close').on('click', function () {
		$('.search-form').removeClass('active');
	});

	// Aside Nav
	$(document).click(function(event) {
		if (!$(event.target).closest($('#nav-aside')).length) {
			if ( $('#nav-aside').hasClass('active') ) {
				$('#nav-aside').removeClass('active');
				$('#nav').removeClass('shadow-active');
			} else {
				if ($(event.target).closest('.aside-btn').length) {
					$('#nav-aside').addClass('active');
					$('#nav').addClass('shadow-active');
				}
			}
		}
	});

	$('.nav-aside-close').on('click', function () {
		$('#nav-aside').removeClass('active');
		$('#nav').removeClass('shadow-active');
	});

	// Sticky Shares
	var $shares = $('.sticky-container .sticky-shares'),
	$sharesHeight = $shares.height(),
	$sharesTop,
	$sharesCon = $('.sticky-container'),
	$sharesConTop,
	$sharesConleft,
	$sharesConHeight,
	$sharesConBottom,
	$offsetTop = 80;

	function setStickyPos () {
		if ($shares.length > 0) {
			$sharesTop = $shares.offset().top
			$sharesConTop = $sharesCon.offset().top;
			$sharesConleft = $sharesCon.offset().left;
			$sharesConHeight = $sharesCon.height();
			$sharesConBottom = $sharesConHeight + $sharesConTop;
		}
	}

	function stickyShares (wScroll) {
		if ($shares.length > 0) {
			if ( $sharesConBottom - $sharesHeight - $offsetTop < wScroll ) {
				$shares.css({ position: 'absolute', top: $sharesConHeight - $sharesHeight , left:0});
			} else if ( $sharesTop < wScroll + $offsetTop ) {
				$shares.css({ position: 'fixed', top: $offsetTop, left: $sharesConleft });
			} else {
				$shares.css({position: 'absolute', top: 0, left: 0});
			}
		}
	}

	$(window).on('scroll', function() {
		stickyShares($(this).scrollTop());
	});

	$(window).resize(function() {
		setStickyPos();
		stickyShares($(this).scrollTop());
	});

	setStickyPos();

})(jQuery);


function getRelative(postID, catID) {
	$('.post-content > p:first-child').append('<div class="relate-post"><p class="relate-title">Bài viết liên quan</p><ul class="list-relate"></ul></div>');
	$.get(
		'/post/get-relate-post',
		{ postID : postID, catID : catID },
		function(data) {
			var str = "";
			data.forEach(function(obj) {
				str += '<li>';
				str += '<a href="';
				str += window.location.origin;
				str += '/post/';
				str += obj.id;
				str += '/';
				str += obj.post_slug;
				str += '" target="_blank">'
				str += obj.post_name;
				str += '</a>'
				str += '</li>';
			});
			$('.list-relate').html(str);
		}
	);
	$( "<div class='col-sm-12 ads-post'></div>" ).insertAfter( ".relate-post" );
	$.get("/public/data.html", function(data){
    	$('.ads-post').append(data);
	});
}

$(function() {
    $('div.spoiler-title').click(function() {
        $(this)
            .children()
            .first()
            .toggleClass('show-icon')
            .toggleClass('hide-icon');
        $(this)
            .parent().children().last().toggle();
    });
});

function confirmRobot(e) {
	let response = prompt("Do the following calculation: (26x26+12 = ?)", "0");
	if (response == null || response == "" || response == "0") {
    alert("Where accurate results are required, do not leave blank.");
		e.preventDefault();
		return false;
  } else {
    if (response == "688") {
			return true;
		}
		e.preventDefault();
		return false;
  }
}
