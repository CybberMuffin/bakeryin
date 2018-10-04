<?php
$user = new \application\model\User();
?>
<div class="table-responsive newcard">
    <table class="table table-hover table-bordered table-stripped">
        <thead>
        <tr class="active">
            <th>Del</th>
            <th>Save</th>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($dataArr as $u):
?>            <form  onsubmit="return confirm('Do you really want to delete/change the user?');" action="/bakeryin/account/admin/editUser" method="post">
            <tr>
                <td>
                    <button type="submit" class="close"  name="delete">
                        <span class="glyphicon glyphicon-remove" style="color:red;"></span>
                    </button>
                </td>
                <td>
                    <button type="submit" class="close" name="edit">
                        <span class="glyphicon glyphicon-check" style="color:green;"></span>
                    </button>
                </td>
                <input name='id' style="display: none" value="<?=$u->id?>" readonly>
                <td><?=$u->id?></td>
                <td><input class="form-control" name='login' size="25" value="<?=$u->login?>"></td>
                <td><input class="form-control" name='email' size="30" value="<?=$u->email?>"></td>
                <td><input class="form-control" name='password' size="75" value="<?=$u->password?>"></td>
                <td><?=$u->status?></td>
            </tr>
            </form>
            <?php endforeach;
?>        </tbody>
    </table>
</div>
