<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_cliente , per.nombres , per.apellidos ,per.DNI ,per.Tipo_habitacion , per. Fecha_reserva ,per. hora_ingreso ,per. hora_salida ,per.celular
  FROM promociones pro 
  INNER JOIN cliente per ON per.id = pro.id_cliente
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$cliente = $sentencia->fetch(PDO::FETCH_OBJ);


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.green-api.com/waInstance1101816209/sendFileByUpload/b4bf0fe66780425a840e30483ff62c56037c18ed260c4ee19f",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array(
        'chatId' => "51".$cliente->celular."@c.us",
        'caption' => 'Estimado(a) '.strtoupper($cliente->nombres).' '.strtoupper($cliente->apellidos).' '.strtoupper($cliente->DNI).' No se pierda '.strtoupper($cliente->promocion).' valido solo '.$cliente->duracion.'',
        'file' => curl_file_create('img/hotel.jpg', 'image/hotel.jpg', 'hotel.jpg')
    ),
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: multipart/form-data"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
?>
<!-- --------$ -->

