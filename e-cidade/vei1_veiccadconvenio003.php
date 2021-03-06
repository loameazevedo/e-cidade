<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2009  DBselller Servicos de Informatica             
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
include("classes/db_veiccadconvenio_classe.php");
include("classes/db_veiccadconveniocgm_classe.php");

parse_str($HTTP_SERVER_VARS["QUERY_STRING"]);
db_postmemory($HTTP_POST_VARS);

$clveiccadconvenio    = new cl_veiccadconvenio;
$clveiccadconveniocgm = new cl_veiccadconveniocgm;

$db_botao = false;
$db_opcao = 33;
if(isset($excluir)){
  $sqlerro  = false;
  $erro_msg = "";

  db_inicio_transacao();

  $db_opcao = 3;

  if (isset($ve18_numcgm) && trim($ve18_numcgm)!=""){
    $result = $clveiccadconveniocgm->sql_record($clveiccadconveniocgm->sql_query(null,"ve18_sequencial",null,"ve18_veiccadconvenio = $ve17_sequencial"));
    if ($clveiccadconveniocgm->numrows > 0){
      db_fieldsmemory($result,0);
      $clveiccadconveniocgm->ve18_sequencial = $ve18_sequencial;

      $clveiccadconveniocgm->excluir($ve18_sequencial);
      if ($clveiccadconveniocgm->erro_status == "0"){
        $sqlerro  = true;
        $erro_msg = $clveiccadconveniocgm->erro_msg;
      }
    }
  }

  if ($sqlerro == false){
    $clveiccadconvenio->excluir($ve17_sequencial);
    $erro_msg = $clveiccadconvenio->erro_msg;
  }

  db_fim_transacao($sqlerro);
}else if(isset($chavepesquisa)){
   $db_opcao = 3;
   $result = $clveiccadconvenio->sql_record($clveiccadconvenio->sql_query($chavepesquisa)); 
   db_fieldsmemory($result,0);
   
   $result = $clveiccadconveniocgm->sql_record($clveiccadconveniocgm->sql_query(null,"ve18_numcgm,z01_nome",null,"ve18_veiccadconvenio = $chavepesquisa"));
   if ($clveiccadconveniocgm->numrows > 0){
     db_fieldsmemory($result,0);
   }

   $db_botao = true;
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
<table width="790" border="0" cellpadding="0" cellspacing="0" bgcolor="#5786B2">
  <tr> 
    <td width="360" height="18">&nbsp;</td>
    <td width="263">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="140">&nbsp;</td>
  </tr>
</table>
<table width="790" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="430" align="left" valign="top" bgcolor="#CCCCCC"> 
    <center>
	<?
	include("forms/db_frmveiccadconvenio.php");
	?>
    </center>
	</td>
  </tr>
</table>
<?
db_menu(db_getsession("DB_id_usuario"),db_getsession("DB_modulo"),db_getsession("DB_anousu"),db_getsession("DB_instit"));
?>
</body>
</html>
<?
if(isset($excluir)){
  if($clveiccadconvenio->erro_status=="0"){
    $clveiccadconvenio->erro(true,false);
  }else{
    $clveiccadconvenio->erro(true,true);
  }
}
if($db_opcao==33){
  echo "<script>document.form1.pesquisar.click();</script>";
}
?>
<script>
js_tabulacaoforms("form1","excluir",true,1,"excluir",true);
</script>