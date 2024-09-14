<?php
include 'conexao.php';
$nome = $_POST['txnome'];
$ema = $_POST['email'];
$senha = $_POST['txsenha'];
$sexo = $_POST['txsexo'];
$data = $_POST['datanans'];
$incluir = $cmd->query("insert into tbcrud(nome_cr, email_cr, senh_cr, sexo_cr , atna_cr) values('$nome', '$ema', '$senha', '$sexo', '$data')");

echo "<script language='JavaScript'> 
        alert('Dados cadastrados com sucesso!!');
        location.href='cadastro.html';
    </script>"
?>