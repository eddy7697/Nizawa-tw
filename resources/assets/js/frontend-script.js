;(function(ns){
	/**
	 * mb_strwidth
	 * @param String
	 * @return int
	 * @see http://php.net/manual/ja/function.mb-strwidth.php
	 */
	var mb_strwidth = function(str){
		var i=0,l=str.length,c='',length=0;
		for(;i<l;i++){
			c=str.charCodeAt(i);
			if(0x0000<=c&&c<=0x0019){
				length += 0;
			}else if(0x0020<=c&&c<=0x1FFF){
				length += 1;
			}else if(0x2000<=c&&c<=0xFF60){
				length += 2;
			}else if(0xFF61<=c&&c<=0xFF9F){
				length += 1;
			}else if(0xFFA0<=c){
				length += 2;
			}
		}
		return length;
	};
	
	/**
	 * mb_strimwidth
	 * @param String
	 * @param int
	 * @param int
	 * @param String
	 * @return String
	 * @see http://www.php.net/manual/ja/function.mb-strimwidth.php
	 */
	var mb_strimwidth = function(str,start,width,trimmarker){
		if(typeof trimmarker === 'undefined') trimmarker='';
		var trimmakerWidth = mb_strwidth(trimmarker),i=start,l=str.length,trimmedLength=0,trimmedStr='';
		for(;i<l;i++){
			var charCode=str.charCodeAt(i),c=str.charAt(i),charWidth=mb_strwidth(c),next=str.charAt(i+1),nextWidth=mb_strwidth(next);
			trimmedLength += charWidth;
			trimmedStr += c;
			if(trimmedLength+trimmakerWidth+nextWidth>width){
				trimmedStr += trimmarker;
				break;
			}
		}
		return trimmedStr;
	};
	ns.mb_strwidth   = mb_strwidth;
	ns.mb_strimwidth = mb_strimwidth;
})(window);

$(function () {
    let btnClick = false

    $('.mega-btn').on('click', function(e) {
        let btn = $(this)
        let parent = $('.mega-nav')
        let target = btn.attr('data-menu-target')
        let megamenu = $('#site-mega-menu')
        let mask = $('.site-mega-menu-overlay')

        megamenu.addClass('showup').addClass('fadeInDown animated faster').delay(500).addClass('opened')
        mask.addClass('show').addClass('fadeIn animated faster')
        parent.find('.mega-nav-item').not('#' + target).removeClass('active')
        parent.find('.mega-nav-item#' + target).addClass('active')

        setTimeout(() => {
            btnClick = true
        }, 500);
    })

    $('.site-mega-menu-overlay').on('click', function () {
        hideMegamenu()
    })
    $('.site-header').on('click', function (e) {
        if (!$(e.target).hasClass('mega-btn') && !$(e.target).hasClass('mega-arrow')) {
            hideMegamenu()
        }
    })

    function hideMegamenu() {
        let menu = $('.site-mega-menu')
        let mask = $('.site-mega-menu-overlay')

        if (btnClick) {
            if (menu.hasClass('showup')) {
                menu.addClass('fadeOutUp animated faster', function () {
                    setTimeout(() => {
                        $(this).removeClass('showup opened fadeOutUp animated faster fadeInDown')
                        $('.mega-btn').removeClass('active')
                        btnClick = false
                    }, 500);
                })
            }
            
            if (mask.hasClass('show')) {
                mask.addClass('fadeOut animated faster', function () {
                    setTimeout(() => {
                        $(this).removeClass('show opened fadeOut animated faster fadeIn')
                        btnClick = false
                    }, 500);
                })
            }
        }
    }

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
    })
});



