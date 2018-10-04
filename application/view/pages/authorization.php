<div class="container">
    <div class="row">
        <div class="col-md-5 posts-grids w3-posts-grids" style="margin: 90px 0;  padding: 40px; border: 2px solid #03C5E2">
            <h3 style="margin-bottom: 20px; text-decoration: underline #03C5E2">Authorization</h3>
            <?php
            if(isset($_SESSION['errors']) && !empty($_SESSION['errors']))
            {
                echo '<div class="text-center alert-danger">'.array_shift($_SESSION['errors']).'</div>';
                unset ($_SESSION['errors']);
            }
            ?>
            <form action="account/login" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Username: </label>
                        <input type="text" class="form-control" name="login" placeholder="Cakelover">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password: </label>
                        <input type="password" class="form-control" name="password" placeholder="Your password">
                    </div>
                    <small><a href="/bakeryin/account/startRecovery">Forgot your password?</a></small>
                </div>
                <button type="submit" name="do_login" class="btn btn-info">Log in</button>
            </form>
        </div>
        <div class="col-md-2 col-sm-2"></div>
        <?php if(isset($_SESSION['recovery']) &&  $_SESSION['recovery'] == 'begin'):?>
        <div class="col-md-5 posts-grids w3-posts-grids" style="margin: 90px 0;  padding: 40px; border: 2px solid #03C5E2">
            <h3 style="margin-bottom: 20px; text-decoration: underline #03C5E2">Password recovery</h3>
            <?php
            if(isset($_SESSION['r_errors']) && !empty($_SESSION['r_errors'])) {
                echo '<div class="text-center alert alert-danger">' . array_shift($_SESSION['r_errors']) . '</div>';
                unset ($_SESSION['r_errors']);
            }
            if(isset($_SESSION['success']) && !empty($_SESSION['success']))
            {
                echo '<div class="text-center alert alert-success">'.array_shift($_SESSION['success']).'</div>';
                unset ($_SESSION['success']);
            }
            ?>
            <form action="account/recovery" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email: </label>
                        <input type="text" class="form-control" name="r_email" placeholder="sweet@bakeryin.com">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>New password: </label>
                        <input type="password" class="form-control" name="new_password" placeholder="Your password">
                    </div>
                    <small><a href="">Choose new password wisely</a></small>
                </div>
                <button type="submit" name="do_recovery" class="btn btn-info">Recover</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>