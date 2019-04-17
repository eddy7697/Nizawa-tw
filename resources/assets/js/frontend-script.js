$(function () {
    let btnClick = false

    $('.mega-btn').on('click', function(e) {
        let btn = $(this)
        let parent = $('.mega-nav')
        let target = btn.attr('data-menu-target')
        let megamenu = $('#site-mega-menu')
        let mask = $('.site-mega-menu-overlay')

        btnClick = true

        if (btnClick) {
            megamenu.addClass('showup').addClass('fadeInDown animated faster').delay(500).addClass('opened')
            mask.addClass('show').addClass('fadeIn animated faster')

            parent.find('.mega-nav-item').not('#' + target).removeClass('active')
            parent.find('.mega-nav-item#' + target).addClass('active')
        }
    })

    $('.site-mega-menu-overlay').on('click', function () {
        hideMegamenu()
    })
    $('.site-header').on('click', function (e) {
        if (!$(e.target).hasClass('mega-btn')) {
            hideMegamenu()
        }
    })

    function hideMegamenu() {
        let menu = $('.site-mega-menu')
        let mask = $('.site-mega-menu-overlay')

        if (menu.hasClass('showup')) {
            menu.addClass('fadeOutUp animated faster', function () {
                setTimeout(() => {
                    $(this).removeClass('showup opened fadeOutUp animated faster fadeInDown')
                    $('.mega-btn').removeClass('active')
                }, 500);
            })
        }
        
        if (mask.hasClass('show')) {
            mask.addClass('fadeOut animated faster', function () {
                setTimeout(() => {
                    $(this).removeClass('show opened fadeOut animated faster fadeIn')
                }, 500);
            })
        }
    }

    function animateCSS(element, animationName, callback) {
        const node = document.querySelector(element)
        node.classList.add('animated', animationName)
    
        function handleAnimationEnd() {
            node.classList.remove('animated', animationName)
            node.removeEventListener('animationend', handleAnimationEnd)
    
            if (typeof callback === 'function') callback()
        }
    
        node.addEventListener('animationend', handleAnimationEnd)
    }
});



