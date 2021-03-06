<!DOCTYPE html>
<html lang="pt-br">
  <head class="hidden-print">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="imgs/iconelogo.ico">

    <title>Holerite Online Sankyu</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/sticky-footer.min.css" rel="stylesheet">
	<link href="css/jumbotron.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top" style="box-shadow: 0 0 3px 1px #333;">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand" href="index.php">
			<img class="img-responsive" src="imgs/holeriteNome.png" width="175" style="padding-top:5px;"></a>
			<div class="navbar-toggle" style="padding:0;border:0;">
			<button class="btn btn-success" type="button" data-toggle="modal" data-target="#login">Login</button>
			</div>
        </div>
		<button onClick="$('#login').on('shown.bs.modal', function() {$(this).find('input:first').focus();});" class="btn btn-success navbar-btn navbar-right hidden-sm hidden-xs" type="button" data-toggle="modal" data-target="#login">Login</button>
      </div>
    </nav>
	
    <!-- Main jumbotron for a primary marketing message or call to action -->
<div class="hidden-xs hidden-print navbar-default clearfix">
	<img class="pull-right" src="imgs/holerite.png" width="80%">
</div>
    <div class="container" style="padding-top:15px;">
	<!--Modal Errors-->
	<?php
	if (isset($login)) {
		if ($login->errors) {
			foreach ($login->errors as $error) {?>
			<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
				<div class="modal-content panel panel-danger">
				  <div class="modal-header panel-heading">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" align="center"><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Problema no login!</strong></h4>
				  </div>
				  <div class="modal-body panel-body">
					<div align="center"><?php echo "$error";?></div>
				  </div>
				</div>
			  </div>
			</div><?php
			}
		}
		if ($login->messages) {
			foreach ($login->messages as $message) {
				if ($message=='logout'){?>
					<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog modal-sm" role="document">
						<div class="modal-content panel panel-success">
						  <div class="modal-header panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel" align="center"><strong>Logout!</strong></h4>
						  </div>
						  <div class="modal-body">
							<div>Sua sessão foi finalizada com sucesso!</div>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">OK</button>
						  </div>
						</div>
					  </div>
					</div><?php
				}
				elseif ($message<>''){?>
					<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog modal-sm" role="document">
						<div class="modal-content panel panel-info">
						  <div class="modal-header panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel" align="center"><strong><?php echo $login->titulo_mensagem;?></strong></h4>
						  </div>
						  <div class="modal-body panel-body">
							<div align='justify'><?php echo "$message";?></div>
						  </div>
						</div>
					  </div>
					</div><?php
				}
			}
		}
	}
	?><!--Fim Modal Errors-->
			<!-- Modal Login -->
			<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
				<div class="modal-content" style="background-color:#DFF0D8;color: #3c763d;">
				  <div class="modal-header ">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" align="center"><b>Login</b></h4>
				  </div>
				  <div class="modal-body clearfix">
					<form method="post" action="index.php" name="loginform">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" maxlength="8" name="user_name" id="matricula" placeholder="Matrícula" required>                                        
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="password" type="password" class="form-control" name="user_password" placeholder="Senha" required>                                        
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
								<input id="password" type="password" maxlength="4" class="form-control" name="uniqueCode" placeholder="Chave de Segurança" required>                                        
							</div>
						</div>
						<div class="input-group pull-right">
							<button type="submit" class="btn btn-success pull-right" name="login" value="Entrar">Entrar</button>
						</div>
						<?php 
						$unique = md5(uniqid(rand(), true));
						echo "<input type=hidden value='$unique' name=id_sessao>";
						?>
					</form>
				  </div>
				</div>
			  </div>
			</div>
			<!--End Modal-->
	<div class="well">
	<p style="font-size:16px;"><b>Seja bem vindo!</b></p><br>
		<p align='justify'>
		Este é o mais novo portal com informações relevantes para facilitar a comunicação entre a empresa
		<b><i>Sankyu S/A</i></b> e seus colaboradores. O intuito principal, é a disponibilização dos holerites (contra-cheques) dos últimos 6 meses.
		Ou seja, todo colaborador poderá acessar e imprimir o seu contra-cheque de qualquer lugar, no trabalho, de casa, pelo seu smartphone, 
		lanhouse ou qualquer outro dispositivo que esteja conectado a internet.</br></br>
		<strong>Para facilitar o uso estamos disponibilizando 
		<a href='Manual_Holerite.pdf' target="_blank">neste link</a> o manual a fim de explicar o manuseio do Holerite Online. </strong></br></br>
		Com isso, estamos economizando com tempo e estamos também diminuindo a burocracia com a divulgação de certas informações. 
		Esse é mais um avanço da <b><i>Sankyu S/A</i></b> e de certo que será um grande ganho para o colaborador. <br><br>
		Contamos com a colaboração de todos.<br></br>
		<p align="right" style="font-family:Cambria; font-size:18px; line-height:1px;">Carlos Ito</p>
		<p align="right">Diretor Executivo</p>
		</p>
	</div>
</div>
	

	<!-- /container -->
	<?php include "views/footer.php";?>

	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
	<?php if (isset($login)){
		echo "<script>$('#error').modal('show');</script>";
	}?>
  </body>
</html>
