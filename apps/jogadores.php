<?php
   include "../servicos/conexao.php";
?>

<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="./img/favico.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GORGUN FICHA</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    

</head>

<body>
    
<header class="cabecalho"><!--cabeçalho com titulo-->
    <h1><b>As Crônicas de Gorgon</b> <br><i>entre dois mundos</i><br>Oficial Website</h1>
        <p>Conto by Ulysses Cezario </br> Site by Tamer Serhan e Mateus Soares</p><br><br>
    <div class="titulo"><h2>CONSULTA DE PLAYERS</h2></div>   
</header>
    
<nav class="container"><!--navegador entre os links-->
    <ul class="projetos"><h3>Links e referencias para seu jogo:</h3>
        <li> <a href = "../index.html">HOME</a></li>
        <li> <a href = "docs/map.html">GORGUN MAPA</a></li>
        <li> <a href = "forja/forja.html">FORJA</a></li>
        <li> <a href = "dice/dados.html">LANCE A SORTE</a></li>
        <li> <a href = "gandah/ganda.html">GANDHA</a></li>
        <li> <a href = "loja/loja.html">LOJAS  </a></li>
        <li> <a href = "books/books.html">Contos de Gordun</a></li>
        <li> <a href = "books/books.html">Biblioteca de Alcamar</a></li>
        <li> <a href = "books/bestiario.html">Bestiario de Alcamar</a></li>   
    </ul>
    </nav>
    
<section><!--area para consulta-->
<div class=" projetos">  

<h2>Busca de Personagens</h2>

<form action="">
    
    <input name="q" placeholder="palavra-chave" type="text">
    <button type="submit">Pesquisar</button>
    </br>
    <?php if(isset($_GET['q'])) echo "buscando sobre " . $_GET['q'];?>
</form>

<table width= "900px" border="1">
    <tr>
        <th>nome</th><th>idade</th><th>personagem</th><th>classe</th><th>raça</th><th>objetivo</th><th>sexo</th>
    </tr>

<?php
    if (!isset($_GET['q'])) {
?>
    <tr>
        <td colspan="7">Digite algo para pesquisar</td>
    </tr>
<?php
    } else {
        $pesquisa = $mysqli->real_escape_string($_GET['q']); 
        // tratamento contra SQL injection $mysqli->real_escape_string()
        $sql_code = "SELECT * FROM personagens WHERE name LIKE '%$pesquisa%' OR personagem LIKE '%$pesquisa%' OR classe LIKE '%$pesquisa%' OR raça  LIKE '%$pesquisa%' OR idade  LIKE '%$pesquisa%'";
        // % busca % tras na busca qualquer palavra ou charset que tenha a busca no meio, começo ou final ou precida LIKE dela.
    
        $sql_query = $mysqli->query($sql_code) or die ("error ao consultar o db " . $mysqli->error);
        // faz a consulta no banco de dados com $sql_code ou se der erro ela sai e da o erro.   
        
        if ($sql_query->num_rows == 0) {  // se a pesquisa feita nao retornar nada, ou seja 0 linhas/rows faça isso
?>            
        <tr>
            <td colspan="7">Nada encontrado em sua pesquisa</td>
        </tr>    
<?php        
        } else {
            while($dados = $sql_query->fetch_assoc()){ // enquanto houver dados associados na pesquisa faça...
        ?>            
        <tr>
            <td><?php echo $dados['name'];?></td>
            <td><?php echo $dados['idade'];?></td>
            <td><?php echo $dados['personagem'];?></td>
            <td><?php echo $dados['classe'];?></td>
            <td><?php echo $dados['raça'];?></td>
            <td><?php echo $dados['objetivo'];?></td>
            <td><?php echo $dados['sexo'];?></td>
        </tr> 
    
<?php } } }?>  
    

</table>
</div>
</section>

            </br></br></br>

<button class="btn-fora"> <a href = "./formulario.php">ACESSE AQUI PARA CRIAÇÂO DE SUA FICHA!</a></button>


</body>
</html>