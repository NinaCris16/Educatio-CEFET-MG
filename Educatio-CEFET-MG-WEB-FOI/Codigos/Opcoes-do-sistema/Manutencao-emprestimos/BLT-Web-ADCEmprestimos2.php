<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

	<!-- CSS do Bootstrap -->
	<link href='../../../Estaticos/Bootstrap/css/bootstrap.min.css' rel='stylesheet'/>
	<link href='../../../Estaticos/Bootstrap/css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	<link href='../css/CJF-web-estilos.css' rel='stylesheet' type='text/css' >

	<!-- Arquivos js -->
	<script src='../../../Estaticos/Bootstrap/js/popper.js'></script>
	<script src='../../../Estaticos/Bootstrap/js/jquery-3.2.1.js' type='text/javascript'></script>
	<script src='../../../Estaticos/Bootstrap/js/bootstrap.min.js' type='text/javascript'></script>

	<!-- Fontes e icones -->
	<link href='../../../Estaticos/Bootstrap/css/nucleo-icons.css' rel='stylesheet'>
  <link href="BLT-Web-Emprestimos.css" rel="stylesheet">
  <script src="BLT-Web-Emprestimos.js"></script> 
 </head>
 <body>

 
<?php

session_start();

 require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-menu-interface-bibliotecario.php"; 

$servername = "localhost";
$username = "root";
$password = "usbw";
$bdNome = "educatio";

// Create connection
$conn = new mysqli($servername, $username, $password, $bdNome);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Setando a time zone
date_default_timezone_set('America/Sao_Paulo');

$IDaluno = $_POST['IDaluno'];
$IDacervo = $_POST['IDacervo'];
$datadevolucao = $_POST['datadevolucao'];
$multa = "0";
$ativo = "S";


$sql = "SELECT idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo FROM emprestimos WHERE idAcervo = '$IDacervo' AND ativo='S'";

$datacriacao = date('Y-m-d');

