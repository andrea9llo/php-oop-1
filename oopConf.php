<?php

class Configurazione {

  public $id;
  public $title;
  public $description;

  function __construct($id, $title, $description) {

    $this -> id = $id;
    $this -> title = $title;
    $this -> description = $description;

  }

  public function __toString() {

    return "[". $this -> id . "]" . $this -> title . "-" . $this -> description;
  }
}

$servername = 'localhost';
$username = 'root';
$pws = 'root';
$db = 'hoteldb';
$conn = new mysqli($servername, $username, $pws, $db);
if ($conn -> connect_errno) {

  echo json_encode(-1);
  return;
}

$sql = "
    SELECT *
    FROM configurazioni

";

$res = $conn -> query($sql);
$conn -> close();
if ($res -> num_rows < 1) {
  echo json_encode(-2);
  return;
}

$confs = [];
while($conf = $res -> fetch_assoc()) {

  $confs[] = new Configurazione($conf['id'],
                                $conf['title'],
                                $conf['description']);
}

foreach ($confs as $conf) {

  echo $conf . "<br>";
}
