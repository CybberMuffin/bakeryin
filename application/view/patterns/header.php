
	<!-- header -->
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
						<a class="navbar-brand" href="/bakeryin/">
							<h1>Bakery in</h1>
						</a>
					</div>
					<!--/.navbar-header-->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<nav>
							<ul class="nav navbar-nav">
								<li><a href="/bakeryin/">Home</a></li>
								<li><a href="/bakeryin/about">About </a></li>
								<li><a href="/bakeryin/contacts">Contacts</a></li>
								<li><a href="/bakeryin/gallery?page=1">Gallery</a></li>
                                <?php $user = new \application\model\User();
                                $admin = new \application\model\Admin();
                                if(isset($_SESSION['logged_user'])): ?>
                                <li>
                                    <a href="/bakeryin/cart" class="fa fa-user"><?php echo $_SESSION['logged_user'];?>
                                        <sup><i class="fa fa-cart-plus" aria-hidden="true">
                                            <?php if(isset($_COOKIE['cart']))
                                                echo count(json_decode($_COOKIE['cart'], true));
                                            ?>
                                        </i></sup>
                                    </a>
                                </li>
                                <li>
                                    <a href="/bakeryin/account/logout" class="fa fa-sign-out" >Exit</a>
                                </li>
                                <?php elseif(!(empty($_COOKIE['login']))):
                                $user->find('login', $_COOKIE['login']);
                                if($user) $_SESSION['logged_user'] = $_COOKIE['login'];
                                if($admin->exists('user_id', $_COOKIE['id']))
                                        $_SESSION['admin'] = $_COOKIE['login'];
                                if($user): ?>
                                <li>
                                    <a href="/bakeryin/cart" class="fa fa-user"><?php echo $_COOKIE['login'];?>
                                        <sup><i class="fa fa-cart-plus" aria-hidden="true">
                                            <?php if(isset($_COOKIE['cart']))
                                                echo count(json_decode($_COOKIE['cart'], true));
                                            ?>
                                        </i></sup>
                                    </a>
                                </li>
                                <li>
                                    <a href="/bakeryin/account/logout" class="fa fa-sign-out" >Exit</a>
                                </li>
                                <?php endif; else: ?>
                                <li>
                                    <a href="/bakeryin/authorization">
                                        <span class="fa fa-sign-in"></span>Log in</a>
                                </li>
                                <li>
                                    <a href="/bakeryin/registration" >
                                        <span class="glyphicon glyphicon-pencil"></span>Sign up
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
					<!--/.navbar-collapse-->
					<!--/.navbar-->
				</div>
			</nav>
		</div>
	</div>
    <!--modal window-->
    <section>
        <div class="modal fade" role="dialog" id = "myModal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#login-form"> Log in <span class="glyphicon glyphicon-user"></span></a></li>
                            <li><a data-toggle="tab" href="#registration-form"> Register <span class="glyphicon glyphicon-pencil"></span></a></li>
                        </ul>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content">
                            <div id="err"></div>
                            <div id="login-form" class="tab-pane fade in active">
                                <form id="logForm" action = '/bakeryin/account/login' method = post>
                                    <div class="form-group">
                                        <label for="login">Username:</label>
                                        <input type="text" class="form-control" id="login" placeholder="Enter username" name="login">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Password:</label>
                                        <input type="password" class="form-control" id="pass" placeholder="Enter password" name="password">
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="remember"> Remember me</label>
                                    </div>
                                    <button type="submit" class="btn btn-default" id = 'do_login' name="do_login">Log in</button>
                                </form>
                            </div>
                            <div id="registration-form" class="tab-pane fade">
                                <form  method="post" action="/bakeryin/register" id="register-form">
                                    <div id="error"></div>
                                    <div class="form-group">
                                        <label for="name">Your Name:</label>
                                        <input type="text" class="form-control" id="user_name" placeholder="Enter your name" name="login">
                                    </div>
                                    <div class="form-group">
                                        <label for="newemail">Email:</label>
                                        <input type="email" class="form-control" id="user_email" placeholder="Enter your email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="newpwd">Password:</label>
                                        <input type="password" class="form-control" id="newpwd" placeholder="Enter your password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="reppwd">Repeat password:</label>
                                        <input type="password" class="form-control" id="reppwd" placeholder="Repeat your password" name="password_2">
                                    </div>
                                    <button type="submit" name="register" id="btn-submit" class="btn btn-default">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //modal window-->
	<!-- //header -->