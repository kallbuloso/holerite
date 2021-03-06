<?php
//Ordenação por coluna
if (isset($_SESSION['posts']['order'])){
	$_SESSION['order'] = $_SESSION['posts']['order'];
	if ($_SESSION['order']=='Desc_mat'){
		$order = 'ORDER BY matricula DESC';
	}
	elseif ($_SESSION['order']=='Asc_mat'){
		$order = 'ORDER BY matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_nome'){
		$order = 'ORDER BY nome DESC';
	}
	elseif ($_SESSION['order']=='Asc_nome'){
		$order = 'ORDER BY nome ASC';
	}
	elseif ($_SESSION['order']=='Asc_data'){
		$order = 'ORDER BY dataCadastro ASC, matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_data'){
		$order = 'ORDER BY dataCadastro DESC, matricula ASC';
	}
	elseif ($_SESSION['order']=='Asc_setor'){
		$order = 'ORDER BY setor ASC, matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_setor'){
		$order = 'ORDER BY setor DESC, matricula ASC';
	}
	else {
		$order = 'ORDER BY matricula ASC';
	}
}
else {
	if (!isset($_SESSION['order'])){
		$_SESSION['order'] = 'Asc_mat';
	}
	if ($_SESSION['order']=='Desc_mat'){
		$order = 'ORDER BY matricula DESC';
	}
	elseif ($_SESSION['order']=='Asc_mat'){
		$order = 'ORDER BY matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_nome'){
		$order = 'ORDER BY nome DESC';
	}
	elseif ($_SESSION['order']=='Asc_nome'){
		$order = 'ORDER BY nome ASC';
	}
	elseif ($_SESSION['order']=='Asc_setor'){
		$order = 'ORDER BY setor ASC, matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_setor'){
		$order = 'ORDER BY setor DESC, matricula ASC';
	}
	elseif ($_SESSION['order']=='Asc_data'){
		$order = 'ORDER BY dataCadastro ASC, matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_data'){
		$order = 'ORDER BY dataCadastro DESC, matricula ASC';
	}
	else {
		$order = 'ORDER BY matricula ASC';
	}
}
//Fim ordenação por coluna

//Seleção quantidade de itens a mostrar
if (isset($_SESSION['posts']['numitems'])){
	$numitems = $_SESSION['posts']['numitems'];
	$_SESSION['numitems'] = $_SESSION['posts']['numitems'];
	$_SESSION['pagina'] = 1;
}
else {
	if (!isset($_SESSION['numitems'])){
		$numitems = 30;
	}
	else {
		$numitems = $_SESSION['numitems'];
	}
}
//Fim Seleção quantidade de itens a mostrar

if (isset($_SESSION['posts']['busca'])){
	$_SESSION['pagina'] = 1;
}

if (isset($_SESSION['posts']['nump'])){
	$_SESSION['pagina'] = $_SESSION['posts']['nump'];
}
if (isset($_SESSION['pagina'])){
	$inicio = $numitems*($_SESSION['pagina']-1);
	$fim = ($numitems*$_SESSION['pagina'])-1;
}
else {
	$_SESSION['pagina'] = 1;
	$inicio = 0;
	$fim = 29;
}

if (isset($_SESSION['posts']['txt_busca'])){
	$_SESSION['txt_busca'] = $_SESSION['posts']['txt_busca'];
	$query = "SELECT count(*) FROM users LEFT JOIN setor ON id_setor=fk_id_setor WHERE nome LIKE '%".$_SESSION['txt_busca']."%' OR matricula LIKE '%".$_SESSION['txt_busca']."%' OR setor LIKE '%".$_SESSION['txt_busca']."%';";
}
elseif (isset($_SESSION['txt_busca'])){
	$query = "SELECT count(*) FROM users LEFT JOIN setor ON id_setor=fk_id_setor WHERE nome LIKE '%".$_SESSION['txt_busca']."%' OR matricula LIKE '%".$_SESSION['txt_busca']."%' OR setor LIKE '%".$_SESSION['txt_busca']."%';";
}
else {
	$query = "SELECT count(*) FROM users;";
}

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result,  MYSQL_NUM);
if (!isset($paginas)){
	$paginas = ceil($row[0]/$numitems);
}
?>


