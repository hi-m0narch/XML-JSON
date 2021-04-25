<?php

$conn=mysqli_connect("localhost","root","","uts");

$filename = "mahasiswa.json";

$data = file_get_contents($filename);

$array = json_decode($data, true);

foreach($array as $row){
    $sql = "INSERT INTO mahasiswa(nama, npm, jenis_kelamin, kelompok_keahlian) VALUES ('".$row["nama"]."', '".$row["npm"]."', '".$row["jenis_kelamin"]."', '".$row["kelompok_keahlian"]."')";

    mysqli_query($conn, $sql);
}

$q = "select * from mahasiswa";
$hasil = mysqli_query($conn,$q);

if(mysqli_num_rows($hasil) > 0){
    $respon = array();
    $respon ["mahasiswa"] = array();
    while($x = mysqli_fetch_array($hasil)){
        $h['id'] = $x["id"];
        $h['nama'] = $x["nama"];
        $h['npm'] = $x["npm"];
        $h['jenis_kelamin'] = $x["jenis_kelamin"];
        $h['kelompok_keahlian'] = $x["kelompok_keahlian"];
        array_push($respon["mahasiswa"], $h);
    }
    echo json_encode($respon);
}
?>