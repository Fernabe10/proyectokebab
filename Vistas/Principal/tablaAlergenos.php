<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

require_once 'cargadores/autocargador.php';

ob_end_clean();

$repoAlergeno = new RepoAlergeno();
$alergenos = $repoAlergeno->getAllAlergenos();

$dompdf = new Dompdf();

$html = '
<html>
<head>
<style>
body {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
h1 {
    text-align: center;
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
    margin-top: 30px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 50px;
}
th, td {
    text-align: left;
    font-size: 1rem;
    border-bottom: 1px solid #ddd;
}
th {
    padding: 5px;
    background-color: #f4f4f4;
    color: #555;
}
td {
    padding: 12px;
    color: #555;
    font-size: 1rem;
    background-color: #fff;
}
tr:nth-child(even) {
    background-color: #fafafa;
}
tr:hover {
    background-color: #f0f0f0;
}
td:first-child {
    font-weight: 600;
}
td:nth-child(4) {
    color: #28a745; 
}
td:nth-child(7) {
    font-weight: bold; 
}
td[colspan="8"] {
    text-align: center;
    font-style: italic;
    color: #888;
}
</style>
</head>
<body>
    <h1>Tabla de Alérgenos - Kebab Express</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre del Alérgeno</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>';
foreach ($alergenos as $alergeno) {
    $base64Image = $alergeno->getFoto();
    $html .= '
        <tr>
            <td>' . $alergeno->getNombre() . '</td>
            <td><img src="data:image/jpeg;base64,' . $base64Image . '" alt="Foto de ' . $alergeno->getNombre() . '" style="width: 50px; height: auto;"></td>
        </tr>';
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream("Tabla_Alergenos.pdf", ["Attachment" => true]);
?>