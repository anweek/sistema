<?php
require_once '../src/models/Proveedor.php';
$proveedorModel = new Proveedor();
$estadisticas = $proveedorModel->contarPorCategoria(); // Asegúrate de tener este método
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas de Proveedores</title>
    <link rel="stylesheet" href="/sistema/src/templates/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .grafico-container {
            width: 400px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="grafico-container">
        <h2>Proveedores por Categoría</h2>
        <canvas id="graficoProveedores" width="400" height="300"></canvas>
    </div>

    <script>
        const datos = {
            labels: <?= json_encode(array_column($estadisticas, 'categoria')) ?>,
            datasets: [{
                label: 'Cantidad',
                data: <?= json_encode(array_column($estadisticas, 'total')) ?>,
                backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f1c40f', '#9b59b6'],
                borderRadius: 5
            }]
        };

        const config = {
            type: 'bar',
            data: datos,
            options: {
                responsive: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 0.5,
                            callback: function(value) {
                                return value % 1 === 0 ? value.toFixed(0) : value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };

        new Chart(document.getElementById('graficoProveedores'), config);
    </script>
</body>
</html>

