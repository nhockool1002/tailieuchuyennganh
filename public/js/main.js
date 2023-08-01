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

function convertKeyToMessage(string) {
    switch (string) {
        case 'not_login':
            return "Bạn chưa Login, không thể like post.";
        case 'like_duplicate':
            return "Bạn đã like bài viết này rồi."
        default:
            return "EMPTY MESSAGE";
    }
}

const likeBtn = $('.not-thank');

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
likeBtn.click(function() {
    const post_id = $(this).data('post-id');
    const like_box = $('.like-box');
    const box_thank = $('.box-say-thank');
    $.ajax({
        url: '/post/' + post_id + '/like',
        method: 'POST',
        data: { post_id } ,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            like_box.html(`<div class="thanked" data-post-id="{{ $posts->id }}">
                <span class="icon">
                    <img src="../../img/like.png" />
                </span>
                <span class="content-thank">YOU THANKED</span>
            </div>`);
            response.list && box_thank.html(`${response.list}`);
            toastr.info("Bạn đã nhận được 0.5 TPoint$");
        },
        error: function(err) {
            const error = JSON.parse(err.responseText);
            toastr.error(convertKeyToMessage(error.message));
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
	const downloadPdf = document.getElementById("download-pdf-content");
	
	downloadPdf.addEventListener("click", function() {
			const element = document.getElementById("post-content-wrap");
			const el1 = element.cloneNode(true);
			el1.insertAdjacentHTML(
				"afterbegin", 
				`
				<span style="color: red; font-weight: bolder; font-size: 18px;">${el1.dataset.title}</span>
				<br />
				<span style="color: black; margin-right: 3px;">Chia sẻ bởi ${el1.dataset.author}</span>
				<span style="color: gray;font-size: 12px;">(${el1.dataset.readtime})</span>
				<p></p>
				`
			);
			el1.insertAdjacentHTML(
				"beforeend",
				`<div style="color: red; text-align: center; width: 100%;">
				 ☘️ BÀI VIẾT ĐƯỢC CHIA SẺ BỞI TAILIEUCHUYENNGANH.COM - VUI LÒNG ĐỂ NGUYÊN NGUỒN KHI COPY ☘️
				</div>`
			);
			el1.style.setProperty("max-height", "unset");
			el1.style.setProperty("overflow-y", "visible");
			const opt = {
				margin: 0.5,
				filename: 'myFile.pdf',
				image: { type: 'jpeg', quality: 0.98 },
				html2canvas: { scale: 2 },
				jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' },
			};
			html2pdf().set(opt).from(el1).save().then(() => {
					el1.style.setProperty("max-height", "860px");
					el1.style.setProperty("overflow-y", "scroll");
			});
	});
});
