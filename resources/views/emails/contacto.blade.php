<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje de contacto</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f5f5f7; margin: 0; padding: 40px 16px; color: #1d1d1f; }
        .card { background: #ffffff; max-width: 560px; margin: 0 auto; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,.06); }
        .header { background: #0066cc; padding: 40px 40px 32px; }
        .header img { height: 32px; }
        .header h1 { color: #fff; font-size: 22px; font-weight: 700; margin: 16px 0 0; }
        .body { padding: 40px; }
        .field { margin-bottom: 24px; }
        .label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: #6e6e73; margin-bottom: 6px; }
        .value { font-size: 16px; color: #1d1d1f; line-height: 1.6; }
        .message-box { background: #f5f5f7; border-radius: 12px; padding: 20px; font-size: 15px; line-height: 1.7; color: #1d1d1f; white-space: pre-wrap; }
        .footer { padding: 24px 40px; border-top: 1px solid #f0f0f0; font-size: 11px; color: #aeaeb2; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="{{ config('app.url') }}/images/logo-ambiderm.png" alt="Ambiderm">
            <h1>Nuevo mensaje de contacto</h1>
        </div>
        <div class="body">
            <div class="field">
                <div class="label">Nombre</div>
                <div class="value">{{ $datos['nombre'] }}</div>
            </div>
            <div class="field">
                <div class="label">Correo</div>
                <div class="value"><a href="mailto:{{ $datos['correo'] }}" style="color:#0066cc;">{{ $datos['correo'] }}</a></div>
            </div>
            <div class="field">
                <div class="label">Mensaje</div>
                <div class="message-box">{{ $datos['mensaje'] }}</div>
            </div>
        </div>
        <div class="footer">
            Este mensaje fue enviado desde el formulario de contacto de ambiderm.com.mx
        </div>
    </div>
</body>
</html>
