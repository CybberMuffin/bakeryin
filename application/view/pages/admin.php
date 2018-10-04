<?php
require 'application/view/patterns/templator.php';
$page = substr(basename($_SERVER['REQUEST_URI']), 11);
?>
<div class="header" id="home">
    <div class="content white">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/bakeryin/admin">
                        <h1>Admin page</h1>
                    </a>
                </div>
                <!--/.navbar-header-->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <nav>
                        <ul class="nav navbar-nav">
                            <li><a href="/bakeryin/admin?page=1">Users</a></li>
                            <li><a href="/bakeryin/admin?page=2">Products </a></li>
                            <li><a href="/bakeryin/admin?page=3">Orders</a></li>
                        </ul>
                    </nav>
                </div>
        </nav>
    </div>
</div>

<div class="container-fluid" style="padding: 0 30px">
    <?php if(isset($_SESSION['admin'])): ?>
    <?php if($page == 1 or $page == ''): ?>
    <div>
        <div class="row">
            <!--Search function for users-->
            <div class="col-md-3 search1">
                <form action="admin?page=1" method="post">
                    <label for="searchbar" style="margin-top: 8px">Search: </label>
                    <span><input id='searchbar'  name='searchbar' type="search" placeholder="Search..."></span><br/>
                    <select class="form-control" style="margin-top: 10px; width: 150px" name="category">
                        <option value="">Find users by:</option>
                        <option value="id">ID</option>
                        <option value="login">Username</option>
                        <option value="email">Email</option>
                    </select>
                    <button type="submit" class="btn btn-default" name="do_search" style="margin: 8px 0">Go</button>
                </form>
            </div>
            <!--//Search function for users-->
            <div class="col-md-1"></div>
            <!--Add new user-->
            <div class="col-md-8" style="border-left: 0.2px lightgray solid">
                <form action="admin?page=1" method="post">
                    <label>Username: </label><input type="text" style="width: 200px"
                                                    class="form-control" name="newlogin" placeholder="Cakelover">
                    <label>Email: </label><input type="email" style="width: 200px"
                                                 class="form-control" name="newemail" placeholder="cakelower@yahoo.com">
                    <label>Password: </label><input type="text" style="width: 200px"
                                                    class="form-control" name="newpass" placeholder="secret pass" style="margin-top: 8px">
                    <button class="btn btn-default"  style="margin: 10px 0" name="do_insert">
                        Add user
                    </button>
                </form>
            </div>
            <!--//Add new user-->
        </div>
        <?php
        if(empty($users)) {
            $users = $user->get();
            output('table_users', $users);
        }else{
            echo output('table_users', $users);
        }
        ?>
    </div>
            <!--//Users table tab -->
            <?php elseif($page == 2): ?>
            <!--Products table tab -->
            <div class="" id="tab2">
                <div class="row">
                    <!--Search function for products-->
                    <div class="col-md-3">
                        <form action="admin?page=2" method="post">
                            <label for="searchbar" style="margin-top: 8px">Search: </label>
                            <span >
                                <input id='searchbar'  name='prod_searchbar' type="search" placeholder="Search...">
                            </span><br/>
                            <select class="form-control" style="margin-top: 10px; width: 150px" name="prod_category">
                                <option value="">Find products by:</option>
                                <option value="id">ID</option>
                                <option value="name">Name</option>
                                <option value="price">Price</option>
                                <option value="category">Category</option>
                            </select>
                            <button type="submit" class="btn btn-default" name="do_prod_search" style="margin: 8px 0">
                                Go
                            </button>
                        </form>
                    </div>
                    <!--//Search function for products-->

                    <div class="col-md-1"></div>

                    <!--Add new product-->
                    <div class="col-md-8" style="border-left: 0.2px lightgray solid; padding: 0 20px;">
                        <form action="admin?page=2" method="post">
                            <div class="row">
                                <label>Name:  </label><input type="text" style="width: 200px"
                                                             class="form-control" name="newname" placeholder="Cake...">
                                <label>Price:  </label><input type="text" style="width: 200px"
                                                              class="form-control" name="newprice" placeholder="10$">
                                <label>Image name:  </label> <input type="text" style="width: 200px"
                                                                    class="form-control" name="newimg" placeholder="cake.jpg">
                                <label>Category:  </label> <input type="text" style="width: 200px"
                                                                    class="form-control" name="category" placeholder="cakes">
                                <label for="newdescpr">Description:</label>
                                    <textarea class="form-control" cols="100" rows="5" name="newdescrp"
                                              placeholder="What an awesome cake we got here!" ></textarea>
                                <nav class="nav navbar-right" style="margin-right: 10px">
                                    <button class="btn btn-default" name="do_insert_prod" style="margin: 10px 0">
                                        Add product
                                    </button>
                                </nav>
                            </div>
                        </form>
                    </div>
                    <!--//Add new product-->
                </div>
                <?php
                if(empty($products)) {
                    /*$products = $product->get();
                    output('table_products', $products);*/
                } else{
                    echo output('table_products', $products);
                }
                ?>
            </div>
            <!--//Products table tab -->
            <?php elseif($page == 3): ?>
            <div id="tab3">
                <div class="row">
                    <!--Search function for orders-->
                    <div class="col-md-3 search1">
                        <form action="admin?page=3" method="post">
                            <label for="order_searchbar" style="margin-top: 8px">Search: </label>
                            <span><input id='searchbar'  name='order_searchbar' type="search" placeholder="Search..."></span><br/>
                            <select class="form-control" style="margin-top: 10px; width: 150px" name="order_category">
                                <option value="">Find orders by:</option>
                                <option value="id">ID</option>
                                <option value="user">User Id</option>
                                <option value="prod">Product Id</option>
                            </select>
                            <button type="submit" class="btn btn-default" name="do_order_search" style="margin: 8px 0">
                                Go
                            </button>
                        </form>
                    </div>
                    <!--//Search function for orders-->
                </div>
                <?php
                if(empty($orders)) {
                    /*$products = $product->get();
                    output('table_products', $products);*/
                } else{
                    echo output('table_orders', $orders);
                }
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php else: ?>
    <div class="row">
       <div class="col-md-6 col-sm-6 vcenter"></div>
               <h1 class="text-center alert-info" >Log into the system</h1>
       <div class="col-md-6 col-sm-6 vcenter"></div>
   </div>
    <?php endif; ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://yastatic.net/bootstrap/3.3.1/js/bootstrap.min.js"></script>﻿
    <script>
        $(function(){
            var key = 'clicked-tab' ;
            $('a#tab2').on('click', function(){
                localStorage.setItem(key, $(this).data('tab'));
            });

            if (true) {   //добавляем условие "если на странице с табами"
                //селектор для таба
                $('a[href='+localStorage.getItem(key)+']').click();
                localStorage.removeItem(key);
            }
        });
    </script>