<form method="POST" action="?pagina=<?php echo $gerenciar;?>">
<?php include "includes/paginacao.php";?>
	<div class="well clearfix">
		<div class="row">
		  <div class="col-xs-4">
			  <div class="input-group">
			  <?php
				if (isset($_SESSION['txt_busca'])){
					echo "<input type='text' name='txt_busca' class='form-control' placeholder='Nome, matrícula ou VR' value='$_SESSION[txt_busca]' tabindex='-1'></input>";
				}
				else {
					echo "<input type='text' name='txt_busca' class='form-control' placeholder='Nome, matrícula ou VR' tabindex='-1'></input>";
				}
			  ?>
			  
			  <span class="input-group-btn">
				<button class="btn btn-default" type="submit" name='busca'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
			  </span>
			</div>

		  </div>
		  <div class="col-xs-8">
			<div class="input-group pull-right">
				<button class="btn btn-info" type="submit" name='relatorio'>Gerar Relatório</button>
			</div>
		  </div>
		</div>
		</p>
		
		<table class="table table-hover" style="background-color: #FFFFFF;border-radius: 10px;">
		
			<thead>
			<td style='width: 38px;'>
				<input class="btn btn-link" type='checkbox' id='select_all'>
			</td>
				<?php
				if (!isset($_SESSION['order'])){
					echo "
                                             <td style='width: 130px;'>
                                                <button class='btn btn-link form-control' type='submit' value='Desc_mat' name='order' style='text-align:left'>
                                                    <b>
                                                        <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                        </span>
                                                        Matrícula
                                                    </b>
                                                </button>
                                            </td>";
					echo "
                                            <td style='width: 360px;'>
                                                <button class='btn btn-link form-control' type='submit' value='Desc_nome' name='order' style='text-align:left'>
                                                    <b>
                                                        <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                        </span>
                                                        Nome
                                                    </b>
                                                </button>
                                            </td>";
					echo "
                                            <td class='visible-lg' style='width: 200px;'>
                                                <button class='btn btn-link form-control' type='submit' value='Desc_data' name='order' style='width: 200px; text-align:left;'>
                                                    <b>
                                                        <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                        </span>
                                                        Data de Cadastro
                                                    </b>
                                                </button>
                                            </td>";
					echo "
                                            <td class='hidden-xs'>
                                                <button class='btn btn-link form-control' type='submit' value='Desc_setor' name='order' style='text-align:left;'>
                                                    <b>
                                                        <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                        </span>
                                                        VR
                                                    </b>
                                                </button>
                                            </td>";
				}
				else {
					if ($_SESSION['order']=='Desc_mat'){
						echo "
                                                    <td style='width: 130px;'>
                                                        <button class='btn btn-link form-control' type='submit' value='Asc_mat' name='order' style='text-align:left'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-up' aria-hidden='true'>
                                                                </span>
                                                                Matrícula
                                                            </b>
                                                        </button>
                                                    </td>";
					}
					else {
						echo "
                                                    <td style='width: 130px;'>
                                                        <button class='btn btn-link form-control' type='submit' value='Desc_mat' name='order' style='text-align:left'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                                </span>
                                                                Matrícula
                                                            </b>
                                                        </button>
                                                    </td>";
					}
					if ($_SESSION['order']=='Desc_nome'){
						echo "
                                                    <td style='width: 360px;'>
                                                        <button class='btn btn-link form-control' type='submit' value='Asc_nome' name='order' style='text-align:left'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-up' aria-hidden='true'>
                                                                </span>
                                                                Nome
                                                            </b>
                                                        </button>
                                                    </td>";
					}
					else {
						echo "
                                                    <td style='width: 360px;'>
                                                        <button class='btn btn-link form-control' type='submit' value='Desc_nome' name='order' style='text-align:left'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                                </span>
                                                                Nome
                                                            </b>
                                                        </button>
                                                    </td>";
					}
					if ($_SESSION['order']=='Desc_data'){
						echo "
                                                    <td class='visible-lg' style='width: 200px;'>
                                                        <button class='btn btn-link form-control' type='submit' value='Asc_data' name='order' style='width: 200px; text-align:left;'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-up' aria-hidden='true'>
                                                                </span>
                                                                Data de Cadastro
                                                            </b>
                                                        </button>
                                                    </td>";
					}
					else {
						echo "
                                                    <td class='visible-lg' style='width: 200px;'>
                                                        <button class='btn btn-link form-control' type='submit' value='Desc_data' name='order' style='width: 200px; text-align:left;'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                                </span>
                                                                Data de Cadastro
                                                            </b>
                                                        </button>
                                                    </td>";
					}
					if ($_SESSION['order']=='Desc_setor'){
						echo "
                                                    <td class='hidden-xs'>
                                                        <button class='btn btn-link form-control' type='submit' value='Asc_setor' name='order' style='text-align:left;'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-up' aria-hidden='true'>
                                                                </span>
                                                                VR
                                                            </b>
                                                        </button>
                                                    </td>";
					}
					else {
						echo "
                                                    <td class='hidden-xs'>
                                                        <button class='btn btn-link form-control' type='submit' value='Desc_setor' name='order' style='text-align:left;'>
                                                            <b>
                                                                <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                                                                </span>
                                                                VR
                                                            </b>
                                                        </button>
                                                    </td>";
					}
				}
				?>
			</thead>
		</table>
		
		<table id='lista_usuario' class="table table-hover" style="background-color: #FFFFFF;border-radius: 10px;">
		
			<?php
			if (isset($_SESSION['posts']['txt_busca'])){
				$query = "SELECT matricula, nome, dataCadastro, setor FROM users LEFT JOIN setor ON id_setor=fk_id_setor WHERE nome LIKE '%".$_SESSION['txt_busca']."%' OR matricula LIKE '%".$_SESSION['txt_busca']."%' OR setor LIKE '%".$_SESSION['txt_busca']."%' $order LIMIT $inicio, $fim";
			}
			elseif (isset($_SESSION['txt_busca'])){
				$query = "SELECT  matricula, nome, dataCadastro, setor FROM users LEFT JOIN setor ON id_setor=fk_id_setor WHERE nome LIKE '%".$_SESSION['txt_busca']."%' OR matricula LIKE '%".$_SESSION['txt_busca']."%' OR setor LIKE '%".$_SESSION['txt_busca']."%' $order LIMIT $inicio, $fim";
			}
			else {
				$query = "SELECT matricula, nome, dataCadastro, setor FROM users LEFT JOIN setor ON id_setor=fk_id_setor $order LIMIT $inicio, $fim";
			}
			$result = mysqli_query($conn, $query);
			while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$matricula = $row["matricula"];
				$nome = $row["nome"];
				$dataCadastro = date_format(new DateTime($row["dataCadastro"]),'d/m/Y');
				$setor = $row["setor"];
				echo "<tr><td style='width: 58px;'><input name='matriculas[]' type='checkbox' value=$matricula></td><td style='width: 130px;'>$matricula</td><td style='width: 360px;'><button type='submit' class='btn btn-link' style='padding: 0px' name='seleciona_usuario' value=$matricula>$nome</button></td><td class='visible-lg' style='width: 220px;'>$dataCadastro</td><td class='hidden-xs'>$setor</td></tr>";
			}
			?>
		</table>
			<div class="input-group pull-right">
				<button class="btn btn-info" type="submit" name='relatorio'>Gerar Relatório</button>
			</div>
	</div>
<?php include "includes/paginacao.php"; ?>
</form>