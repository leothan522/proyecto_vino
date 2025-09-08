<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class WebController extends Controller
{
    public function index()
    {
        return view('web.inicio.index');
    }

    public function about()
    {
        return view('web.about.index');
    }

    public function home($facturacion = null)
    {
        return view('web.home.index')
            ->with('facturacion', $facturacion);
    }

    public function blog()
    {
        return view('web.blog.index');
    }

    public function contact()
    {
        return view('web.contact.index');
    }

    public function products()
    {
        return view('web.products.index');
    }

    public function single($id)
    {
        return view('web.products-single.index');
    }

    public function cart()
    {
        return view('web.cart.index');
    }

    public function checkout()
    {
        return view('web.checkout.index');
    }

    public function profile()
    {
        return view('web.profile.index');
    }

}
