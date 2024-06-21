<?php
include('sistems/conexao.php');

$sqlAlun = "SELECT * FROM tb_aluno";
$stmt = $conn->prepare($sqlAlun);
$stmt->execute();


$arrayAluno = array();
$arraySenha = array();
$arrayEmail = array();
$arrayRm = array();
$arrayTurma = array();
$arrayData = array();

while ($alun = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $arrayAluno[] = $alun['nm_aluno'];
  $arraySenha[] = $alun['pass_aluno'];
  $arrayEmail[] = $alun['tp_email'];
  $arrayRm[] = $alun['rm'];
  $arrayTurma[] = $alun['id_turma'];
  $arrayData[] = $alun['dt_nasc'];
}

$sqlTurma = "SELECT * FROM tb_turma";
$stmtTurma = $conn->prepare($sqlTurma);
$stmtTurma->execute();

$arrayTurmaNameT = array();
$arrayTurmaidT = array();


while ($turm = $stmtTurma->fetch(PDO::FETCH_ASSOC)) {

  $arrayTurmaNameT[] = $turm["nome"];
  $arrayTurmaidT[] = $turm["id_curso"];
  
}

?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style3.css">
  <script src="js/jquery-3.7.1.min.js" defer></script>

  <style>
    .tdAl{

      width: 130rem;

    }
  </style>
</head>
<body>
  <div class="fundo">
    <div class="container">
      <div class="caixaEsquerda">
        <select class="opcoes" id="cursos1">
          <option class="ops" value="" disabled selected hidden>Selecione um curso</option>
          <option class="ops" value="1">1Min</option>
          <option class="ops" value="2">2Min</option>
          <option class="ops" value="3">3Min</option>
          <option class="ops" value="4">1Mad</option>
          <option class="ops" value="5">2Mad</option>
          <option class="ops" value="6">3Mad</option>
          <option class="ops" value="7">1Mam</option>
          <option class="ops" value="8">2Mam</option>
          <option class="ops" value="9">3Mam</option>
          <option class="ops" value="10">1Ds</option>
          <option class="ops" value="11">2Ds</option>
          <option class="ops" value="12">3Ds</option>
          <option class="ops" value="13">1Adm</option>
          <option class="ops" value="14">2Adm</option>
          <option class="ops" value="15">3Adm</option>
          <option class="ops" value="16">1Far</option>
          <option class="ops" value="17">2Far</option>
          <option class="ops" value="18">3Far</option>



        </select>

        <input class="file" type="text" id="Cadnome" placeholder="Insira o seu nome">
        <input class="file" type="text" id="CadRm" placeholder="Insira o seu RM">
        <input class="file" type="date" id="CadData">
        
        <div class="botao2">
          <button class="btn2" onclick="cadastro()">ADICIONAR ALUNOS</button>
        </div>
      </div>
    </div>

    <div class="container1">
      <div class="caixaCima">
        <div class="curso">
          <select class="opcoes" id="cursos3">
            <option class="ops" value="" disabled selected hidden>Turma</option>
            <option class="ops" value="1" name="1">1Min</option>
            <option class="ops" value="2" name="1">2Min</option>
            <option class="ops" value="3" name="1">3Min</option>
            <option class="ops" value="4" name="2">1Mad</option>
            <option class="ops" value="5" name="2">2Mad</option>
            <option class="ops" value="6" name="2">3Mad</option>
            <option class="ops" value="7" name="3">1Mam</option>
            <option class="ops" value="8" name="3">2Mam</option>  
            <option class="ops" value="9" name="3">3Mam</option>
            <option class="ops" value="10" name="4">1Ds</option>
            <option class="ops" value="11" name="4">2Ds</option>
            <option class="ops" value="12" name="4">3Ds</option>  
            <option class="ops" value="13" name="5">1Adm</option>  
            <option class="ops" value="14" name="5">2Adm</option>
            <option class="ops" value="15" name="5">3Adm</option>
            <option class="ops" value="16" name="6">1Far</option>
            <option class="ops" value="17" name="6">2Far</option>
            <option class="ops" value="18" name="6">3Far</option>
          </select>
        </div>
        <div class="listTurma">
          <select class="opcoes" id="cursos4">
            <option class="ops" value="" disabled selected hidden>Cursos</option>
            <option class="ops" value="1">Informática para a internet</option>
            <option class="ops" value="2">Administração Etim</option>
            <option class="ops" value="3">Meio ambiente</option>
            <option class="ops" value="4">Desenvolvimento de sistemas</option>
            <option class="ops" value="5">Administração Modular</option>
            <option class="ops" value="6">Farmácia</option>
          </select>
          <button class="btn3" onclick="filtrar()">Listar</button>
        </div>
      </div>
    </div>

    <div class="container2">
      <table>
        <thead>
          <tr>
            <th colspan="5">ALUNOS ENCONTRADOS</th>
          </tr>
        </thead>
        <tbody id="tabelaAlunos">
          <tr>
            <td>RM</td>
            <td>Nome</td>
            <td>Nascimento</td>
            <td>Turma</td>
            <td>#</td>
          </tr>

        </tbody>
        <div class="botao">
          <button class="btn" >PROMOVER ALUNOS</button>
        </div>
      </table>
      <p id="resposta"></p>
    </div>
  </div>
