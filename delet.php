<?php 
    include 'conexao.php';
    $vcod=$_POST['txtcodi'];                
    $pesq=$cmd-> query("select * from tbcrud where codi_cr='$vcod'");
    $total_registros =$pesq->rowCount();
    if ($total_registros > 0)
		{
            $excl=$cmd-> query("delete from tbcrud where codi_cr='$vcod'");
 			echo "<script language=javascript> 
                    window.alert('Registro excluído com sucesso!!! '); 
                    location.href='excluir.php';
                 </script>";
        }                        
    else
        {
            echo "<script language=javascript> 
                    window.alert('Código inexistente!!! '); 
                    location.href='dele.php';
                 </script>"; 
		}               
?>