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
});



