<?php
namespace application\model;

use application\core\Model;
use application\libs\DBSQL;

class Account
{
    private $user;
    private $admin;
    private $order;
    private $product;
    private $category;
    private $cart = [];

    public function __construct()
    {
        $this->user = new User();
        $this->nonact = new Nonactive();
        $this->admin = new Admin();
        $this->order = new Order();
        $this->product = new Product();
        $this->category = new Categorie();
    }

    public function login()
    {
        $data = $_POST;
        if(isset($data['do_login']))
        {
            $errors = array();
            if($this->user->exists('login', $data['login']))
            {
                $this->user->find('login', $data['login']);
                if(password_verify($data['password'], $this->user->password)) #password verification
                {
                    if($this->user->status == 1)
                    {
                        $_SESSION['logged_user'] = $this->user->login;

                        setcookie("login", $this->user->login, time() + (86400 * 30), "/");
                        setcookie("id", $this->user->id, time() + (86400 * 30), "/");


                        if($this->admin->exists('user_id', $this->user->id))
                        {
                            $_SESSION['admin'] = $this->user->login;
                        }
                    }
                    else {
                        $errors[] = "Confirm your email first.";
                    }
                } else
                {
                    $errors[] = "The password is invalid!";
                }
            } else
            {
                $errors[] = 'User with this username is not found!';
            }
            if(!empty($errors))
            {
                $_SESSION['errors'] = $errors;
            }

        }
    }

    public function recovery($data)
    {
        if(isset($data['do_recovery']))
        {
            $errors = array();
            if($this->user->exists('email', $data['r_email']))
            {
                $this->user->find('email', $data['r_email']);
                if($this->user->status == 1)
                {
                    if(preg_match('#^[a-z0-9]{5,20}$#', $data['new_password'])) {
                        $token = $this->createToken();
                        $this->user->token = $token;
                        $this->user->save();
                        mail($data['r_email'], 'Finish the recovery',
                            'Follow the link below to finish recovery of your password, ' . $this->user->login .
                            ':  http://localhost/bakeryin/account/recovery/confirm?token=' . $token,
                            'From: bakeryin@bestbakery.com');
                        $_SESSION['newpass'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
                        $_SESSION['success'][] = 'Success! Now follow the link on your email to finish recovery!';
                    } else {
                        $errors[] = 'Password is not correct (Only latin letters and numbers allowed from 5 up to 20 symbols)';
                    }
                } else {
                    $errors[] = 'Your account is not activated. Check your email first.';
                }
            } else {
                $errors[] = 'User with this email is not found!';
            }
            $_SESSION['r_errors'] = $errors;
        }
    }

    public function finishRecovery($url)
    {
        $token = substr(basename($url), 14);
        $this->user->find('token', $token);
        $this->user->token = 'activated';
        $this->user->password = $_SESSION['newpass'];
        $this->user->save();
        unset($_SESSION['newpass']);
        $_SESSION['success'][] = 'You successfully updated your password!';
    }

    public function validate($input, $post)
    {
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'E-mail address is not correct!',
            ],
            'login' => [
                'pattern' => '#^[A-Za-z0-9]{3,15}$#',
                'message' => 'Username is not correct (Only latin letters and numbers allowed from 3 up to 15 symbols)',
            ],
            'password' => [
                'pattern' => '#^[a-z0-9]{5,20}$#',
                'message' => 'Password is not correct (Only latin letters and numbers allowed from 5 up to 20 symbols)',
            ]
        ];

        foreach ($input as $val) {
            if(!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }
        return true;
    }

    private function createToken()
    {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
    }

    public function register($data)
    {
        $token = $this->createToken();
        $this->user->note(array('login', 'email', 'password', 'token', 'status'), array($data['login'],
            $data['email'], password_hash($data['password'], PASSWORD_DEFAULT), $token, 0));
        $this->user->save();
        $this->user->find('email', $data['email']);

        $this->nonact->note(array('user_id', 'email'), array($this->user->id, $data['email']));
        $this->nonact->save();

        mail($data['email'], 'Confirm your email',
            'Thanks for registration on our website, '.$data['login'].
            '. Confirm your email and finish the registration here: 
            http://localhost/bakeryin/registration/confirm?token='.$token,
            'From: bakeryin@bestbakery.com');
        $_SESSION['success'][] = 'Success! Now confirm your email to finish registration!';
    }

    public function checkToken($url)
    {
        $token = substr(basename($url), 14);
        $this->user->find('token', $token);
        $this->user->status = 1;
        $this->user->token = 'activated';
        $this->user->save();

        $this->nonact->find('user_id', $this->user->id);
        $this->nonact->delete();

        $_SESSION['success'][] = 'You have been successfully registrated on our website!';
    }

