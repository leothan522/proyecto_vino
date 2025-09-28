<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido #{{ $pedido->codigo }}</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
        body {
            font-family: monospace, Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0.5rem;
            color: #000;
            background: #fff;
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
    <script>
        window.onload = function () {
            const before = Date.now();
            window.print();
            setTimeout(() => {
                const after = Date.now();
                if (after - before < 1000) {
                    window.close(); // impresión cancelada
                } else {
                    window.close(); // impresión completada
                }
            }, 500);
        };
    </script>
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
