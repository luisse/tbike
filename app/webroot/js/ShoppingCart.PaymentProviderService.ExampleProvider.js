/*
 * @namespace window.AcidJs.ShoppingCart.PaymentProviderService
 * @class Provider
 * @inherits window.AcidJs.ShoppingCart
 * @param superclass (Object) [set automatically]
 * @param config (Object) [set automatically]
 * @return Object
 * 
 * payment provider plugin for AcidJs.ShoppingCart
 * this is just a template file that can be used as a starting point for creating your own payment provider routine
 * you can visit our website to purchase a pre-made payment provider as well (go to: )
 **/

(function() {
    "use strict";
    
    /*
     * @namespace window.AcidJs.ShoppingCart.PaymentProviderService
     **/
    if(undefined === window.AcidJs.ShoppingCart.PaymentProviderService) {
        window.AcidJs.ShoppingCart.PaymentProviderService = {};
    }
    
    /*
     * @namespace window.AcidJs.ShoppingCart.PaymentProviderService
     * @class Provider
     * @inherits window.AcidJs.ShoppingCart
     * @param superclass (Object)
     * @param config (Object)
     * @info payment provider plugin for AcidJs.ShoppingCart
     * @info this is just a template file that can be used as a starting point for creating your own payment provider routine
     * @info you can visit our website to purchase a pre-made payment provider as well (go to: )
     * @return Object
     **/
    function Provider(superclass, config) {
        
        if(!superclass || !config) {
            return;
        }
        
        this.superclass = superclass;
        this.config = config;
        
        this.MANIFEST = superclass.MANIFEST;
        this.currency = superclass.currency;
        
        this.PAYMENT_PROVIDER_CONFIG.currency_code = this.currency;
    }
    
    /*
     * @constants
     **/
    var
        WINDOW = $(window);
    
    /*
     * @class ShoppingCart
     * @prototype
     **/
    Provider.prototype = {
        
        /*
         * @method PAYMENT_PROVIDER_CONFIG
         * @public
         * @info example of post data parameters, presented here as key/value pairs, required by the selected payment provider (check provider's API)
         * @required
         **/
        PAYMENT_PROVIDER_CONFIG: {
            "param1": "param1_value",
            "param2": "param2_value",
            "email": "your_payment_provider_email@example.com",
            "currency_code": "USD",
            "success_return_url": "http://example.com/purchase-success",
            "cancel_return_url": "http://example.com/purchase-failure"
        },
        
        /*
         * @method URLS
         * @public
         * @info sandbox and live URLs of the Payment Provider (this data is different for each provider, this one is PayPal-specific)
         **/
        URLS: {
            dev: "https://sandbox.example-provider.com/?", // sandbox environment of the payment provider (use it only for testing)
            live: "https://example-provider.com/?" // live environment of the payment provider (use it for the live shopping cart)
        },
        
        /*
         * @method submit
         * @public
         * @info this is a mandatory method, as it will be used by the ShoppingCart to submit your order to the selected payment provider. The functionality, depends on the payment provider
         * @required
         **/
        submit: function() {
            var
                superclass = this.superclass,
                console = superclass.console,
                utils = superclass.utils,
                urlDev = this.URLS.dev,
                urlLive = this.URLS.live,
                paymentProviderConfig = this.PAYMENT_PROVIDER_CONFIG,
                checkoutData = superclass.dm.retrieve("cart.checkout"); // get the checkout data from the shopping cart
            
            console.log("payment provider checkout submit:");
            console.log("> urlDev", urlDev);
            console.log("> urlLive", urlLive);
            console.log("> paymentProviderConfig", paymentProviderConfig);
            console.log("> checkoutData", checkoutData);
            
            // here goes your Payment Provider routine.
            // you can create your own payment provider routine or visit our website to purchase to buy one.
            // the configm dialog that follows is not required by the payment routine
            if(window.confirm("You can create your own payment provider routine or visit our website to purchase one of our premade ones. Would you like to visit HTML5 Shopping Cart's website to check what pre-made payment provider routines we have?")) {
                utils.getURL({
                    url: this.MANIFEST.websites.page
                });
            } else {
                var
                    dropdown = superclass.cartDropdown;
                
                dropdown.removeClass(superclass.CSS_CLASSES.checkingOut);
                
                superclass.utils.later(function() {
                    dropdown.find('button[name="update-cart"]').removeAttr("disabled");
                    dropdown.find('button[name="go-to-checkout"]').removeAttr("disabled");
                }, 4);
            }
        },
        
        /*
         * @method done
         * @public
         * @info this is a mandatory method, as it will be executed after a success/failure return from the payment provider
         * @required
         **/
        done: function() {
            var
                superclass = this.superclass,
                paymentProviderConfig = this.PAYMENT_PROVIDER_CONFIG,
                success = paymentProviderConfig["return"],
                cancel = paymentProviderConfig.cancel_return,
                checkoutData,
                cookieBaseName = superclass.COOKIES.base + superclass.cartDataCookieName,
                url = window.location;
            
            checkoutData = superclass.utils.stringToJson(superclass.cookies.read({
                name: cookieBaseName
            }));

            checkoutData = checkoutData ? checkoutData : [];
            
            // if the success or cancel url is the current url, erase the cart cookie
            if(window.decodeURI(url) === window.decodeURI(success) || window.decodeURI(url) === window.decodeURI(cancel)) {
                 superclass.returnedFromPaymentProvider = true;
                 WINDOW.trigger(this.superclass.EVENTS[5], checkoutData); // "acidjs-shopping-cart-return-from-payment-provider"
            }
            
            WINDOW.trigger(this.superclass.EVENTS[3], this.superclass.paymentProvider); // required, "acidjs-shopping-cart-payment-provider-ready"
            
            if(window.decodeURI(url) === window.decodeURI(success)) {
                WINDOW.trigger(this.superclass.EVENTS[8], {"success": true}); // "acidjs-shopping-cart-after-checkout-success"
            } else if (window.decodeURI(url) === window.decodeURI(cancel)) {
                WINDOW.trigger(this.superclass.EVENTS[9], {"success": false}); // "acidjs-shopping-cart-after-checkout-cancel"
            }
        }
    };
    
    /*
     * add the class to the parent class
     **/
    window.AcidJs.ShoppingCart.PaymentProviderService = Provider;
})();