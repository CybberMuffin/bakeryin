<?php
$product = new \application\model\Product();
?>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-stripped">
        <thead>
        <tr class="active">
            <th>Del</th>
            <th>Save</th>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($dataArr as $u):
?>            <form onsubmit="return confirm('Do you really want to delete/change the product?');"
                  action="/bakeryin/account/admin/editProduct" method="post">
            <tr>
                <td>
                    <button type="submit" class="close"  name="delete_prod">
                        <span class="glyphicon glyphicon-remove" style="color:red;"></span>
                    </button>
                </td>
                <td>
                    <button type="submit" class="close" name="edit_prod">
                        <span class="glyphicon glyphicon-check" style="color:green;"></span>
                    </button>
                </td>
                <input name='product_id' style="display: none" value="<?=$u->id?>" readonly>
                <td><?=$u->id?></td>
                <td><input class="form-control" name='name' size="25" value="<?=$u->name?>"></td>
                <td><input class="form-control" name='price' size="10" value="<?=$u->price?>$"></td>
                <td>
                    <img src="public/images/<?=$u->image?>" style="width:200px" alt="Image not found"><br/>
                    <input type="text" class="form-control" name='image' value="<?=$u->image?>">
                </td>
                <td><input type="text" class="form-control" name='category' value="<?=$u->getCategoryName($u->category_id)?>"></td>
                <td><textarea class="form-control" name='description' maxlength="700" cols="70" rows="8"><?=$u->description?></textarea></td>
            </tr>
            </form>
            <?php endforeach;
?>        </tbody>
    </table>
</div>