    public function logout()
    {
        unset($_SESSION['logged_user']);
        setcookie('login', '', time() - 3600, "/");
        setcookie('id', '', time() - 3600, "/");
        setcookie('cart', '', time() - 3600, "/");
    }

    public function adminOut()
    {
        session_start();
        if(isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
    }

    public function addToCart()
    {
        $data = $_POST;
        if(isset($data['buy'])) {
            if (isset($_COOKIE['cart'])) {
                $this->cart = json_decode($_COOKIE['cart'], true);
            }

            array_key_exists($data['prod_id'], $this->cart) ?
                $this->cart[$data['prod_id']]++ :
                $this->cart += [$data['prod_id'] => 1];

            $json_cart = json_encode($this->cart);

            setcookie('cart', $json_cart, time() + (86400 * 30), "/");
        }
    }

    public function close()
    {
        $data = $_POST;
        if (isset($data['close']))
        {
            if(isset($_COOKIE['cart'])) {
                $this->cart = json_decode($_COOKIE['cart'], true);
            }

            unset($this->cart[$data['prod_id']]);

            $json_cart = json_encode($this->cart);

            setcookie('cart', $json_cart,  time() + (86400 * 30), "/");
        }

        if(isset($data['change']))
        {
            if (isset($_COOKIE['cart'])) {
                $this->cart = json_decode($_COOKIE['cart'], true);
            }

            if($data['quantity'] != 0) {
                array_key_exists($data['prod_id'], $this->cart) ?
                    $this->cart[$data['prod_id']] = $data['quantity'] :
                    $this->cart += [$data['prod_id'] => 1];
            } else {
                unset($this->cart[$data['prod_id']]);
            }

            $json_cart = json_encode($this->cart);

            setcookie('cart', $json_cart, time() + (86400 * 30), "/");
        }
    }

    public function pay()
    {
        if(isset($_POST['pay'])){
            if(preg_match('#^(\d{4}([-]|)\d{4}([-]|)\d{4}([-]|)\d{4})$#', $_POST['card'])) {
                if(isset($_POST['address']) && !empty($_POST['address'])) {
                    $id = $_COOKIE['id'];
                    $orders = new Order();
                    $orders = $this->order->where('user_id', $id)->get();
                    for ($i = 0; $i < count($orders) - 1; $i++) {
                        $order = new Order();
                        $order->find('paid', 0);
                        $order->paid = 1;
                        $order->delivered = $_POST['address'];
                        $order->save();

                        $address = new Addres();
                        $address->note(array('user_id', 'address'), array($order->user_id, $_POST['address']));
                        $address->save();
                    }
                    $_SESSION['success'][] = 'Success! Await your delivery.';
                } else {
                    $_SESSION['errors'][] = 'Enter your address.';
                }
            } else {
                $_SESSION['errors'][] = 'Credit card number is not valid.';
            }
        }
    }
    public function editProduct()
    {
        if(isset($_POST['edit_prod']))
        {
            $this->product->find('id', $_POST['product_id']);
            $this->product->name = $_POST['name'];
            $this->product->price = $_POST['price'];
            $this->product->image = $_POST['image'];
            if($this->category->exists('category', $_POST['category']))
                $this->product->category_id = $this->category->getId($_POST['category']);
            else $this->product->category_id = 1;
            $this->product->description = $_POST['description'];

            $this->product->save();

            unset($_POST['edit_prod']);
        }
        if(isset($_POST['delete_prod'])) {
            $this->product->find('id', $_POST['product_id']);
            $this->product->delete();
            //unset($_POST['delete_prod']);
        }
    }

    public function editUser()
    {
        if(isset($_POST['edit']))
        {
            $this->user->find('id', $_POST['id']);
            $this->user->login = $_POST['login'];
            $this->user->email = $_POST['email'];
            if($this->user->password !== $_POST['password']) {
                $this->user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            $this->user->save();

            unset($_POST['edit']);
        }
        if(isset($_POST['delete'])) {
            $this->user->find('id', $_POST['id']);
            $this->user->delete();
            //unset($_POST['delete']);
        }
    }

    public function editOrder()
    {
        if(isset($_POST['edit_order']))
        {
            $this->order->find('id', $_POST['order_id']);
            $this->order->paid = $_POST['paid'];
            $this->order->delivered = $_POST['deliver'];

            $this->order->save();

            unset($_POST['edit_order']);
        }
        if(isset($_POST['delete_order'])) {
            $this->order->find('id', $_POST['order_id']);
            $this->order->delete();
        }
    }
}
