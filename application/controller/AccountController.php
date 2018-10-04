<?php
namespace application\controller;
use application\core\Controller;
use application\core\View;
use application\model\User;

class AccountController extends Controller
{
    public function loginAction()
    {
        unset($_SESSION['recovery']);
        $this->model->login();
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $this->view->redirect('/bakeryin/authorization');
        } elseif(isset($_SESSION['admin'])){
            $this->view->redirect('/bakeryin/admin');
        } else {
            $this->view->redirect('/bakeryin/');
        }
    }

    public function registerAction()
    {
        $user = new User();
        $errors = [];
        if(!empty($_POST)){
            if(!$this->model->validate(['email', 'login', 'password'], $_POST)){
                $errors[] = $this->model->error;
            }
            if($user->exists('email', $_POST['email'])){
                $errors[] = 'User with this email is already exists. Use another email.';
            }
            if($user->exists('login', $_POST['login'])){
                $errors[] = 'User with this login is already exists. Come up with another login.';
            }
            if ($_POST['password'] != $_POST['rep_password']){
                $errors[] = 'Repeated password does not match with original one!';
            }
            if(!$_POST['g-recaptcha-response']){
                $errors[] = 'Fill the captcha';
            }

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $key = '6LeI6VwUAAAAAAsIZILpDQCeAs_rU_JdDhtwt2Lo';
            $query = $url.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].
                '&remoteip='.$_SERVER['REMOTE_ADDR'];
            $data = json_decode(file_get_contents($query));

            if($data->success == false){
                $errors[] = 'Recaptcha has been entered incorrectly';
            }

            $_SESSION['errors'] = $errors;

            if(empty($errors))
            {
                $this->model->register($_POST);
            }
        }
        $this->view->redirect('/bakeryin/registration');
    }

    public function confirmRegistrationAction()
    {
        $this->model->checkToken($_SERVER['REQUEST_URI']);
        $this->view->redirect('/bakeryin/registration');
    }

    public function startRecoveryAction()
    {
        $_SESSION['recovery'] = 'begin';
        $this->view->redirect('/bakeryin/authorization');
    }

    public function recoveryAction()
    {
        $this->model->recovery($_POST);
        $this->view->redirect('/bakeryin/authorization');
    }

    public function confirmRecoveryAction()
    {
        $this->model->finishRecovery($_SERVER['REQUEST_URI']);
        $this->view->redirect('/bakeryin/authorization');
    }

    public function logoutAction()
    {
        $this->model->logout();
        $this->model->adminOut();
        $this->view->redirect('/bakeryin/');
    }

    public function adm_outAction()
    {
        $this->model->adminOut();
        $this->view->redirect('/bakeryin/');
    }

    public function addToCartAction()
    {
        $this->model->addToCart();
        $this->view->redirect('/bakeryin/gallery?page=1');
    }

    public function closeAction()
    {
        $this->model->close();
        $this->view->redirect('/bakeryin/cart');
    }

    public function payAction()
    {
        $this->model->pay();
        $_SESSION['info'] = $_POST['text'];
        $this->view->redirect('/bakeryin/cart/payment');
    }

    public function editProductAction()
    {
        $this->model->editProduct();
        $this->view->redirect('/bakeryin/admin?page=2');
    }
    public function editUserAction()
    {
        $this->model->editUser();
        $this->view->redirect('/bakeryin/admin?page=1');
    }
    public function editOrderAction()
    {
        $this->model->editOrder();
        $this->view->redirect('/bakeryin/admin?page=3');
    }

}