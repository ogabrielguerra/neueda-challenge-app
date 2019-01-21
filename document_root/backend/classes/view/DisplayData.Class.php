<?php
	class DisplayData extends View{

		private $queryResult;
		private $tituloLabel;
		private $textoLabel;
		private $resumoLabel;
		private $linkLabel;
		private $itensPorPagina;
		private $numeroRange;
		private $numeroFields;
		private $numeroColums;
		private $headerTitle;
		private $numeroRows;
		private $colSpan;
		private $withDate;
		private $stringTotal;
		private $tdId = 0;
		private $paginaDeComentario;
		private $concat;
		private $concatPaginaDeComentario;
		private $idConteudo;
		private $tituloConteudo;
		private $textoConteudo;
		private $usuarioLogin;
		private $id;
		private $idTipoConteudoLabel;
		private $somaComentario;
		private $arrayData = array();
		private $arrayOfLabels = array();
		private $arrayPaging = array();
		private $arrayDate = array();

		public function tableOptions($queryResult, $headerTitle, $myLink, $numRange, $arrayOfLabels, $editPage, $delPage){
			$numFields = mysqli_num_fields($queryResult);
			$numColums = $numFields-($numRange);
			$numRows = mysqli_num_rows($queryResult);
			$colSpan = $numFields-($numRange) + 1;

			if($numRows != 0){
				echo '<p class="numRegistros">'.$numRows.' registro(s) encontrado(s).</p>';
				//echo '<center>';
				echo '<table border="0" class="tabela-default" cellpadding="0" cellspacing="0">';
				echo '<tr><th colspan="'.$colSpan.'">'.$headerTitle.'</th></tr>';

				echo '<tr>';
				for($i=0; $i<count($arrayOfLabels); $i++){
					echo '<td class="columnLabel">'.$arrayOfLabels[$i].'</td>';
				}
				//Options
				echo '<td class="columnLabel">A&ccedil;&otilde;es</td>';
				echo '</tr>';
				$tdId = 0;
				echo '<script language="javascript">';
				echo 'function validaDelete(pagina){';
				echo 'var opcaoUsuario = confirm("Esta a��o ir� apagar todos os dados deste conte�do.\nClique em OK para apagar e em Cancelar para retorna a pagina de edi��o.");';
				echo 'if(opcaoUsuario){window.location=pagina;}';
				echo 'else{history.back;}}';
				echo '</script>';

				//verifica se j� existem par�metros na URL
				$check = new HandleStrings();
				$concat = $check->checkUrlGets();
				$concatEdit = $check->switchConcat($editPage);
				$concatDel = $check->switchConcat($delPage);
				$estilo = 0;

				while($arrayData = mysqli_fetch_array($queryResult)){

					echo '<tr id="tr-'.$tdId.'">';
					for($j=0; $j<$numColums; $j++){
						if(!empty($arrayData[$j + $numRange])){
							$tdConteudo = parent::switchSpecialChars($arrayData[$j + $numRange]);
						}else{
							$tdConteudo = "-";
						}

						if ($estilo == 1){
							$tdStyle = 'style="background-color:#DDDDDD; padding: 0px 10px;"';
							$estilo = 0;
						}else{
							$tdStyle = '';
							$estilo = 1;
						}


						if(!empty($myLink)){
							echo '<td '.$tdStyle.' style="padding: 0px 10px;"><a href="'.$myLink.$concat.'id='.$arrayData[0].'">'.substr($tdConteudo, 0, 80).'</a></td>';
						}else{
							echo '<td>&nbsp;'.$tdConteudo.'</td>';
						}

					}

					echo '<td class="tabela-default-acoes"><a href="'.$editPage.$concatEdit.'id='.$arrayData[0].'">editar</a> | <a href="javascript:validaDelete(\''.$delPage.$concatDel.'id='.$arrayData[0].'\')">excluir</a></td>';
					echo '</tr>';
					$tdId ++;

				}

				echo '</table>';
				//echo '</center>';
			} else {
				echo 'Nenhum registro encontrado...';
			}
			mysqli_free_result($queryResult);

		}

		public function tableOptionMLink($queryResult, $headerTitle, $numRange, $arrayOfLabels, $editPage, $delPage, $LinkArray, $idLink){
			//Funciona como a fun��o tableOptions, mas associa links diferentes para colunas diferentes
			//da tabela.

			$numFields = mysqli_num_fields($queryResult);
			$numColums = $numFields-($numRange);
			$numRows = mysqli_num_rows($queryResult);
			$colSpan = $numFields-($numRange) + 1;

			if($numRows != 0){
				echo '<p class="numRegistros">'.$numRows.' registro(s) encontrado(s).</p>';
				//echo '<center>';
				echo '<table border="0" class="tabela-default" cellpadding="0" cellspacing="0">';
				echo '<tr><th colspan="'.$colSpan.'">'.$headerTitle.'</th></tr>';

				echo '<tr>';
				for($i=0; $i<count($arrayOfLabels); $i++){
					echo '<td class="columnLabel">'.$arrayOfLabels[$i].'</td>';
				}
				//Options
				echo '<td class="columnLabel">A��es</td>';
				echo '</tr>';
				$tdId = 0;
				echo '<script language="javascript">';
				echo 'function validaDelete(pagina){';
				echo 'var opcaoUsuario = confirm("Esta a��o ir� apagar todos os dados deste conte�do.\nClique em OK para apagar e em Cancelar para retornar � pagina de edi��o.");';
				echo 'if(opcaoUsuario){window.location=pagina;}';
				echo 'else{history.back;}}';
				echo '</script>';

				//verifica se j� existem par�metros na URL
				require('control/CheckConcat.Class.php');
				$check = new checkConcat();
				$concat = $check->checkUrlGets();

				$concatEdit = $check->switchConcat($editPage);
				$concatDel = $check->switchConcat($delPage);

				while($arrayData = mysqli_fetch_array($queryResult)){

					echo '<tr id="tr-'.$tdId.'">';
					for($j=0; $j<$numColums; $j++){
						if(!empty($arrayData[$j + $numRange])){
							$tdConteudo = $arrayData[$j + $numRange];
						}else{
							$tdConteudo = "-";
						}

						if(!empty($LinkArray[$j]))
						{
							echo '<td><a href="'.$LinkArray[$j].$concat.'id='.$arrayData[$idLink[$j]].'">'.substr($tdConteudo, 0, 80).'</a></td>';
							//echo '<td><a href="'.$LinkArray[$j >= $numRange ? $j-$numRange : 0].$concat.'id='.$arrayData[$idLink[$j >= $numRange ? $j-$numRange : 0]].'">'.substr($tdConteudo, 0, 80).'</a></td>';
						}else{
							echo '<td>&nbsp;'.$tdConteudo.'</td>';
						}
					}

					echo '<td><a href="'.$editPage.$concatEdit.'id='.$arrayData[0].'">editar</a> | <a href="javascript:validaDelete(\''.$delPage.$concatDel.'id='.$arrayData[0].'\')">excluir</a></td>';
					echo '</tr>';
					$tdId ++;

				}

				echo '</table>';
				//echo '</center>';
			} else {
				echo 'Nenhum registro encontrado...';
			}
			mysqli_free_result($queryResult);

		}

		public function inListFormat($resultSet, $resumoLink, $linkLabel, $tituloLabel, $resumoLabel){

			$this->resultSet = $resultSet;
			$this->resumoLink = $resumoLink;
			$this->linkLabel = $linkLabel;
			$this->tituloLabel = $tituloLabel;
			$this->resumoLabel = $resumoLabel;

			echo '<ul>';
			while($data = mysqli_fetch_array($this->resultSet)){
				echo '<li><a href="'.$this->resumoLink.$data[$this->linkLabel].'">'.$data[$this->tituloLabel].'</a></li>';
			}
			echo '</ul>';
			mysqli_free_result($this->resultSet);
		}

		public function table($queryResult, $headerTitle, $myLink, $numRange, $arrayOfLabels){
			$numFields = mysqli_num_fields($queryResult);
			$numColums = $numFields-($numRange);
			$numRows = mysqli_num_rows($queryResult);
			$colSpan = $numFields-($numRange) + 1;

			if($numRows != 0){
				//echo '<p class="numRegistros">'.$numRows.' registro(s) encontrado(s).</p>';
				//echo '<center>';
				echo '<table border="0" class="tabela-default" cellpadding="0" cellspacing="0">';
				echo '<tr><th colspan="'.$colSpan.'">'.$headerTitle.'</th></tr>';

				echo '<tr>';
				for($i=0; $i<count($arrayOfLabels); $i++){
					echo '<td class="columnLabel">'.$arrayOfLabels[$i].'</td>';
				}

				$tdId = 0;

				//verifica se j� existem par�metros na URL
				require('control/CheckConcat.Class.php');
				$check = new checkConcat();
				$concat = $check->checkUrlGets();

        		$i=0;

				while($arrayData = mysqli_fetch_array($queryResult)){

          			$i%2==0?$bgColor='#eee':$bgColor='#fff';

					echo '<tr id="tr-'.$tdId.'">';

					for($j=0; $j<$numColums; $j++){

						if(!empty($arrayData[$j + $numRange])){
							$tdConteudo = $arrayData[$j + $numRange];
						}else{
							$tdConteudo = "-";
						}

						if(!empty($myLink)){
							echo '<td style="background: '.$bgColor.'"><a href="'.$myLink.$concat.'id='.$arrayData[0].'">'.substr($tdConteudo, 0, 80).'</a></td>';
						}else{
							echo '<td style="background-color: '.$bgColor.'">&nbsp;'.$tdConteudo.'</td>';
						}

					}

          			$i++;

					echo '</tr>';
					$tdId ++;

				}

				echo '</table>';
				//echo '</center>';
			} else {
				echo 'Nenhum registro encontrado...';
			}
			mysqli_free_result($queryResult);

		}

		public function tableClientePlan($queryResult, $headerTitle, $myLink, $numRange, $arrayOfLabels){
			$numFields = mysqli_num_fields($queryResult);
			$numColums = $numFields-($numRange);
			$numRows = mysqli_num_rows($queryResult);
			$colSpan = $numFields-($numRange) + 1;

			if($numRows != 0){
				echo '<p class="numRegistros">'.$numRows.' registro(s) encontrado(s).</p>';
				//echo '<center>';
				echo '<table border="0" class="tabela-default" cellpadding="0" cellspacing="0">';
				echo '<tr><th colspan="'.$colSpan.'">z'.$headerTitle.'</th></tr>';

				echo '<tr>';
				for($i=0; $i<count($arrayOfLabels); $i++){
					echo '<td class="columnLabel">'.$arrayOfLabels[$i].'</td>';
				}

				$tdId = 0;

				//verifica se j� existem par�metros na URL
				require('control/CheckConcat.Class.php');
				$check = new checkConcat();
				$concat = $check->checkUrlGets();

				while($arrayData = mysqli_fetch_array($queryResult)){

					echo '<tr id="tr-'.$tdId.'">';
					for($j=0; $j<$numColums; $j++){
						if(!empty($arrayData[$j + $numRange])){
							$tdConteudo = $arrayData[$j + $numRange];
						}else{
							$tdConteudo = "-";
						}

						if(!empty($myLink)){
							echo '<td><a href="'.$myLink.$concat.'id='.$arrayData[0].'&nome='.$arrayData[2].'">'.substr($tdConteudo, 0, 80).'</a></td>';
						}else{
							echo '<td>&nbsp;'.$tdConteudo.'</td>';
						}
					}

					echo '</tr>';
					$tdId ++;

				}

				echo '</table>';
				//echo '</center>';
			} else {
				echo 'Nenhum registro encontrado...';
			}
			mysqli_free_result($queryResult);

		}

		public function tableDomin($queryResult, $headerTitle, $myLink, $numRange, $arrayOfLabels){
			$numFields = mysqli_num_fields($queryResult);
			$numColums = $numFields-($numRange);
			$numRows = mysqli_num_rows($queryResult);
			$colSpan = $numFields-($numRange) + 1;

			if($numRows != 0){
				echo '<p class="numRegistros"><small>'.$numRows.' registro(s) encontrado(s).</small></p>';
				//echo '<center>';
				echo '<table border="0" class="tabela-default" cellpadding="0" cellspacing="0">';
				echo '<tr><th colspan="'.$colSpan.'">'.$headerTitle.'</th></tr>';

				echo '<tr>';
				for($i=0; $i<count($arrayOfLabels); $i++){
					echo '<td class="columnLabel">'.$arrayOfLabels[$i].'</td>';
				}

				$tdId = 0;

				//verifica se j� existem par�metros na URL
				require('control/CheckConcat.Class.php');
				$check = new checkConcat();
				$concat = $check->checkUrlGets();

				while($arrayData = mysqli_fetch_array($queryResult)){

					echo '<tr id="tr-'.$tdId.'">';
					for($j=0; $j<$numColums; $j++){
						if(!empty($arrayData[$j + $numRange])){
							$tdConteudo = $arrayData[$j + $numRange];
						}else{
							$tdConteudo = "-";
						}

						if(!empty($myLink)){
							if ($j == 0)
								echo '<td><a href="'.$myLink.$concat.'id='.$arrayData[0].'">'.substr($tdConteudo, 0, 80).'</a></td>';
							else
								echo '<td>'.substr($tdConteudo, 0, 80).'</td>';
						}else{
							echo '<td>&nbsp;'.$tdConteudo.'</td>';
						}
					}

					echo '</tr>';
					$tdId ++;

				}

				echo '</table>';
				//echo '</center>';
			} else {
				echo 'Nenhum registro encontrado...';
			}
			mysqli_free_result($queryResult);

		}

		public function ListaMens($resultSet, $tituloLabel){
			$handleDate = new HandleDates();

			$this->resultSet = $resultSet;
			$this->tituloLabel = $tituloLabel;

			echo '<ul>';
			while($data = mysqli_fetch_array($this->resultSet)){
				$arrayVenc = $handleDate->splitDateTime($data[$this->tituloLabel], 'N');
				$strVenc = $arrayVenc[2].'/'.$arrayVenc[1].'/'.$arrayVenc[0];

				echo "<li>$strVenc</li>";
			}
			echo '</ul>';
			mysqli_free_result($this->resultSet);
		}


		public function montaCombo($resultSet, $selectedItem, $name, $id, $css, $event, $valueFromDb, $labelFromDb, $readOnly="N"){
			if(mysqli_num_rows($resultSet)!=0){

			if ($readOnly != 'N')
				$ro = 'disabled';
			else
				$ro = '';

			$output = '
			<select name="'.$name.'" class="'.$css.'" id="'.$id.'" '.$event.' '.$ro.'>
				<option value="">Selecione um item</option>';

			while ($dados = mysqli_fetch_array($resultSet)){

				$selected = "";

				if (!empty($selectedItem) && $selectedItem == $dados[$valueFromDb]) {
					$selected = 'selected = "selected"';
				}
				$label = $this->switchSpecialChars($dados[$labelFromDb]);
				$output .=  '<option value="'.$dados[$valueFromDb].'" '.$selected.'>'.$label.'</option>';
			}

			$output .=  '</select>';

			}else{
				$output =  '<small>Nenhum registro encontrado!</small>';
			}

			return $output;

		}

		public function montaComboLetras($eventLink, $selected='', $evento='onchange="filtrar();"'){
			$letras = array (
				'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
			);

			$i = 0;
			$navCombo = '
			<script>
			function filtrar(){
				var valor = document.getElementById("letra");
				if (valor.value != ""){
					window.location = "'.$eventLink.'&letra="+valor.value;
				}
			}
			</script>
			';
			$navCombo .= '<select name="letra" id="letra" '.$evento.' ><option value="">-</option>';
			while ($i < 26){
				$selected = '';
				if (isset($_GET['letra']) && !empty($_GET['letra']) && ($_GET['letra'] == $letras[$i])){
					$selected = 'selected = "selected"';
				}
				$navCombo .= '<option value="'.$letras[$i].'" '.$selected.'>'.$letras[$i].'</option>';
				$i++;
			}
			$navCombo .= '</select>';

			return $navCombo;
		}

		public function imgArrayTable($array, $path = '', $imgParam='', $tableParam='', $cols=5){
			if (is_array($array)){
				$output = '<table '.$tableParam.'"><tr>';

				$i = 0;
				$x = 0;
				while ($i < count($array)){
					if ($x == $cols){
						$output .= '</tr><tr>';
						$x = 0;
					}

					$imagemFull = $path.'original/';
					$imagemTmb = $path.'tmb/';
					$output .='
					<td>
						<a href="'.$imagemFull.$array[$i].'" rel="lightbox[roadtrip]">
							<img src="'.$imagemTmb.$array[$i].'" '.$imgParam.' border="0" />
						</a>
					</td>
					';

					$i++;
					$x++;
				}

				$output .= '</table>';

			}else{
				$output = 'Erro: N�o � array em DisplayData::arrayInTable';
			}
			return $output;
		}
}
?>
