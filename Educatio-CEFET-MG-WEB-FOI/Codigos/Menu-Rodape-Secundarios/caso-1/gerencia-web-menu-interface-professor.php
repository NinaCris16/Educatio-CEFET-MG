<!DOCTYPE html>
<html>
<head>	
    <title>Login - Educatio - CEFET-MG</title>
    <meta charset="utf-8">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-default">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand"><img class="logo" src="../../Estaticos/Logo/Educatio.png"></a>
            
        <div id="menu" class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="gerencia-web-interface-professor.php?acao=acessarDiarios"><i class="nc-icon nc-book-bookmark"></i>Diários</a>
                </li>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="false"><i class="nc-icon nc-book-bookmark"></i>Etapas</a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href= "gerencia-web-interface-professor.php?acao=adicionarEtapa">Adicionar etapas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="gerencia-web-interface-professor.php?acao=removerEtapa">Remover etapas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="gerencia-web-interface-professor.php?acao=alterarEtapa">Alterar etapas</a>                       
                    </ul>
                </div>
            </ul>
            <ul class="nav navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="false"><?php echo '<img class="profile" src="data:image/jpeg;base64,'.base64_encode( $usuario['foto'] ).'"/>';?>  <?php echo $usuario['nome'];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="gerencia-web-perfil-professor.php">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href= "../Login/gerencia-web-login.html" onclick = "fazerLogout()">Sair</a>
                    </ul>
                </div> 
            </ul>
        </div>
    </nav>   
</body>
</html>