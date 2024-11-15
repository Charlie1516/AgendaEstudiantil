<?php
// Cargar tareas
$tareasFile = 'tareas.json';
$tareas = [];
if (file_exists($tareasFile)) {
    $tareas = json_decode(file_get_contents($tareasFile), true);
}

$tareasPorFecha = [];
foreach ($tareas as $tarea) {
    $tareasPorFecha[$tarea['fecha']][] = $tarea['titulo'];
}

// Generar un año completo
$year = date('Y');
$months = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Completo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #001f3f; /* Azul oscuro */
            color: white;
        }
        .calendar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .month {
            border: 1px solid #ffffff;
            margin: 10px;
            padding: 10px;
            flex: 1 1 30%;
            min-width: 300px;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .month-name {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }
        .day {
            padding: 10px;
            border: 1px solid #ffffff;
            position: relative;
            height: 80px; /* Ajusta la altura según sea necesario */
            transition: background-color 0.3s ease; /* Transición suave */
        }
        .day:hover {
            background-color: yellow; /* Color amarillo al pasar el mouse */
            cursor: pointer; /* Cambiar el cursor al pasar por encima */
        }
        .event {
            background-color: #007bff;
            color: white;
            padding: 2px;
            margin-top: 5px;
            border-radius: 3px;
            font-size: 0.8em;
        }
        h1 {
            text-align: center; /* Centra el título */
            margin-bottom: 20px; /* Agrega un espacio inferior */
        }
    </style>
</head>

<body>
    <h1>Calendario del Año <?= $year ?></h1>
    <div class="calendar">
        <?php foreach ($months as $month => $monthName): ?>
            <div class="month">
                <div class="month-name"><?= $monthName ?></div>
                <div class="days">
                    <?php
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month + 1, $year);
                    $firstDay = (int)date('N', strtotime("$year-$month+1-01"));

                    for ($i = 1; $i < $firstDay; $i++): ?>
                        <div class="day"></div>
                    <?php endfor; ?>

                    <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
                        <div class="day" id="<?= "$year-$month-$day" ?>">
                            <?= $day ?>
                            <?php
                            $fechaActual = "$year-" . str_pad($month + 1, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT);
                            if (isset($tareasPorFecha[$fechaActual])) {
                                foreach ($tareasPorFecha[$fechaActual] as $tarea) {
                                    echo "<div class='event'>$tarea</div>";
                                }
                            }
                            ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
