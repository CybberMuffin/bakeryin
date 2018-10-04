(function($) {
    let cart = {};
    $.fn.loadCart = function () {
        if(localStorage.getItem('cart')){
            cart = JSON.parse(localStorage.getItem('cart'));
            //$(this).showCart();
            $('.cart').html(cart);
        }
        else {
            $('.cart').html('Cart is empty!');
        }
    };

   $.fn.postData = function () {
        var storage = JSON.stringify(localStorage);

        var xhr;

        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        }
        else if (window.ActiveXObject) {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        }
        else {
            throw new Error("Ajax is not supported by this browser");
        }

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200 && xhr.status < 300) {
                    document.getElementById('cart').innerHTML = xhr.responseText;
                }
            }
        };

        xhr.open('POST', 'cart');
        xhr.setRequestHeader("local", "data");
        xhr.send("data=" + storage);
    };

    $.fn.showCart = function () {
        let out = "";
        for(let key in cart) {
            out += `lopa`;
        }
        $('.cart').html(out);
    };

    $(document).ready(function () {
       $(this).loadCart();
    });
})( jQuery );