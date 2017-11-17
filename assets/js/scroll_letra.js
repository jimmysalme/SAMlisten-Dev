
    /*****************************
	Scroll Letra
	**************************/

    var scrollHandle = 0,
        scrollStep = 2,
        parent = $("#letra");

    //Start the scrolling process
    $(".panner").on("mouseenter", function () {
        var data = $(this).data('scrollModifier'),
            direction = parseInt(data, 5);

        $(this).addClass('flecha_activa');

        startScrolling(direction, scrollStep);
    });

    //Kill the scrolling
    $(".panner").on("mouseleave", function () {
        stopScrolling();
        $(this).removeClass('flecha_activa');
    });

    //Actual handling of the scrolling
    function startScrolling(modifier, step) {
        if (scrollHandle === 0) {
            scrollHandle = setInterval(function () {
                var newOffset = parent.scrollTop() + (scrollStep * modifier);

                parent.scrollTop(newOffset);
            }, 5);
        }
    }

    function stopScrolling() {
        clearInterval(scrollHandle);
        scrollHandle = 0;
    }
	
	
	$("#panTop").hide();
	
	$("#letra").scroll(function() {
		if($(this).scrollTop() >= 10) {
			//alert($(this)[0].scrollHeight);
			$("#panTop").show();    
		} else {
			$("#panTop").hide();
		}
		
		if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
			$("#panBottom").hide();    
		} else {
			$("#panBottom").show();
		}
	});
		