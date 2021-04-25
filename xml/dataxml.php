<?php
Header('Content-type: text/xml');
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "uts");
mysqli_select_db($conn,"uts");

$dataxml = simplexml_load_file('komik.xml');

$sql = "select * from listkomik ";
$result = mysqli_query($conn, $sql) or die("Error " . mysqli_error($conn));

//menyimpan data dari XML yg ada, ke Database
foreach($dataxml->komik as $komik)
{   
    $id = $komik['id'];
    $judul = addslashes($komik->judul);
    $pengarang = $komik->pengarang;
    $tipe = $komik->tipe;
    $genre = $komik->genre;
    $rilis = $komik->rilis;
    
    $query = "INSERT INTO listkomik 
                  VALUES ('$id', '$judul', '$pengarang', '$tipe', '$genre', '$rilis') ";
    mysqli_query($conn,$query);
     
}

//menampilkan data dari database, table listkomik
$xml = new SimpleXMLElement('<xml/>');
while ($row = mysqli_fetch_assoc($result)) {

    $track = $xml->addChild('listkomik');
    $track->addChild('judul', $row['judul']);
    $track->addChild('pengarang', $row['tipe']);
    $track->addChild('tipe', $row['tipe']);
    $track->addChild('genre', $row['genre']);
    $track->addChild('rilis', $row['rilis']);
}
print($xml->asXML());

mysqli_close($conn);
?>