</body>

<script>

//arrays para cadastro
var arrayAluno = <?php echo json_encode($arrayAluno);?>;
var arraySenha = <?php echo json_encode($arraySenha);?>;
var arrayEmail = <?php echo json_encode($arrayEmail);?>;
var arrayRm = <?php echo json_encode($arrayRm);?>;
var arrayTurma = <?php echo json_encode($arrayTurma);?>;
var arrayData = <?php echo json_encode($arrayData);?>;
var turma = "";

// arrays para filtragem
var arrayTurmaNameT = <?php echo json_encode($arrayTurmaNameT);?>;
var arrayTurmaidT = <?php echo json_encode($arrayTurmaidT);?>;


console.log(arrayTurmaNameT)
console.log(arrayTurmaidT)


console.log('arrayData: '+arrayData)

var table = document.getElementById("tabelaAlunos")

  for (var i = 0; i < arrayAluno.length; i++) {

    switch (arrayTurma[i]) {
    case "1":
      turma = "1Min";
      break;
    case "2":
      turma = "2Min";
      break;
    case "3":
      turma = "3Min";
      break;
    case "4":
      turma = "1Mad";
      break;
    case "5":
      turma = "2Mad";
      break;
    case "6":
      turma = "3Mad";
      break;
    case "7":
      turma = "1Mam";
      break;
    case "8":
      turma = "2Mam";
      break;
    case "9":
      turma = "3Mam";
      break;
    case "10":
      turma = "1DS";
      break;
    case "11":
      turma = "2DS";
      break;
    case "12":
      turma = "3DS";
      break;
    case "13":
      turma = "1Adm";
      break;
    case "14":
      turma = "2Adm";
      break;
    case "15":
      turma = "3Adm";
      break;
    case "16":
      turma = "1Far";
      break;
    case "17":
      turma = "2Far";
      break;
    case "18":
      turma = "3Far";
      break;
      
      
    default:
      turma = 'Indefinida'
      break;
  }


    table.innerHTML += `<tr><td class="tdAl">${arrayRm[i]}</td><td class="tdAl">${arrayAluno[i]}</td><td class="tdAl">${arrayData[i]}</td><td class="tdAl">${turma}</td><td class="tdAl">#</td></tr>`

}

function cadastro(){
  var nome = document.getElementById("Cadnome").value
  var rm = parseInt(document.getElementById("CadRm").value, 10);
  var data = document.getElementById("CadData").value

  alert(data)

  var select = document.getElementById('cursos1');
  var idTurma = select.options[select.selectedIndex].value;
  var turmaText = select.options[select.selectedIndex].textContent;
  console.log(idTurma); 

  
  $.ajax({
    url: "sistems/cadastro2.php",
    type: "POST",
    data: "&nomeCad="+nome+"&rmCad="+rm+"&dateCad="+data+"&idTurmaCad="+idTurma,
    dataType: "html"


  }).done(function(response) {


    $("#resposta").html(response);

  }).fail(function(jqXHR,textStatus){
  console.log("request failed: "+textStatus);

  }).always(function(){
  console.log("completou");
  });


 
}

