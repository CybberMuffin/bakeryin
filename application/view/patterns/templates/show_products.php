<?php
$product = new \application\model\Product();
?>

@ foreach($dataArr as $p):
    <a href="gallery/product?id={{$p->id}}">
    <form action="/bakeryin/account/addToCart" method="post">
        <div class="cakes_grid1 newcard">
            <img src="public/images/{{$p->image}}" style="width: 100%; height: 70%;"
                 alt="cakes" />
            <h3>{{$p->name}}</h3>
            <p class="price">Price: {{$p->price}}$</p>
            <input name="prod_id" style="display: none" value="{{$p->id}}" readonly>
            <p>
                <button class="btn btn-info magic" name="buy" type="submit">
                    Add to cart
                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                </button>
            </p>
        </div>
    </form>
    </a>
@ endforeach;