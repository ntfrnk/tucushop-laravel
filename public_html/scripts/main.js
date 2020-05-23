/*
 *****************************************************
 *	CUSTOM JS DOCUMENT                              *
 *	Single window load event                        *
 *   "use strict" mode on                            *
 *****************************************************
 */
$(window).on("load", function() {

    "use strict";


    var preLoader = $('.preloader');
    var mixItUp = $('#mixItUp');
    var fancybox = $('.fancybox');
    var viewGrid = $('.viewGrid');
    var viewList = $('.viewList');
    var productViewGrid = $('#product-view-grid');
    var productViewList = $('#product-view-list');
    var tabLinks = $('.tablinks');

    // ============================================
    // PreLoader On window Load
    // =============================================
    if (preLoader.length) {
        preLoader.addClass('loaderout');
    }

    //============================================
    // MixItUp settings
    //============================================		

    if (mixItUp.length) {
        mixItUp.mixItUp();
    }

    //========================================
    // LightBox / Fancybox
    //======================================== 	

    if (fancybox.length) {
        fancybox.fancybox();
    }

    //========================================
    // Collection Grid/List Function
    //======================================== 	

    viewGrid.on('click', function() {
        productViewGrid.show();
        productViewList.hide();
    });

    viewList.on('click', function() {
        productViewGrid.hide();
        productViewList.show();
    });

    //***************************************
    // Checkout Page Effect function Calling
    //****************************************

    checkoutPageEffect();

    //========================================
    // Tabs Settings
    //======================================== 	

    tabLinks.on('click', function() {
        var dataId = $(this).attr('data-id');
        tabCustom(event, dataId);
    });

    //========================================
    // Owl Carousel functions Calling
    //======================================== 	

    owlCarouselInit();

});


//========================================
// Owl Carousel functions
//======================================== 	

function owlCarouselInit() {

    "use strict";

    //========================================
    // owl carousels settings
    //======================================== 		
    var mainSlider = $('#main-slider');
    var menuSlider = $('#menu-slider');
    var productSlider = $('#product-slider');
    var BlogSlider = $('#Blog-slider');
    var testimonialSlider = $('#testimonial-slider');
    var ourPartnerSlider = $('#our-partner-slider');
    var nextNav = '<span class="icon arrows-slim-right"></span>';
    var prevNav = '<span class="icon arrows-slim-left"></span>';

    if (mainSlider.length) {
        mainSlider.owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: [prevNav, nextNav],
            dots: false,
            autoplay: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    if (productSlider.length) {
        productSlider.owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: [prevNav, nextNav],
            dots: false,
            autoplay: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

    }

    if (BlogSlider.length) {
        BlogSlider.owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: [prevNav, nextNav],
            dots: false,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 2
                }
            }
        });
    }

    if (testimonialSlider.length) {
        testimonialSlider.owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    if (ourPartnerSlider.length) {
        ourPartnerSlider.owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            nav: true,
            navText: [prevNav, nextNav],
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });
    }

}


//========================================
// Tabs function settings
//======================================== 
function tabCustom(evt, dataId) {

    "use strict";

    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(dataId).style.display = "block";
    evt.currentTarget.className += " active";


}

//***************************************
// Checkout Page Effect function definition
//****************************************

function checkoutPageEffect() {
    "use strict";

    var showlogin = $('.showlogin');
    var loginDiv = $('.login');
    var showcoupon = $('.showcoupon');
    var checkout_coupon = $('.checkout_coupon');
    var differentAddress = $('#ship-to-different-address-checkbox');
    var shippingFields = $('.shipping-fields');
    var createAccountCheck = $('#createaccount');
    var createAccount = $('.create-account');
    var paymentMethodCheque = $('#payment_method_cheque');
    var paymentBox = $('.payment_box.payment_method_cheque');
    var paymentMethodPaypal = $('#payment_method_paypal');
    var paymentBoxPaypal = $('.payment_box.payment_method_paypal');


    showlogin.on('click', function(e) {
        e.preventDefault();
        loginDiv.slideToggle("slow");
    });

    showcoupon.on('click', function(e) {
        e.preventDefault();
        checkout_coupon.slideToggle("slow");
    });

    differentAddress.change(function() {
        if (this.checked) {
            shippingFields.slideToggle('slow');
        } else {
            shippingFields.slideToggle('slow');
        }
    });

    createAccountCheck.change(function() {
        if (this.checked) {
            createAccount.slideToggle('slow');
        } else {
            createAccount.slideToggle('slow');
        }
    });



}

/*
 *****************************************************
 *	END OF THE JS 									*
 *	DOCUMENT                       					*
 *****************************************************
 */