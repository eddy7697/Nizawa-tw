$(function () {
    $('#toogle-search-form').on('click', function() {
        $('#search-section').fadeToggle('fast');

        if ($('#search-section')[0].className === "open") {
            $(this).html('<i class="fa fa-search" aria-hidden="true"></i>');
            $('#search-section').removeClass('open');
        } else {
            if (document.getElementById('search-section').style.display === 'block') {
                $(this).html('<i class="fa fa-times" aria-hidden="true"></i>');
                $('#search-section').addClass('open');
            }
        }

    });

    //Check to see if the window is top if not then display button
    // scrollupBtn();
	// $(window).scroll(function(){
    //     scrollupBtn();
	// });

	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
    });

    $('#scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
    });
    
    function showMenu(btn) {
        $('body').css('overflow', 'hidden');
        btn.addClass('active');
        $('.mobile-site-menu').removeClass('hide').addClass('fadeInLeft animated');
    }

    function closeMenu(btn) {
        $('body').css('overflow', 'initial');
        btn.removeClass('active');
        $('.mobile-site-menu').removeClass('fadeInLeft animated')
                          .addClass('fadeOutLeft animated')
                          .fadeOut(500, function () {
                            $('.mobile-site-menu').removeClass('fadeOutLeft animated')
                            .addClass('hide')
                            .removeAttr('style');
                          });

        btn.css('margin-left', '0px');
    }

    $('#menu-btn').on('click', function() {
        // showMenu($(this));
        if ($(this).hasClass('active')) {
            closeMenu($(this));
        } else {
            showMenu($(this));
        }
    }),

    

    function scrollupBtn() {
        if ($(window).scrollTop() > 100) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
    }

    function addSingleProduct(guid) {

        $('.add-btn').hide();
        $('.add-loading').show();
        $.ajax({
            url: '/cart/add/single/' + guid,
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            console.log(response);
            toastr["success"]("成功加入購物車");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('.add-btn').show();
            $('.add-loading').hide();
            console.log("complete");
        });
    }
});



