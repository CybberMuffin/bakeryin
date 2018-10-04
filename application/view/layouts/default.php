
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Bakery In" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="/bakeryin/public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /><!-- bootstrap css -->
<link href="/bakeryin/public/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="/bakeryin/public/css/font-awesome.css" rel="stylesheet"> <!-- fontawesome css -->
<?php if(strcmp($this->path ,'pages/about') == 0): ?>
    <link href="public/css/about.css" rel="stylesheet" type="text/css" media="all" />
<?php elseif(strcmp($this->path ,'pages/gallery') == 0 or strcmp($this->path ,'pages/cart') == 0
    or strcmp($this->path ,'pages/registration') == 0): ?>
    <link href="public/css/gallery.css" rel="stylesheet" type="text/css" media="all" />
    <link href="public/css/gallery2.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        .box {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }
        textarea {
            border: none;
            background-color: transparent;
            resize: none;
            outline: none;
        }
        .newcard{
            height: 310px;
            width: 310px;
            margin: 25px;
            margin-bottom: 50px;
            transition-timing-function: ease-in-out;
            transition: 0.30s;
        }
        .newcard:hover{
            height: 330px;
            width: 330px;
            margin: 15px;
            margin-bottom: 40px;
            transition-timing-function: ease-in-out;
            transition: 0.30s;
        }
        .cakes_grid1 > p{
            margin-top: 15px;
        }
        .magic{
            display: none;
        }
        .newcard:hover p.price{
            display: none;
        }
        .newcard:hover button.magic{
            display: inline;
        }
        .form-control{
            display: inline;
        }

    </style>
<?php elseif(strcmp($this->path ,'pages/services') == 0 or strcmp($this->path ,'pages/registration') == 0): ?>
    <link href="public/css/services.css" rel="stylesheet" type="text/css" media="all" />
<?php elseif(strcmp($this->path ,'pages/contacts') == 0): ?>
    <link href="public/css/contact.css" rel="stylesheet" type="text/css" media="all" />
<?php elseif(strcmp($this->path ,'pages/product') == 0): ?>
    <link href="/bakeryin/public/css/single.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/bakeryin/public/css/single2.css" rel="stylesheet" type="text/css" media="all" />
<?php endif; ?>

<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">
<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<!--//fonts-->
<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
</head>
<body>
    <?php
    if(strcmp($this->path ,'pages/product') == 0) {
        $product = new \application\model\Product();
        if (!$product->exists('id', $id))
            \application\core\View::errorCode(404);
    }
    require_once "application/view/patterns/header.php";
    echo $content;
    require_once "application/view/patterns/footer.php";
    ?>
</body>
</html>