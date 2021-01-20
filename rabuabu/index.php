<html>
<head>
    <style type = "text/css">
        html{
            background-image:url("bgrabuabu.jpeg");
            background-size:cover;
            background-repeat:no-repeat;
            background-attachment:fixed;
        }
        
        body{
            margin: 0px;
        }
        
        .Judul{
            text-align: center;
            font-family: monospace;
            font-size: 60px;
            color: yellow;
            -webkit-text-stroke:2px #000000;
            background-color:rgba(153, 255, 231,0.4);
            position:absolute;
            top:1%;
            left:8.5%;
            right: 8.5%;
            display:inline-block;
        }
        
        .container{
            white-space: pre;
            font-family: monospace;
            font-size: 28pt;
            position: fixed;
            display: table;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 50px;
            background-color: rgb(255 255 255 / 60%);
        }
        
        #footer{
            font-family: monospace;
            position: absolute;
            bottom: 0px;
            width: 100%;
            background-color: rgb(255 255 255 / 80%);
            text-align: center;
            display: table;
            padding: 5px 0px;
        }
    </style>
</head>
<body onload = "rem">
<h1 class="Judul">Katedral Santo Yosef Pangkalpinang</h1>
<div class = "container">
<?php

$SEAT = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);

if(!isset($_GET['nama']) || !isset($_GET['kbg'])){
    $DIV = "<div>QR Code tidak valid</div>";
    echo $DIV;
    goto endoftag;
}
$id = $_GET['nama'] . '_' . $_GET['kbg'];

$check = file_get_contents("scanned");
if(strpos($check, $id) !== FALSE){
    $DIV = "<div>Sudah scan</div>";
    echo $DIV;
    goto endoftag;
}

$check = file_get_contents("petugas");
if(strpos($check, $id) !== FALSE){
    $nama_DIV = "<div>Nama: " . $_GET['nama'] . "</div>";
    $kbg_DIV = "<div>KBG : " . $_GET['kbg'] . "</div>";
    $petugas_DIV = "<div>Petugas</div>";
    echo $nama_DIV;
    echo $kbg_DIV;
    echo $petugas_DIV;
    file_put_contents("scanned", $id . " petugas\n", FILE_APPEND);
    goto endoftag;
}

$check = file_get_contents("umat");
if(strpos($check, $id) !== FALSE){
    $seat = (int) file_get_contents("currentSeat");
    if($seat >= count($SEAT)) die("gereja sudah penuh");
    $nama_DIV = "<div>Nama : " . $_GET['nama'] . "</div>";
    $kbg_DIV = "<div>KBG  : " . $_GET['kbg'] . "</div>";
    $seat_DIV = "<div>Nomor: " . $SEAT[$seat] . "</div>";
    echo $nama_DIV;
    echo $kbg_DIV;
    echo $seat_DIV;
    file_put_contents("scanned", $id . " " . $SEAT[$seat] . "\n", FILE_APPEND);
    $seat++;
    file_put_contents("currentSeat", $seat);
}else{
    $DIV = "<div>Data tidak ditemukan</div>";
    echo $DIV;
    file_put_contents("fail", $id . "\n", FILE_APPEND);
}

endoftag:
?>
</div>
<div id = "footer">
    TIM IT PAROKI KATEDRAL SANTO YOSEF PANGKALPINANG
</div>
</body>
</html>
