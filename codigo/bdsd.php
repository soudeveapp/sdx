<?php
$host_bdx = "127.0.0.1";
$usuario_bdx = "root";
$senha_bdx = "root";
$nome_bdx = "sdx";
try {
    $cnx = new PDO("mysql:host=$host_bdx;dbname=$nome_bdx;charset=utf8", $usuario_bdx, $senha_bdx, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
  echo "Erro na conexão com o banco XDS: " . $e->getMessage();
}
?>
