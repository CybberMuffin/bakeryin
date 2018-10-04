<?php

namespace application\controller;
use application\core\Controller;
use application\libs\Pagination;

class PagesController extends Controller
{
    public function mainAction()
    {
        $this->view->render('Bakery in');
    }

    public function registrationAction()
    {
        $this->view->render('Registration');
    }

    public function authorizationAction()
    {
        $this->view->render('Authorization');
    }

    public function adminAction()
    {
        $vars = $this->model->admin();
        $this->view->render('Admin`s page', $vars);
    }

    public function aboutAction()
    {
        $this->view->render('About');
    }

    public function contactsAction()
    {
        $this->view->render('Our Contacts');
    }

    public function galleryAction()
    {
        $page = substr(basename($_SERVER['REQUEST_URI']),13);
        $max = 6;
        $pagination = new Pagination($this->route, $this->model->productsCount(), $max, $page);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->productsList($page, $max)
        ];
        $this->view->render('Gallery', $vars);
    }

    public function filterAction()
    {
        $this->model->filter();
        header('location: /bakeryin/gallery?page=1');
    }

    public function servicesAction()
    {
        $this->view->render('Services');
    }

    public function productAction()
    {
        $this->view->render('Your cake');
    }

    public function cartAction()
    {
        $this->view->render('Your cart');
    }

    public function paymentAction()
    {
        $vars = [
            'arr' => $this->model->order(),
        ];
        $this->view->render('Payment', $vars);
    }

}