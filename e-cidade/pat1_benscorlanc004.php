<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2012  DBselller Servicos de Informatica             
 *                            www.dbseller.com.br                     
 *                         e-cidade@dbseller.com.br                   
 *                                                                    
 *  Este programa e software livre; voce pode redistribui-lo e/ou     
 *  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme  
 *  publicada pela Free Software Foundation; tanto a versao 2 da      
 *  Licenca como (a seu criterio) qualquer versao mais nova.          
 *                                                                    
 *  Este programa e distribuido na expectativa de ser util, mas SEM   
 *  QUALQUER GARANTIA; sem mesmo a garantia implicita de              
 *  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM           
 *  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais  
 *  detalhes.                                                         
 *                                                                    
 *  Voce deve ter recebido uma copia da Licenca Publica Geral GNU     
 *  junto com este programa; se nao, escreva para a Free Software     
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA          
 *  02111-1307, USA.                                                  
 *  
 *  Copia da licenca no diretorio licenca/licenca_en.txt 
 *                                licenca/licenca_pt.txt 
 */

require("libs/db_stdlib.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_usuariosonline.php");
include("dbforms/db_funcoes.php");
include("classes/db_benscorlanc_classe.php");
$clbenscorlanc = new cl_benscorlanc;
db_postmemory($HTTP_POST_VARS);
$db_opcao = 1;
$db_botao = true;

if(isset($incluir)){
  $sqlerro=false;
  if($sqlerro==false){
    db_inicio_transacao();
    $clbenscorlanc->incluir($t62_codcor);
    if($clbenscorlanc->erro_status==0){
      $sqlerro=true;
    } 
    $erro_msg = $clbenscorlanc->erro_msg; 
    db_fim_transacao($sqlerro);
    $t62_codcor= $clbenscorlanc->t62_codcor;
  }
}
?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#CCCCCC leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" >
<center>
	<?
	include("forms/db_frmbenscorlanc.php");
	?>
</center>
</body>
</html>
<?
if(isset($incluir)){
  db_msgbox($erro_msg);
  if($sqlerro==true){
    if($clbenscorlanc->erro_campo!=""){
      echo "<script> document.form1.".$clbenscorlanc->erro_campo.".style.backgroundColor='#99A9AE';</script>";
      echo "<script> document.form1.".$clbenscorlanc->erro_campo.".focus();</script>";
    };
  }else{
   db_redireciona("pat1_benscorlanc005.php?liberaaba=true&chavepesquisa=$t62_codcor");
  }
}
?>