<?php
$host = 'sql305.byetcluster.com';  
$user = 'b7_37207333';       
$pass = 'AlunoEtec123';           
$db = 'b7_37207333_emi';    

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}
?>
