<?php
include('sistems/conexao.php');

$sqlPedido = "SELECT * FROM tb_pedido";
$stmt = $conn->prepare($sqlPedido);
$stmt->execute();



$arrayNome = array();
$arrayTurmaAluno = array();
$arrayCodigo = array();
$arrayValor = array();
$arrayDesc = array();
$arrayData = array();

while ($pedido = $stmt->fetch(PDO::FETCH_ASSOC)) {
  // $arrayAluno[] = $alun['nm_aluno'];
  // $arraySenha[] = $alun['pass_aluno'];
  // $arrayEmail[] = $alun['tp_email'];
  // $arrayRm[] = $alun['rm'];
  // $arrayTurma[] = $alun['id_turma'];
  // $arrayData[] = $alun['dt_nasc'];

  $arrayNome[] = $pedido['nome'];
  $arrayTurmaAluno[] = $pedido['turma'];
  $arrayCodigo[] = $pedido['cd_pedido'];
  $arrayValor[] = $pedido['vl_pedido'];
  $arrayDesc[] = $pedido['desc_pedido'];
  $arrayData[] = $pedido['data_pedido'];

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style4.css">
  <title>Document</title>


</head>
<script src="js/jquery-3.7.1.min.js" defer></script>
<body>

  <div class="container1">
    <div class="btns">
      <button class="btn1">Em Aberto</button>
      <button class="btn2">Confirmados</button>
      <button class="btn3">Finalizados</button>
      <button class="btn-modal" id="openModal">Cadastrar</button>
    </div>
  </div>


  <div class="container2">

    <table>
      <thead>
        <tr>
          <th colspan="7">PEDIDOS ENCONTRADOS</th>
        </tr>
      </thead>
      <tbody id="tableBody">

        <tr>
          <td class="pColum" id="pO">#id</td>
          <td class="oColum" id="pO">#data</td>
          <td class="oColum" id="pO">#turma </td>
          <td class="oColum" id="pO">#nome</td>
          <td class="oColum" id="pO">#valor</td>
          <td class="oColum" id="pO">#desc</td>
          <td class="btns-line">
          </td>
        </tr>
    
      </tbody>
    </table>
  </div>

  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
      </div>
      <form class="horizontal-form">
        <div class="input-group">
          <label for="id">ID:</label>
          <input type="text" id="id" name="id" readonly>
        </div>
        <div class="input-group">
          <label for="data">Data:</label>
          <input type="date" id="data" name="data">
        </div>
        <div class="input-group">
          <label for="turma">Turma:</label>
          <input type="text" id="turma" name="turma">
        </div>
        <div class="input-group">
          <label for="valor">Valor:</label>
          <input type="text" id="valor" name="valor" >
          <input type="text" placeholder="Nome" id='nome' class="name-user">
        </div>

        <textarea cols="30" rows="10" id="textarea" class="textarea"></textarea>

        <div class="btns-cc">
          <button onclick="cadastrarPedido() " class="btn">Confirmar pedido</button>
          <button  class="btn">Cancelar pedido</button>
        </div>
      </form>
    </div>
  </div>


  <div id="userModal" class="modal">
    <div class="modal-content">
      <div class="modal-header2">
        <h2>Informações do Usuário</h2>
        <span class="close">&times;</span>
        
      </div>
      <div class="modal-body">
        <!-- Aqui você pode adicionar os campos para exibir as informações do usuário -->
        <p>ID: <span id="userId"></span></p>
        <p>Nome: <span id="userName"></span></p>
        <p>Data: <span id="userData"></span></p>
        <p>Turma: <span id="userTurma"></span></p>
      </div>
    </div>
  </div>

  <script>
    // Obter o modal
    var modal = document.getElementById("myModal");

    // Obter o botão que abre o modal
    var btn = document.getElementById("openModal");

    // Obter o elemento <span> que fecha o modal
    var span = document.getElementsByClassName("close")[0];

    // Quando o usuário clicar no botão, abre o modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Quando o usuário clicar no <span> (x), fecha o modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Quando o usuário clicar fora do modal, fecha o modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Inicializar o valor
    document.addEventListener("DOMContentLoaded", function() {
    // Selecionar os botões de detalhes
    var detalhesButtons = document.querySelectorAll('.btn-detalhes, .btn-editar');
    
    // Adicionar evento de clique a cada botão de detalhes
    detalhesButtons.forEach(function(button) {
        button.onclick = function() {
            // Obter a linha correspondente
            var row = button.closest('tr');
            var cells = row.getElementsByTagName("td");
            
            // Atualizar o modal com as informações correspondentes
            document.getElementById("userId").innerText = cells[0].innerText;
            document.getElementById("userName").innerText = cells[3].innerText;
            document.getElementById("userData").innerText = cells[1].innerText;
            document.getElementById("userTurma").innerText = cells[2].innerText;
            document.getElementById("userModal").style.display = "block";
        }
    });
    
    // Adicionar funcionalidade para fechar o modal ao clicar no botão "Fechar" ou fora do modal
    var userModal = document.getElementById("userModal");
    var closeButton = userModal.querySelector(".close");
    closeButton.onclick = function() {
        userModal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == userModal) {
            userModal.style.display = "none";
        }
    }
});
</script>


</body>

<script>

var tabela = document.getElementById('tableBody')


var arrayNome = <?php echo json_encode($arrayNome);?>;
var arrayTurmaAluno = <?php echo json_encode($arrayTurmaAluno);?>;
var arrayCodigo = <?php echo json_encode($arrayCodigo);?>;
var arrayValor = <?php echo json_encode($arrayValor);?>;
var arrayDesc = <?php echo json_encode($arrayDesc);?>;
var arrayData = <?php echo json_encode($arrayData);?>;

for (i = 0; i < arrayCodigo.length; i++){

  tabela.innerHTML += `<tr><td class="pColum">${arrayCodigo[i]}</td><td class="oColum">${arrayData[i]}</td><td class="oColum">${arrayTurmaAluno[i]}</td><td class="oColum">${arrayNome[i]}</td><td class="oColum">${arrayValor[i]}</td><td class="oColum">${arrayDesc[i]}</td>
        <td><button class="btn-line1 btn-editar">Editar</button>
            <button class="btn-line2 btn-detalhes">Detalhes</button>
            <button class="btn-line3">Excluir</button></td></tr>`

  
}

function cadastrarPedido(){

var aluno = document.getElementById('nome').value
var turma = document.getElementById('turma').value
var valor = document.getElementById('valor').value
var data = document.getElementById('data').value
var descricao = document.getElementById('textarea').value


alert(aluno)
alert(turma)
alert(valor)
alert(data)
alert(descricao)


$.ajax({
    url: "sistems/cadastroPedido.php",
    type: "POST",
    data: "&nomeCad="+aluno+"&turmaCad="+turma+"&dataCad="+data+"&valorCad="+valor+"&descricaoCad="+descricao,
    dataType: "html"


  }).done(function(response) {


    $("#resposta").html(response);

  }).fail(function(jqXHR,textStatus){
  console.log("request failed: "+textStatus);

  }).always(function(){
  console.log("completou");
  });
}


function excluirPedido(){





}



</script>

</html>