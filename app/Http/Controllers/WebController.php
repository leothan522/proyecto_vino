<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class WebController extends Controller
{

    public function __construct()
    {
        if (!session()->has('rowquid')){
            session(['rowquid' => Str::random()]);
        }
    }

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
        $producto = Producto::find($id);
        $carrito = Carrito::where('rowquid', session('rowquid'))->where('productos_id', $id)->exists();

        if (!$producto || (!$producto->is_active && !$carrito)){
            //return redirect()->route('web.index');
        }

        return view('web.products-single.index')
            ->with('productos_id', $id);
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
