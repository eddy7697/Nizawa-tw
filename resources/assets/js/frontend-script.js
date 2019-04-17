$(function () {
    $('.mega-btn').on('click', function(e) {
        let target = $(this).attr('data-menu-target')

        // $('.mega-menu').addClass('fadeInDown animated faster', function () {
                
        // })
        // $('.mega-menu').show(0, {
        //     done: function () {
        //         animateCSS('.mega-menu', 'fadeInDown')        
        //     }
        // })
        $('.mega-menu').addClass('showup', function () {
            $('.mega-menu').addClass('fadeInDown animated faster', function () {
                
            })
            // animateCSS('.mega-menu', 'fadeInDown', function () {
            //     $('.mega-menu').css('display', 'block')
            // })   
        })
        $('.mega-menu-overlay').addClass('show', function () {
            $('.mega-menu-overlay').addClass('fadeIn animated faster')
        })
        
    })

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



