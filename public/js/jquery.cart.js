/*
function addToCart(itemId) {
    console.log('herem');
    $.ajax({
        type: 'POST',
        async: false,
        url: "account/addToCart\?id=" + itemId,
        dataType: 'json',
        success: function (data) {
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
            }
        }
    });
}*/
(function($) {
    let cart = {};
    $.fn.addToCart = function() {
        let id = $(this).attr('data-id');
        if(cart[id] === undefined){
            cart[id] = 1;
        }
        else{
            cart[id]++;
        }
        $(this).showCart();
        $(this).saveCart();
        $(this).postData();
    };

    $.fn.showCart = function () {
        let out = "";
        for(let key in cart){
           out += key + "___" + cart[key] + "<br/>";
        }
        $(".mini-cart").html(out);
    };


    $.fn.saveCart = function () {
        localStorage.setItem('cart', JSON.stringify(cart));
    };

    $.fn.loadCart = function () {
      if(localStorage.getItem('cart')){
          cart = JSON.parse(localStorage.getItem('cart'));
          $(this).showCart();
          $(this).postData();
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

        xhr.open('POST', '/bakeryin/cart');
        xhr.setRequestHeader("local", "data");
        xhr.send("data=" + storage);
    };

    $(document).ready(function () {
        $(this).loadCart();
    })

})( jQuery );