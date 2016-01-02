$(document).ready(function() {
    $('#contact-form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            message: {
                minlength: 10,
                required: true
            }
        },
        highlight: function(element) {
            //$(element).closest('.control-group').removeClass('success').addClass('error');
            $(element).closest('.form-group').addClass('has-error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid')
                    .closest('.form-group').removeClass('has-error');
        },
        submitHandler: function(form) {
            var btnVal = $("#btn-contact").html();
            $("#btn-contact").html('<i class="fa fa-spinner fa-pulse"></i>');
            $.ajax({
                url: base_url + "vart_home/sendMail",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    if (response == 'success') {
                        $('#inquiryFormHolder').removeClass("hide").addClass("alert-success").html("Thank you for contacting us.");
                        $("input, textarea", form).val("");
                        $("label.error").remove();
                    } else {
                        $('#inquiryFormHolder').removeClass("hide").addClass("alert-danger").html("Something Wrong!");
                    }
                    $("#btn-contact").html(btnVal);
                }
            });
        }
    });
});
jQuery(document).ready(function($) {

    $(".scroll a:not(.outer), .gototop").click(function(event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 600, 'swing');
        $(".scroll li").removeClass('active');
        $(this).parents('li').toggleClass('active');
    });
});






var wow = new WOW(
        {
            boxClass: 'wowload', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0, // distance to the element when triggering the animation (default is 0)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true        // act on asynchronously loaded content (default is true)
        }
);
wow.init();




$('.carousel').swipe({
    swipeLeft: function() {
        $(this).carousel('next');
    },
    swipeRight: function() {
        $(this).carousel('prev');
    },
    allowPageScroll: 'vertical'
});



