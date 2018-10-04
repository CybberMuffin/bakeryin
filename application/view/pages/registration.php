
<div class="container">
    <div class="row">
        <div class="col-md-5 posts-grids w3-posts-grids" style="margin: 80px 0;  padding: 40px; border: 2px solid #03C5E2">
            <h3 style="margin-bottom: 20px; text-decoration: underline #03C5E2">Registration form</h3>
            <?php
            if(isset($_SESSION['errors']) && !empty($_SESSION['errors']))
            {
                echo '<div class="text-center alert alert-danger">'.array_shift($_SESSION['errors']).'</div>';
                unset ($_SESSION['errors']);
            }
            if(isset($_SESSION['success']) && !empty($_SESSION['success']))
            {
                echo '<div class="text-center alert alert-success">'.array_shift($_SESSION['success']).'</div>';
                unset ($_SESSION['success']);
            }
            ?>
            <form action="account/register" method="post">
                <div class="control-group form-group">
                    <div class="controls" style="margin-top: 10px">
                        <label>E-mail:</label>
                        <input type="email" class="form-control" name="email" value='<?php echo @$_POST['email']?>' placeholder="sweet@bakeryin.com">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Username:</label>
                        <input type="text" class="form-control" name="login" placeholder="Cakelover">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password: </label>
                        <input type="password" class="form-control" name="password" placeholder="Only latin letters or numbers from 5 up to 20 symbols">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Repeat password: </label>
                        <input type="password" class="form-control" name="rep_password" placeholder="Only latin letters or numbers from 5 up to 20 symbols">
                    </div>
                </div>
                <div style="margin: 20px 0" class="g-recaptcha" data-sitekey="6LeI6VwUAAAAANtVEPPr0QDnbpRcfEoiLMy2EX0V"></div>
                <button type="submit" class="btn btn-info">Sign up</button>
            </form>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6 about_right" style="margin: 80px 0;">
            <img src="public/images/about1.jpg" style="width: 200px; margin: 5px 10px" alt="image" />
            <img src="public/images/about2.jpg" style="width: 200px; margin: 5px 10px" alt="image" />
            <div class="clearfix"> </div>
            <h3>Made for you</h3>
            <h3 class="bold">with love</h3>
            <p>Suspendisse vitae vulputate ligula, ac ornare urna.
                Aenean volutpat, lacus non bibendum ullamcorper, mi neque cursus augue, vel euismod lorem ipsum non eros.
                Nullam volutpat condimentum pharetra. Etiam eget dapibus dolor. Aenean suscipit nec nisi id dignissim.
                Nullampos uere quam quis varius rutrum.
                Cras in egestas mi. Vestibulum odio lorem, lobortis in enim in, vulputate eleifend nisl.</p>
            <a href="/bakeryin/about" class="hvr-bounce-to-right read scroll"><span class="fa fa-birthday-cake" aria-hidden="true"></span>Read More</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').submit(function(event) {
            if ($(this).attr('id') == 'no_ajax') {
                return;
            }
            var json;
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    json = jQuery.parseJSON(result);
                    if (json.url) {
                        window.location.href = '/' + json.url;
                    } else {
                        alert(json.status + ' - ' + json.message);
                    }
                },
            });
        });
    });
</script>