$result = $conn->query($sql);
$dataComp= "2016-12-12";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	if($IDacervo == $row["idAcervo"]){

    			$sqlio = "SELECT idAluno, idAcervo, dataReserva, tempoEspera, emprestou, ativo FROM reservas WHERE idAcervo = '$IDacervo' AND ativo='S'";

				$resulta = $conn->query($sqlio);


				if ($resulta->num_rows > 0) {
				    while($rows = $resulta->fetch_assoc()) {
			    		if($IDacervo == $rows["idAcervo"]){

			    			$dataCompa = date_create($dataComp);
				      		$dataRes = date_create($rows["dataReserva"]);
				      		$diferenca = date_diff($dataCompa,$dataRes);


				      		$dife = $diferenca->format("%R%a");

			    			if($dife>0){
			    				$dataComp=$rows["dataReserva"];
			    				$daysDife=$rows["tempoEspera"];
			    			}
			    		}
			    	}
			    	$daysDif = 'P'.$daysDife.'D';
		    		$dataCompe = new DateTime($dataComp);
		    		$dataCompe->add(new DateInterval($daysDif));
			    	$dataCompe->add(new DateInterval('P1D'));
		    		$datarres = $dataCompe->format('Y-m-d');

		    		$datamaaior= date_create($datadevolucao);
		      		$datameenor= date_create($datacriacao);
		      		$temp=date_diff($datameenor,$datamaaior);
		      		$tempoesp = $temp->format("%a");


		    		$sqlii = "INSERT INTO reservas (idAluno, idAcervo, dataReserva, tempoEspera, emprestou, ativo) VALUES ('$IDaluno', '$IDacervo', '$datarres', '$tempoesp', 'N', 'S')";


				if ($conn->query($sqlii) === TRUE) {
				echo "<div class=\"container-fluid\">";
				echo "<div class=\"corpo\">";
	            echo "<div class=\"titulo\">";
	            echo "<h1>";
	            echo "<b>Reserva efetuada!</b>";
	            echo "</h1>";
	             echo "<h1><h5>Acervo já está emprestado... Reserva efetuada para o dia: ".$datarres."</h5></h1>" ;
	            echo "<div class=\"row\">
	                  <div class=\"col-md-12 mb-3\">
	                  <div class=\"container-fluid\">
	                  <button type=\"button\" style=\"margin-top: 70px;\"class=\"btn btn-info \" onclick=\"location.href= '../../Entrada/gerencia-web-interface-bibliotecario.php?acao=adicionarEmprestimo'\">Pronto</button>
	                  </div>
	                  </div>
	                  </div>";
	            echo "</div>";
	            echo "</div>";
	            echo "</div>";
	            $conn->close();

			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}


		}else{


			$dataMaior= date_create($row["dataPrevisaoDevolucao"]);
      		$dataMenor= date_create($row["dataEmprestimo"]);
			$datarres=@date_diff($dataMenor,$dataMaior);
			$datarrres = $datarres->format("%a");
			//$daysDif = 'P'.$datarrres.'D';
			$dataMaiorParaDataRes = new DateTime($row["dataPrevisaoDevolucao"]);
			//$dataMaiorParaDataRes->add(new DateInterval($daysDif));
			$dataMaiorParaDataRes->add(new DateInterval('P1D'));

    		$dataReserva = $dataMaiorParaDataRes->format('Y-m-d');



















			$datamaaior= date_create($datadevolucao);
      		$datameenor= date_create($datacriacao);
      		$temp=date_diff($datameenor,$datamaaior);
      		$tempoesp = $temp->format("%a");

			$sqlii = "INSERT INTO reservas (idAluno, idAcervo, dataReserva, tempoEspera, emprestou, ativo) VALUES ('$IDaluno', '$IDacervo', '$dataReserva', '$tempoesp', 'N', 'S')";

			if ($conn->query($sqlii) === TRUE) {
				echo "<div class=\"container-fluid\">";
				echo "<div class=\"corpo\">";
	            echo "<div class=\"titulo\">";
	            echo "<h1><h5>Acervo já está emprestado... Reserva efetuada para o dia: ".$dataReserva."</h5></h1>" ;
	            echo "<h1>";
	            echo "<b>Reserva efetuada!</b>";
	            echo "</h1>";
	            echo "<div class=\"row\">
	                  <div class=\"col-md-12 mb-3\">
	                  <div class=\"container-fluid\">
	                  <button type=\"button\" style=\"margin-top: 70px;\"class=\"btn btn-outline-info btn-block \" onclick=\"../../Entrada/gerencia-web-interface-bibliotecario.php?acao=adicionarEmprestimo'\">Pronto</button>
	                  </div>
	                  </div>
	                  </div>";
	            echo "</div>";
	            echo "</div>";
	            echo "</div>";
	            $conn->close();

			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

		}


    		$sql = "SELECT idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo FROM emprestimos WHERE idAcervo = '$IDacervo' AND ativo='S'";







    		$dataprev = new DateTime($row["dataPrevisaoDevolucao"]);
    		$dataprev->add(new DateInterval('P1D'));
    		$datanova = $dataprev->format('Y-m-d');


    		$datamaior= date_create($datadevolucao);
      		$datamenor= date_create($datacriacao);
      		$tempo=date_diff($datamenor,$datamaior);
      		$time = $tempo->format("%a");
				


		}
	}

}else{

	$sql = "INSERT INTO emprestimos (idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo) VALUES ('$IDaluno', '$IDacervo', '$datacriacao', '$datadevolucao', '$datadevolucao', '$multa', '$ativo')";


	if ($conn->query($sql) === TRUE) {
		echo "<div class=\"container-fluid\">";
		echo "<div class=\"corpo\">";
        echo "<div class=\"titulo\">";
        echo "<h1 style=\"margin-top: 40px\">";
        echo "Reserva efetuada com sucesso!";
        echo "</h1>";
        echo "<div class=\"row\">
              <div class=\"col-md-12 mb-3\">
              <div class=\"container-fluid\">
              <button type=\"button\" style=\"margin-top: 70px;\"class=\"btn btn-info \" onclick=\"../../Entrada/gerencia-web-interface-bibliotecario.php?acao=adicionarEmprestimo'\">Pronto</button>
              </div>
              </div>
              </div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        $conn->close();

	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

}

require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-rodape-caso-2.php";


?>


</body>
</html>