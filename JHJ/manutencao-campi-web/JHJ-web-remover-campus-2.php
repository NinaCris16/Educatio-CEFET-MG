<?php
    session_start();
    $select = $_POST['selectParaExcluirCampus'];
    foreach($select as $_valor){
        //pega id do campus que sera excluido
        $intIdCampus = $_valor;
        $_SESSION['intIdCampus'] =  $intIdCampus;
    }
    // Conectando com o servidor MySQL
    $link = mysqli_connect("localhost", "root", "");
    if (!$link){
    //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
    } else {
    //     echo "Conexao efetuada com sucesso!<br/>";
    }
    // Selecionado BD
    $sql = mysqli_select_db($link, 'Educatio');
?>
<html>
    <head>
        <title>Remover Campus</title>
        <meta charset="utf-8">
              
        <!-- CSS do Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="css/JHJ-web-estilos.css" rel="stylesheet"/>
        <link href="css/JHJ-web-estilos-painel.css" rel="stylesheet"/>

        <!-- Arquivos js -->
        <script src="js/popper.js"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/JHJ-web-script-remover-campus.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="css/nucleo-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">         
            <div class="section landing-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center">EXCLUSÃO DE CAMPUS</h2>
                            <?php
                                //Verificando se existem departamentos ligados com o campus selecionado
                                if ($result = mysqli_query($link, " SELECT id FROM deptos WHERE idCampi = $intIdCampus AND ativo = 'S' ")) {
                                    //total de departamentos do campus selecionado
                                    $intTotalDeptosCampusSelecionado = mysqli_num_rows($result);
                                    mysqli_free_result($result);
                                } else {
                                    // echo "erro";
                                }

                                if($intTotalDeptosCampusSelecionado > 0) {
                                    if ($result = mysqli_query($link, "SELECT id FROM deptos")) {
                                        //total de linhas da tabela deptos
                                        $intTotalLinhasTabelaDeptos = mysqli_num_rows($result);
                                        mysqli_free_result($result);
                                    } else {
                                        // echo "erro";
                                    }
                                    //Verifica linha por linha na tabela e salva o nome dos departamentos em um vetor
                                    $intJ = 0;
                                    for ($intI = 1; $intI <= $intTotalLinhasTabelaDeptos; $intI++){
                                        if ($query = mysqli_query($link, " SELECT nome FROM deptos WHERE id = $intI AND idCampi = $intIdCampus AND ativo = 'S' ")) {
                                            $departamento = mysqli_fetch_array($query);
                                            if($departamento['nome'] != null){
                                                $strVetorNomesDeptos[$intJ] = $departamento['nome']; 
                                                $intJ++;
                                            }
                                        }
                                    }
                                } else if($intTotalDeptosCampusSelecionado == 0) {
                                    //Seleciona os dados do campus com id recebido pelo select
                                    $query = mysqli_query($link, " SELECT nome, cidade, UF, ativo FROM campi WHERE id = $intIdCampus ");
                                    while($campus = mysqli_fetch_array($query)) { 
                                        $strNomeCampus = $campus['nome'];
                                        $strCidadeCampus = $campus['cidade'];
                                        $strUFCampus = $campus['UF'];
                                        $strAtivoCampus = $campus['ativo']; 
                                    }
                                    //Tornando campus inativo ("excluindo")
                                    $sql = "UPDATE campi SET ativo = 'N' WHERE id = $intIdCampus";
                                    if (mysqli_query($link, $sql)) {
                                    //     echo "sucesso";
                                    }else{
                                    //     echo "erro";
                                    }
                                }
                            ?>

                            <!-- exibindo informações dentro de um painel -->
                            <?php
                                if($intTotalDeptosCampusSelecionado > 0) {
                                echo "
                                <div class='container' style='margin-top: 50px;'>
                                    <div class='row'>
                                        <div class='col-md-8 ml-auto mr-auto'>                    
                                            <div class='panel'>
                                                <div class='panel-heading' style='margin-top: 0px;'>
                                                    <div class='panel-title'>O campus selecionado está interligado com ".$intTotalDeptosCampusSelecionado." departamento(s)!</div>
                                                </div>  
                                                <div style='padding-top: 20px' class='panel-body' id='padin'>  
                                                    <p style='font-weight: bold;'>Nome(s) do(s) departamento(s):</p>"; 
                                                    foreach ($strVetorNomesDeptos as $valor) {
                                                        echo $valor."<br>";
                                                    }
                                                    echo "<br>";
                                                    echo "
                                                    <div class='row'>
                                                        <div style='float: left;' class='col-md-4 ml-auto mr-auto'>
                                                            <button style='margin-bottom: 10px; margin-left: -20px; padding-botton: 10px;' type='button' class='btn btn-info btn-round' onClick='irParaPaginaExclusaoCampusComDepartamentos()'>Estou ciente e desejo continuar!</button>
                                                        </div>
                                                        <div style='float: left;' class='col-md-4 ml-auto mr-auto'>
                                                            <button style='margin-bottom: 10px; margin-left: 25px;' type='button' class='btn btn-info btn-round' onClick='voltarParaPaginaExclusaoCampus()'>Voltar</button>
                                                        </div>
                                                    </div>                   
                                                </div>  
                                            </div> <!-- panel -->
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- conteiner -->";

                                } else if($intTotalDeptosCampusSelecionado == 0) {
                                    echo "
                                    <div class='container' style='margin-top: 50px;'>
                                        <div class='row'>
                                            <div class='col-md-8 ml-auto mr-auto'>                    
                                                <div class='panel'>
                                                    <div class='panel-heading' style='margin-top: 0px;'>
                                                        <div class='panel-title'>Campus removido com sucesso!*</div>
                                                    </div>  
                                                    <div style='padding-top: 20px' class='panel-body' id='padin'>  
                                                        <p style='font-weight: bold;'>As informações do campus excluído são:</p> 
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>Nome:</label> ".$strNomeCampus."</p>
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>Cidade:</label> ".$strCidadeCampus."</p>
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>UF:</label> ".$strUFCampus."</p>
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>*</label>O campus  não estava interligado com nenhum departamento.</p>
                                                        <div class='row'>
                                                            <div class='col-md-4 ml-auto mr-auto'>
                                                                <button style='margin-bottom: 10px; margin-left: 10px;' type='button' class='btn btn-info btn-round' onClick='voltarParaPaginaExclusaoCampus()'>VOLTAR</button>
                                                            </div>
                                                        </div>                     
                                                    </div>  
                                                </div> <!-- panel -->
                                            </div>
                                        </div> <!-- row -->
                                    </div> <!-- conteiner -->";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>