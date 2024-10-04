(function($){

    /**
     * initializeBlock
     *
     * Custom JavaScript for Block: product-card.
     *
     *
     */
    var initializeBlock = function( $block ) {
        // CONFIG
        let visibilityIds = ['#counter_facts']; //must be an array, could have only one element
        let counterClass = '.counter';
        let defaultSpeed = 1000; //default value

        //init if it becomes visible by scrolling
        $(window).on('scroll', function () {
            getVisibilityStatus();
        });

        //init if it's visible by page loading
        getVisibilityStatus();

        function getVisibilityStatus() {
            elValFromTop = [];
            var windowHeight = $(window).height(),
                windowScrollValFromTop = $(this).scrollTop();

            visibilityIds.forEach(function (item, index) { //Call each class
                try { //avoid error if class not exist
                    elValFromTop[index] = Math.ceil($(item).offset().top);
                } catch (err) {
                    return;
                }
                // if the sum of the window height and scroll distance from the top is greater than the target element's distance from the top, 
                //it should be in view and the event should fire, otherwise reverse any previously applied methods
                if ((windowHeight + windowScrollValFromTop) > elValFromTop[index]) {
                    counter_init(item);
                }
            });
        }

        function counter_init(groupId) {
            let num, speed, direction, index = 0;
            $(counterClass).each(function () {
                num = $(this).attr('data-TargetNum');
                speed = $(this).attr('data-Speed');
                direction = $(this).attr('data-Direction');
                easing = $(this).attr('data-Easing');
                if (speed == undefined) speed = defaultSpeed;
                $(this).addClass('c_' + index); //add a class to recognize each counter
                doCount(num, index, speed, groupId, direction, easing);
                index++;
            });
        }

        function doCount(num, index, speed, groupClass, direction, easing) {
            let className = groupClass + ' ' + counterClass + '.' + 'c_' + index;
            if(easing == undefined) easing = "swing";
            $(className).animate({
                num
            }, {
                duration: +speed,
                easing: easing,
                step: function (now) {
                    if (direction == 'reverse') {
                        $(this).text(num - Math.floor(now));
                    } else {
                        $(this).text(Math.floor(now));
                    }
                },
                complete: doCount
            });
        }

    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.gp-counter-facts').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=counter-facts', initializeBlock );
    }

})(jQuery);