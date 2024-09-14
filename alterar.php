<!doctype HTML>
<html lang="pt-br">
	<head>
	<meta charset="utf-8"/>
	<title>Alterar Registros</title>
    <style>
        body {
            background-color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: aliceblue;
        }
        form {
            background-color: rgba(255, 255, 255, 0.37);
            text-align: center;
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            color: aliceblue;
            padding: 30px;
        }
        table {
            margin-top: 40px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid aliceblue;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: rgba(255, 255, 255, 0.2);
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.37);
            color: aliceblue;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>
	<script language="JavaScript">
		function Saindo() {
			location.href="menu.html";
		}
	</script>
	</head>
    <body>
        <form id="form1" method="post" action="alte.php">             
            <?php  
                echo "<h3>Alteração de Registros</h3>";

                echo "<label for='txtcodi'>Código do registro a ser alterado&nbsp;</label>";                 
                echo "<input type='text' name='txtcodi' id='txtcodi'/><br/>";
                
                echo "<label for='txtnome'>Nome&nbsp;</label>";                 
                echo "<input type='text' name='txtnome' id='txtnome'/><br/>";
                
                echo "<label for='txtemai'>e-mail&nbsp;</label>";
                echo "<input type='email' name='txtemai' id='txtemai'/><br/>";
                
                echo "<label for='txtsenh'>Senha&nbsp;</label>";                 
                echo "<input type='password' name='txtsenh' id='txtsenh'/><br/>";
                    
                echo "<label for='txtsexo'>Sexo&nbsp;</label>";                
                echo "<input type='radio' value='f' name='txtsexo' id='txtsexof' checked/>Feminino
                      <input type='radio' value='m' name='txtsexo' id='txtsexom'/>Masculino
                      <br/>";
                
                echo "<label for='txtdtna'>Informe sua data de nascimento</label>";
                echo "<input type='date' id='txtdtna' name='txtdtna'/> <br/><br/>";
                
                echo "<div class='botoes'>
                        <input type='submit' name='bt' id='bt' value='Escolher'/>&nbsp;&nbsp; 
                        <input type='button' value='Menu' onClick='Saindo()'/>
                      </div>";

                // estabelecendo a conexão com banco de dados 
                include 'conexao.php';
                $listar = $cmd->query("SELECT * FROM tbcrud");
                $total_registros = $listar->rowCount();
                if ($total_registros > 0) {
                    echo "<table>";
                    echo "<tr><th colspan=6>Dados Cadastrados</th></tr>";
                    echo "<tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>e-Mail</th>
                            <th>Senha</th>
                            <th>Sexo</th>
                            <th>Nascimento</th>
                         </tr>";
                    while ($linha = $listar->fetch(PDO::FETCH_ASSOC)) {
                        $codigo = $linha['codi_cr'];
                        $nome = $linha['nome_cr'];
                        $ema = $linha['email_cr'];
                        $senha = $linha['senh_cr'];
                        $sexo = $linha['sexo_cr'];
                        $data = $linha['atna_cr'];
                        echo "<tr>
                        <td>$codigo</td>
                        <td>$nome</td>
                        <td>$ema</td>
                        <td>$senha</td>
                        <td>$sexo</td>
                        <td>$data</td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<script language=javascript> window.alert('Não existem registros para alterar!!!'); location.href='menu.html'</script>";
                }
                
                if (isset($_POST['bt'])) {
                    $vcodi = $_POST['txtcodi']; 
                    $vbt = $_POST['bt'];            
                    
                    if ($vbt == 'Escolher') {     
                        $pesq = $cmd-> query("SELECT * FROM tbcrud WHERE codi_cr='$vcodi'");
                        $total_registros = $pesq->rowCount();
                        if ($total_registros > 0) { 
                            while ($linha = $pesq->fetch(PDO::FETCH_ASSOC)) {
                                $codigo = $linha['codi_cr'];
                                $nome = $linha['nome_cr'];
                                $ema = $linha['email_cr'];
                                $senha = $linha['senh_cr'];
                                $sexo = $linha['sexo_cr'];
                                $data = $linha['atna_cr'];
                                echo "<script language=javascript>
                                        document.getElementById('txtcodi').value='$codigo';
                                        document.getElementById('txtnome').value='$nome';
                                        document.getElementById('txtemai').value='$ema';
                                        document.getElementById('txtsenh').value='$senha';
                                        if ('$sexo' == 'f')
                                            document.getElementById('txtsexof').checked=true;
                                        else
                                            document.getElementById('txtsexom').checked=true;
                                        document.getElementById('txtdtna').value='$data';
                                        document.getElementById('bt').value='Alterar';
                                        document.getElementById('txtcodi').readOnly=true;
                                    </script>";
                            }
                        } else {
                            echo "<script language=javascript> window.alert('Código inexistente!!!'); location.href='alte.php'; </script>";
                        }
                    } else if ($vbt == 'Alterar') { 
                        $codigo = $_POST['txtcodi'];
                        $nome = $_POST['txtnome']; 
                        $ema = $_POST['txtemai'];
                        $senha = $_POST['txtsenh'];
                        $sexo = $_POST['txtsexo'];
                        $data = $_POST['txtdtna'];
                        
                        $alter = $cmd-> query("UPDATE tbcrud SET nome_cr='$nome', email_cr='$ema', senh_cr='$senha', sexo_cr='$sexo', atna_cr='$data' WHERE codi_cr='$codigo'");
                        echo "<script language=javascript>
                            window.alert('Registro alterado com sucesso!!!'); 
                            document.getElementById('bt').value='Escolher';
                            document.getElementById('txtcodi').readOnly=false;
                            </script>";
                        echo "<meta http-equiv='refresh' content='0'/>"; 
                    }
                }               		
 	        ?>
	    </form>
	</body>
</html>
