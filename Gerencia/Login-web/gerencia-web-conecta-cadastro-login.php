<?php 

include "gerencia-web-cadastro-login.php";

$login = $_POST['idsuario'];
$senha = $_POST['senha'];
$confirmaSenha = $_POST['confirmaSenha'];
$opcao = $_POST['opcao'];

if($opcao == 'Aluno(a)')
{
	if(Cadastra::CadastrarAluno($login, $senha, $confirmaSenha)){}
} 

/*else if ($opcao == 'Professor(a)')
{
	
		
	
}
	
else if ($opcao == 'Bibliotecario(a)')
{
	
		
	
} 
	
else if ($opcao == 'Coordenador(a)')
{
		
		
	
}*/

?>