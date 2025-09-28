<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido #{{ $pedido->codigo }}</title>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <style>
        body {
            font-family: monospace, Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0.5rem;
            color: #000;
        }
        .recibo {
            width: 100%;
            max-width: 280px;
            margin: auto;
        }
        .empresa {
            text-align: center;
            margin-bottom: 0.8rem;
            line-height: 1.3;
        }
        .titulo {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 0.8rem;
        }
        .dato {
            margin-bottom: 0.3rem;
        }
        .productos {
            margin: 0.5rem 0;
        }
        .productos li {
            margin-bottom: 0.2rem;
        }
        .totales {
            margin-top: 0.5rem;
            font-weight: bold;
        }
        .totales div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.3rem;
        }
        .qr {
            text-align: center;
            margin-top: 1rem;
        }
        .qr img {
            width: 80px;
            height: auto;
        }
        hr {
            border: none;
            border-top: 1px dashed #999;
            margin: 0.8rem 0;
        }
    </style>
</head>
<body>
<div class="recibo">
    <div class="empresa">
        <strong>{{ getParametro('contact_nombre') }}</strong><br>
        RIF: {{ getParametro('contact_rif') }}<br>
        Tel: {{ getParametro('contact_telefono') }}<br>
        {{ getParametro('contact_direccion') }}
    </div>

    <div class="titulo">Pedido #{{ $pedido->codigo }}</div>

    <div class="dato">Cliente: <strong>{{ \Str::upper($pedido->nombre) }}</strong></div>
    <div class="dato">Teléfono: <strong>{{ \Str::upper($pedido->telefono) }}</strong></div>
    <div class="dato">Fecha: <strong>{{ $pedido->created_at->format('d/m/Y') }}</strong></div>

    <hr>

    <div class="dato">Municipio: <strong>{{ \Str::upper($pedido->bodega) }}</strong></div>
    <div class="dato">Parroquia: <strong>{{ \Str::upper($pedido->parroquia) }}</strong></div>
    <div class="dato">Dirección: <strong>{{ \Str::upper($pedido->direccion . ' ' . $pedido->direccion2) }}</strong></div>

    <hr>

    <strong>Productos:</strong>
    <ul class="productos">
        @foreach($pedido->items as $item)
            <li>{{ \Str::upper($item->producto) }} x{{ $item->cantidad }} — ${{ formatoMillares($item->precio * $item->cantidad) }}</li>
        @endforeach
    </ul>

    <div class="totales">
        <div><span>Subtotal:</span> <span>${{ formatoMillares($pedido->subtotal) }}</span></div>
        <div><span>Entrega:</span> <span>${{ formatoMillares($pedido->entrega) }}</span></div>
        <div><span>Total:</span> <span>${{ formatoMillares($pedido->total) }}</span></div>
    </div>

    <hr>

    @foreach($pedido->pagos->where('is_validated', true) as $pago)
        <div class="dato">Método: <strong>{{ \Str::upper($pago->metodo) === 'PAGOMOVIL' ? 'PAGO MÓVIL' : 'TRANSFERENCIA' }}</strong></div>
        <div class="dato">Referencia: <strong>{{ \Str::upper($pago->referencia) }}</strong></div>
        <div class="dato">Monto: <strong>Bs. {{ formatoMillares($pago->monto) }}</strong></div>
    @endforeach

    @if($qr)
        <div class="qr">
            <p>Link de entrega:</p>
            <img src="{{ $qr }}" alt="QR de entrega">
        </div>
    @endif
</div>
</body>
</html>
