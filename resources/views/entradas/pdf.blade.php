<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #{{ $entrada->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .factura {
            border: 1px solid #dee2e6;
            padding: 20px;
            background-color: #fff;
        }
        .factura-header {
            border-bottom: 2px solid #4a6cf7;
            margin-bottom: 20px;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .factura-title {
            font-size: 24px;
            color: #4a6cf7;
            font-weight: bold;
        }
        .factura-subtitle {
            color: #6c757d;
            font-size: 14px;
        }
        .factura-info {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .factura-info-section {
            width: 48%;
        }
        .factura-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .factura-table th, .factura-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }
        .factura-table th {
            background-color: #f8f9fa;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .factura-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
        }
        .sello {
            border: 2px dashed #dc3545;
            color: #dc3545;
            display: inline-block;
            padding: 5px 10px;
            font-weight: bold;
            transform: rotate(-15deg);
            position: absolute;
            top: 40%;
            right: 10%;
            font-size: 18px;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="factura">
        <div class="sello">PAGADO</div>
        
        <div class="factura-header">
            <div>
                <h1 class="factura-title">FACTURA</h1>
                <p class="factura-subtitle">Sistema de Gestión de Inventario</p>
            </div>
            <div style="text-align: right;">
                <h2>Factura #{{ $entrada->id }}</h2>
                <p>Fecha: {{ $entrada->fecha->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="factura-info">
            <div class="factura-info-section">
                <h3>Proveedor:</h3>
                <p><strong>{{ $entrada->proveedor->nombre }}</strong></p>
                <p>Empresa: {{ $entrada->proveedor->empresa }}</p>
                <p>Contacto: {{ $entrada->proveedor->contacto }}</p>
            </div>
            <div class="factura-info-section" style="text-align: right;">
                <h3>Detalles de la Entrada:</h3>
                <p>Fecha de Registro: {{ $entrada->created_at->format('d/m/Y H:i:s') }}</p>
                <p>ID de Entrada: {{ $entrada->id }}</p>
            </div>
        </div>

        <table class="factura-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-right">Precio Unitario</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $entrada->producto->nombre }}</strong><br>
                        <small>{{ $entrada->producto->descripcion }}</small>
                    </td>
                    <td class="text-center">{{ $entrada->cantidad }}</td>
                    <td class="text-right">${{ number_format($entrada->precio_unitario, 2) }}</td>
                    <td class="text-right">${{ number_format($entrada->subtotal, 2) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                    <td class="text-right">${{ number_format($entrada->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                    <td class="text-right"><strong>${{ number_format($entrada->total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="factura-footer">
            <div style="width: 60%;">
                <h3>Notas:</h3>
                <p>Esta factura es un comprobante de la entrada de inventario registrada en el sistema.</p>
                <p>El stock del producto ha sido actualizado automáticamente.</p>
            </div>
            <div style="width: 35%; text-align: right;">
                <p>Generado por:</p>
                <p><strong>Sistema de Gestión de Inventario</strong></p>
            </div>
        </div>
    </div>
</body>
</html>