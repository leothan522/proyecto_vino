<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Producto;
use App\Models\Promotor;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebController extends Controller
{

    public function __construct()
    {
        if (!session()->has('rowquid')) {
            session(['rowquid' => Str::random()]);
        }
    }

    public function index($codigo = null)
    {
        if ($codigo){
            $promotor = Promotor::where('codigo', $codigo)->first();
            if (verificarCodigoPromotor($promotor)){
                session(['promotores_id' => $promotor->id]);
            }else{
                session()->forget('promotores_id');
            }
        }
        return view('web.inicio.index');
    }

    public function about()
    {
        return view('web.about.index');
    }

    public function home()
    {
        return view('web.home.index');
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

        if (!$producto || (!$producto->is_active && !$carrito)) {
            return redirect()->route('web.index');
        }

        return view('web.products-single.index')
            ->with('productos_id', $id);
    }

    public function cart()
    {
        return view('web.cart.index');
    }

    public function checkout($rowquid)
    {
        $pedido = Pedido::where('rowquid', $rowquid)
            ->where('users_id', auth()->id())
            ->where('is_process', true)
            ->first();
        if (!$pedido) {
            return redirect()->route('web.index');
        }

        $items = Carrito::where('rowquid', $rowquid)->get();
        foreach ($items as $item) {
            PedidoItem::create([
                'pedidos_id' => $pedido->id,
                'producto' => $item->producto->nombre,
                'tipo' => $item->producto->tipo->nombre,
                'precio' => $item->producto->precio,
                'descripcion' => $item->producto->descripcion,
                'imagen_path' => $item->producto->imagen_path,
                'almacen' => $item->almacen->nombre,
                'cantidad' => $item->cantidad,
                'productos_id' => $item->productos_id,
                'almacenes_id' => $item->almacenes_id,
            ]);

            //descuento el stock disponible
            $stock = Stock::where('almacenes_id', $item->almacenes_id)->where('productos_id', $item->productos_id)->first();
            if ($stock) {
                $stock->disponibles = $stock->disponibles - $item->cantidad;
                $stock->comprometidos = $stock->comprometidos + $item->cantidad;
                $stock->save();
            }
            //Vacio el carrito
            $item->delete();
            session()->forget('rowquid');
        }

        return view('web.checkout.index')
            ->with('rowquid', $rowquid);
    }

    public function profile()
    {
        return view('web.profile.index');
    }

    public function descargar()
    {
        $path = 'descargas/Vino-Don-Juan-Espinoza.apk';
        if (Storage::disk('public')->exists($path)){
            return Storage::disk('public')->download($path);
        }
        return redirect()->route('web.index');
    }

    public function compartir()
    {
        $qrAndroid = qrCodeGenerate(\route('web.compartir'), null, null, 'qr-android-download');
        $qrIos = qrCodeGenerate(\route('web.index'), null, null, 'qr-ios-download');
        return view('web.compartir.index')
            ->with('qrAndroid', $qrAndroid)
            ->with('qrIos', $qrIos);
    }

}
