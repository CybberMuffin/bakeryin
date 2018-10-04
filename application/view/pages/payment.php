<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 posts-grids w3-posts-grids" style="margin: 80px 0;  padding: 40px; border: 2px solid #03C5E2">
            <h3 style="margin-bottom: 20px; text-decoration: underline #03C5E2">Payment</h3>
            <div class="text text-info">You can pay now by card or pay cash when you'll receive your products </div>
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
            <form action="/bakeryin/account/cart/pay" method="post">
                <div class="control-group form-group">
                    <div class="controls" style="margin-top: 10px">
                        <label>Your order:</label>
                        <textarea  class="form-control" name="text" style="resize: none" rows=9 readonly><?php
                            if(isset($arr) && !empty($arr)){
                                foreach($arr as $item){
                                    $order = new \application\model\Order();
                                    echo $order->getProductName($item[0]).' - '.$item[2].' piece(s);   ';
                                }
                            }elseif(isset($_SESSION['info'])){
                                echo $_SESSION['info'];
                            }?>
                        </textarea>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Your address: </label>
                        <input type="text" name="address" class="form-control" placeholder="Address">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Number of your credit card: </label>
                        <input type="text" name="card" class="form-control" placeholder="****-****-****-****">
                    </div>
                </div>
                <button type="submit" name="pay" class="btn btn-info">Pay</button>
            </form>
        </div>
        <div class="col-md-3"></div>
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