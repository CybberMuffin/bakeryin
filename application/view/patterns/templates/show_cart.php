<?php
$product = new \application\model\Product();
?>
@ foreach($dataArr as $p):
<form action="/bakeryin/account/cart/close" method="post">
    <div class="cakes_grid1 newcard">
        <a href="gallery/product?id={{$p->id}}">
            <img src="public/images/{{$p->image}}" style="width: 100%; height: 65%;"
                 alt="cakes"/>
        </a>
        <input name="prod_id" style="display: none" value="{{$p->id}}" readonly>
        <h3>
            {{$p->name}}
            <button type="submit" name="close" class="btn btn-danger" style="border-radius: 25px">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </h3>
        <p>Price: {{$p->price}}$
            <input class="form-control" name="quantity" type="number" style="width: 60px; border: none;"
                  value="{{$count[$p->id]}}">
            <button type="submit" name="change" class="btn btn-default">
                <i class="fa fa-check" aria-hidden="true"></i>
            </button>
        </p>
    </div>
</form>
@ endforeach;