function filtrar(){


var selectTurma = document.getElementById('cursos3');
  var idTurma = selectTurma.options[selectTurma.selectedIndex].value;
  var turmaText = selectTurma.options[selectTurma.selectedIndex].textContent;
  console.log(idTurma);


var selectCurso = document.getElementById('cursos4');
  var idCurso = selectCurso.options[selectCurso.selectedIndex].value;
  var CursoText = selectCurso.options[selectCurso.selectedIndex].textContent;
  console.log(CursoText);



//arrayTurmaNameT //Nome da turma
//arrayTurmaidT  //Id da turma



if(idCurso == "" && idTurma == ""){

  alert("Insira um dos dados para a filtragem")

}else if (idCurso == "" && idTurma != ""){


  alert("turma selecionada")

  table.innerHTML ="<tr><td>RM</td><td>Nome</td><td>Nascimento</td><td>Turma</td><td>#</td></tr>"
  
  for(i = 0; i<arrayTurma.length;i++){

    if(arrayTurma[i] == idTurma){

      table.innerHTML += `<tr><td class="tdAl">${arrayRm[i]}</td><td class="tdAl">${arrayAluno[i]}</td><td class="tdAl">${arrayData[i]}</td><td class="tdAl">${arrayTurmaNameT[parseInt(idTurma)-1]}</td><td class="tdAl">#</td></tr>`

    }
  }
  

}else if(idCurso != "" && idTurma == ""){

  alert("Curso selecionadoss")
  //idCurso // 1

  table.innerHTML ="<tr><td>RM</td><td>Nome</td><td>Nascimento</td><td>Turma</td><td>#</td></tr>"

  var cursoEscolhido = document.getElementsByName(idCurso)

  var turmaT = ""

  for(i = 0; i<arrayAluno.length; i++){

    switch (arrayTurma[i]) {
      case "1":
        turmaT = "1Min";
        break;
      case "2":
        turmaT = "2Min";
        break;
      case "3":
        turmaT = "3Min";
        break;
      case "4":
        turmaT = "1Mad";
        break;
      case "5":
        turmaT = "2Mad";
        break;
      case "6":
        turmaT = "3Mad";
        break;
      case "7":
        turmaT = "1Mam";
        break;
      case "8":
        turmaT = "2Mam";
        break;
      case "9":
        turmaT = "3Mam";
        break;
      case "10":
        turmaT = "1Ds";
        break;
      case "11":
        turmaT = "2Ds";
        break;
      case "12":
        turmaT = "3Ds";
        break;
      case "13":
        turmaT = "1Adm";
        break;
      case "14":
        turmaT = "2Adm";
        break;
      case "15":
        turmaT = "3Adm";
        break;
      case "16":
        turmaT = "1Far";
        break;
      case "17":
        turmaT = "2Far";
        break;
      case "18":
        turmaT = "3Far";
        break;
        
      default:
        turmaT = 'Indefinida'
        break;
    }

    for(x = 0;x<cursoEscolhido.length; x++){


      // alert(cursoEscolhido[x].textContent)
      // alert(turmaT)

      if(turmaT == cursoEscolhido[x].textContent){

            

            table.innerHTML += `<tr><td class="tdAl">${arrayRm[i]}</td><td class="tdAl">${arrayAluno[i]}</td><td class="tdAl">${arrayData[i]}</td><td class="tdAl">${turmaT}</td><td class="tdAl">#</td></tr>`


      }
    }
  } 



}else if(idCurso != "" && idTurma != ""){

  alert("Curso e turma selecionados")

  table.innerHTML ="<tr><td>RM</td><td>Nome</td><td>Nascimento</td><td>Turma</td><td>#</td></tr>"

var cursoEscolhido = document.getElementsByName(idCurso)

var turmaT = ""

for(i = 0; i<arrayAluno.length; i++){

  switch (arrayTurma[i]) {
    case "1":
      turmaT = "1Min";
      break;
    case "2":
      turmaT = "2Min";
      break;
    case "3":
      turmaT = "3Min";
      break;
    case "4":
      turmaT = "1Mad";
      break;
    case "5":
      turmaT = "2Mad";
      break;
    case "6":
      turmaT = "3Mad";
      break;
    case "7":
      turmaT = "1Mam";
      break;
    case "8":
      turmaT = "2Mam";
      break;
    case "9":
      turmaT = "3Mam";
      break;
    case "10":
      turmaT = "1Ds";
      break;
    case "11":
      turmaT = "2Ds";
      break;
    case "12":
      turmaT = "3Ds";
      break;
    case "13":
      turmaT = "1Adm";
      break;
    case "14":
      turmaT = "2Adm";
      break;
    case "15":
      turmaT = "3Adm";
      break;
    case "16":
      turmaT = "1Far";
      break;
    case "17":
      turmaT = "2Far";
      break;
    case "18":
      turmaT = "3Far";
      break;
      
    default:
      turmaT = 'Indefinida'
      break;
  }

  for(x = 0;x<cursoEscolhido.length; x++){


    // alert(cursoEscolhido[x].textContent)
    // alert(turmaT)

    if(turmaT == cursoEscolhido[x].textContent){

          if(turmaT == turmaText)

          table.innerHTML += `<tr><td class="tdAl">${arrayRm[i]}</td><td class="tdAl">${arrayAluno[i]}</td><td class="tdAl">${arrayData[i]}</td><td class="tdAl">${turmaT}</td><td class="tdAl">#</td></tr>`



    }
  }
} 





}














}








//   document.addEventListener('DOMContentLoaded', function() {
// // Função para adicionar uma nova linha à tabela
// function adicionarLinha() {
//   const tabela = document.getElementById('tabelaAlunos');
//   const novaLinha = tabela.insertRow();
  
//   for (let i = 0; i < 5; i++) {
//     const novaCelula = novaLinha.insertCell();
//     novaCelula.textContent = 'Novo Alunos'; // Adicione o conteúdo desejado aqui
//   }
// }

// // Função de exemplo para promover alunos (pode ser adaptada conforme necessário)
// function promoverAlunos() {
//   // Lógica para promover alunos (ex: enviar dados ao servidor)
//   alert('Alunos promovidos com sucesso!');
// }

// // Torne as funções globais para que possam ser chamadas no HTML
// window.adicionarLinha = adicionarLinha;
// window.promoverAlunos = promoverAlunos;
// });

</script>
</html>
