<!doctype HTML>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>Deletar Registros</title>
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
	</head>
    <body>
        <form id="form1" method="post" action="delet.php">             
            <h3>Excluir Registros</h3>
            <label for="txtnome">Escolha o código desejado</label>
            <input type="text" id="txtcodi" name="txtcodi" placeholder="Código desejado" required/>
            <br/><br/>
            <div class="botoes">
                <input type="submit" value="Excluir"/>
                <input type="reset"  value="Limpar" onClick="document.getElementById('txtcodi').focus();"/>
                <input type="button" value="Menu" onClick="location.href='menu.html';"/>
            </div>
        </form>
        <?php 
            include 'conexao.php';
            $lista=$cmd->query("select * from tbcrud");
            $total_registros =$lista->rowCount();
            if ($total_registros > 0) 
            {
                echo "<table>";
                echo "<tr> <th colspan=6> Dados Cadastrados </th> </tr>";
                echo "<tr> 
                        <th> Código </th>
                        <th> Nome </th>
                        <th> e-Mail </th>
                        <th> Senha </th>
                        <th> Sexo </th>
                        <th> Nascimento </th>
                      </tr>";
                            
                while($linha=$lista->fetch(PDO::FETCH_ASSOC))
                {
                    $codigo=$linha['codi_cr'];
                    $nome=$linha['nome_cr'];
                    $ema=$linha['email_cr'];
                    $senha=$linha['senh_cr'];
                    $sexo=$linha['sexo_cr'];
                    $data=$linha['atna_cr'];
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
            }
            else
            {
                echo "<script language=javascript> 
                        window.alert('Não existem registros a serem excluídos!!! '); 
                        location.href='index.html';
                     </script>"; 
            }
		?>
	</body>
</html>
