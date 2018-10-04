<?php
$order = new \application\model\Order();
?>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-stripped">
        <thead>
        <tr class="active">
            <th>Del</th>
            <th>Edit</th>
            <th>Id</th>
            <th>User Id</th>
            <th>User name</th>
            <th>Product Id</th>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Paid</th>
            <th>Address(Deliver)</th>
        </tr>
        </thead>
        <tbody>
            @ foreach($dataArr as $u):
            <?php
            $user = new \application\model\User();
            $prod = new \application\model\Product();
            $user->find('id', $u->user_id);
            $prod->find('id', $u->product_id);
            ?>
            <form onsubmit="return confirm('Do you really want to delete/change the order?');" action="/bakeryin/account/admin/editOrder" method="post">
            <tr>
                <td>
                    <button type="submit" class="close"  name="delete_order">
                        <span class="glyphicon glyphicon-remove" style="color:red;"></span>
                    </button>
                </td>
                <td>
                    <button type="submit" class="close" name="edit_order">
                        <span class="glyphicon glyphicon-check" style="color:green;"></span>
                    </button>
                </td>
                <input name='order_id' style="display: none" value="{{$u->id}}" readonly>
                <td>{{$u->id}}</td>
                <td>{{$u->user_id}}</td>
                <td>{{$user->login}}</td>
                <td>{{$u->product_id}}</td>
                <td>{{$prod->name}}</td>
                <td>{{$u->quantity}}</td>
                <td><input class="form-control" name='paid' size="3" value="{{$u->paid}}"></td>
                <td><input class="form-control" name='deliver' size="10" value="{{$u->delivered}}"></td>
            </tr>
            </form>
            @ endforeach;
        </tbody>
    </table>
</div>