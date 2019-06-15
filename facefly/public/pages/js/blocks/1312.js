jQuery(document).ready(function($){
    $('.testimonial .testimonial-wrap').slick({
        rtl: false,
        dots: true,
        arrows: false,
        prevArrow:  '<i class="bt-testimonial prev-testimonial ion-ios-arrow-left"></i>',
        nextArrow:  '<i class="bt-testimonial next-testimonial ion-ios-arrow-right"></i>',
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        rows: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        centerPadding: 0,
        adaptiveHeight: false,
        responsive: [
                                                            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});