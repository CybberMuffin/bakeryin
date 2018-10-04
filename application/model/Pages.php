<?php
namespace application\model;

use application\libs\DBSQL;

class Pages
{
    private $user;
    private $admin;
    private $product;
    private $category;
    private $order;
    private $sort;
    private $filter;

    public function __construct()
    {
        $this->user = new User();
        $this->admin = new Admin();
        $this->product = new Product();
        $this->category = new Categorie();
        $this->order = new Order();
        if(isset($_SESSION['sort']))
            $this->sort = $_SESSION['sort'];
        else  $this->sort = 'id';

        if(isset($_SESSION['filter'])) {
            $filt = $_SESSION['filter'];
            $this->filter = "WHERE category_id = $filt";
        } else $this->filter = '';
    }

    public function admin()
    {

        $user = new \application\model\User();
        $product = new \application\model\Product();
        $order = new \application\model\Order();

        $data = $_POST;
        $users = $user->get();
        $orders = $order->get();
        $products = $product->get();

        //finding users in database table
        if(isset($data['do_search'])){
            $category = $data['category'];
            switch ($category) {
                case 'id':
                    if($data['searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the id of user you want to find.</div>';
                        break;
                    }
                    if($user->exists('id', $data['searchbar'])){
                        $user->find('id', $data['searchbar']);
                        $users = array($user);
                    } else {
                        echo '<div class="text-center alert-danger">User with this id is not found!</div>';
                    }
                    break;
                case 'login':
                    if($data['searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the username of users you want to find.</div>';
                        break;
                    }
                    if($user->exists('login', $data['searchbar'])) {
                        $users = $user->where('login', $data['searchbar'])->get();
                    } else {
                        echo '<div class="text-center alert-danger">Users with this username are not found!</div>';
                    }
                    break;
                case 'email':
                    if($data['searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the email of user you want to find.</div>';
                        break;
                    }
                    if($user->exists('email', $data['searchbar'])) {
                        $users = $user->where('email', $data['searchbar'])->get();
                    } else {
                        echo '<div class="text-center alert-danger">Users with this email is not found!</div>';
                    }
                    break;
                case '':
                    $users = $user->get();
                    break;
            }
        }

        //adding user to database table
        if(isset($data['do_insert'])){
            $errors = array();
            if(trim($data['newlogin']) == '')
                $errors[] = 'Enter username!';
            if(trim($data['newemail']) == '')
                $errors[] = 'Enter Email!';
            if($data['newpass'] == '')
                $errors[] = 'Enter password!';
            if($user->exists('login', $data['newlogin']))
                $errors[] = 'User with this login is already exists. Come up with another login.';
            if($user->exists('email', $data['newemail']))
                $errors[] = 'User with this email is already exists. Use another email.';
            if (empty($errors)){
                $user->note(array('login', 'email', 'password'), array($data['newlogin'],
                    $data['newemail'], password_hash($data['newpass'], PASSWORD_DEFAULT)));
                $user->save();
            } else {
                echo '<div class="alert-warning text-center">'.array_shift($errors).'</div>';
            }
        }

        //finding products in database table
        if(isset($data['do_prod_search'])){
            $category = $data['prod_category'];
            switch ($category) {
                case 'id':
                    if($data['prod_searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the id of product you want to find.</div>';
                        break;
                    }
                    if($product->exists('id', $data['prod_searchbar'])){
                        $product->find('id', $data['prod_searchbar']);
                        $products = array($product);
                    } else {
                        echo '<div class="text-center alert-danger">Product with this id is not found!</div>';
                    }
                    break;
                case 'name':
                    if($data['prod_searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the name of product you want to find.</div>';
                        break;
                    }
                    if($product->exists('name', $data['prod_searchbar'])) {
                        $products = $product->where('name', $data['prod_searchbar'])->get();
                    } else {
                        echo '<div class="text-center alert-danger">Products with this name are not found!</div>';
                    }
                    break;
                case 'price':
                    if($data['prod_searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the price of products you want to find.</div>';
                        break;
                    }
                    if($product->exists('price', $data['prod_searchbar'])) {
                        $products = $product->where('price', $data['prod_searchbar'])->get();
                    } else {
                        echo '<div class="text-center alert-danger">Products with this price are not found!</div>';
                    }
                    break;
                case 'category':
                    if($data['prod_searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the category of products you want to find.</div>';
                        break;
                    }
                    if(@$product->exists('category_id', $this->category->getId($data['prod_searchbar']))) {
                        $products = $product->where('category_id', $this->category->getId($data['prod_searchbar']))->get();
                    } else {
                        echo '<div class="text-center alert-danger">Products in this category are not found!</div>';
                    }
                    break;
                case '':
                    $products = $product->get();
                    break;
            }
        }

        //adding product to database table
        if(isset($data['do_insert_prod'])){
            $errors = array();
            if(trim($data['newname']) == '')
                $errors[] = 'Enter name!';
            if(trim($data['newprice']) == '')
                $errors[] = 'Enter price!';
            if(trim($data['newimg']) == '')
                $errors[] = 'Add an image!';
            if(trim($data['category']) == '')
                $errors[] = 'Add a category!';
            if($data['newdescrp'] == '')
                $errors[] = 'Write a decription!';
            if($product->exists('name', $data['newname']))
                $errors[] = 'Product with this name is already exists. Come up with another name.';
            if(!$this->category->exists('category', $data['category']))
                $errors[] = 'No such category. Use only valid categories.';
            if (empty($errors)){
                $product->note(array('name', 'price', 'image', 'category_id', 'description'),
                    array($data['newname'], $data['newprice'],
                        $data['newimg'], $this->category->getId($data['category']), $data['newdescrp']));
                $product->save();
            } else {
                echo '<div class="alert-warning text-center">'.array_shift($errors).'</div>';
            }
        }

        if(isset($data['do_order_search'])){
            $category = $data['order_category'];
            switch ($category) {
                case 'id':
                    if($data['order_searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the id of order you want to find.</div>';
                        break;
                    }
                    if($order->exists('id', $data['order_searchbar'])){
                        $order->find('id', $data['order_searchbar']);
                        $orders = array($order);
                    } else {
                        echo '<div class="text-center alert-danger">Order with this id is not found!</div>';
                    }
                    break;
                case 'prod':
                    if($data['order_searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the product id of order you want to find.</div>';
                        break;
                    }
                    if($order->exists('product_id', $data['order_searchbar'])) {
                        $orders = $order->where('product_id', $data['order_searchbar'])->get();
                    } else {
                        echo '<div class="text-center alert-danger">Orders with this product id are not found!</div>';
                    }
                    break;
                case 'user':
                    if($data['order_searchbar'] == ''){
                        echo '<div class="text-center alert-warning">Please, enter the user id of order you want to find.</div>';
                        break;
                    }
                    if($order->exists('user_id', $data['order_searchbar'])) {
                        $orders = $order->where('user_id', $data['order_searchbar'])->get();
                    } else {
                        echo '<div class="text-center alert-danger">Orders with this user id are not found!</div>';
                    }
                    break;
                case '':
                    $orders = $order->get();
                    break;
            }
        }

        //output('table_products', $products);

        $vars = [
            'users' => $users,
            'user' => $user,
            'products' => $products,
            'product' => $product,
            'orders' => $orders,
            'order' => $order
        ];
        return $vars;
    }

    public function productsCount()
    {
        $quantity = count($this->product->row("SELECT * FROM products $this->filter ORDER BY $this->sort"));
        return  $quantity;
    }

    public function productsList($route, $max){
        $params = [
            'max' => $max,
            'start' => ($route - 1) * $max,
        ];
        return $this->product->row("SELECT * FROM products $this->filter ORDER BY $this->sort DESC LIMIT :start, :max", $params);
    }

    public function filter()
    {
        if(isset($_POST['do_sort']))
        {
            if($_POST['sort_by'] == 'latest')
            {
                $_SESSION['sort'] = 'id';
            } elseif ($_POST['sort_by'] == 'price')
            {
                $_SESSION['sort'] = 'price';
            }

            if(isset($_POST['filter_by']))
                $_SESSION['filter'] = $this->category->getId($_POST['filter_by']);

        }
    }

    public function order()
    {
        $data = $_POST;
        $vars = [];
        if(isset($data['make_order'])) {
            $array = explode('&', $data['order_arr']);
            $assoc_arr = array();

            foreach ($array as $value)
                $assoc_arr += [stristr($value, '=', true)
                => intval(trim(stristr($value, '='), '='))];

            foreach ($assoc_arr as $key => $value){
                $tmp = array($key, $data['user_id'], $value);
                $this->order->note(array('product_id', 'user_id', 'quantity'), $tmp);
                $this->order->save();
                $vars[] = $tmp;
            }
            setcookie('cart', '', time() - 3600, "/");
        }
        return $vars;
    }
}