<!DOCTYPE html>
<html>
<head>
    <title>Monitor ESP32</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: monospace; background: #111; color: #0f0; padding: 20px; }
        #consola { white-space: pre-line; }
    </style>
</head>
<body>
    <h2>Consola ESP32</h2>
    <div id="consola">Esperando mensajes...</div>

    <script>
        function actualizarConsola() {
            fetch("{{ url('/api/mensajes-esp32') }}")
                .then(res => res.json())
                .then(data => {
                    document.getElementById("consola").innerText = data.mensaje || "Sin datos...";
                });
        }

        setInterval(actualizarConsola, 1000); // Actualiza cada segundo
        actualizarConsola();
    </script>
</body>
</html>
