<?
	class DisplayDates extends View{

		public function __construct(){

		}

		public function showCombo($name, $data=""){
			if(!empty($data)){
				$data = explode("/", $data);
				$dia = $data[0];
				$mes = $data[1];
				$ano = $data[2];
			}

			echo '<select name="dia'.$name.'" id="dia'.$name.'" class="form-texto">';

				$i=1;
				while ($i <= 31){
					if(!empty($dia) && $dia==$i){
						echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
					}else{
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					$i++;
				}

			echo '</select>/';
			echo '<select name="mes'.$name.'" id="mes'.$name.'" class="form-texto">';

				$i=1;
				while ($i <= 12){
					if(!empty($mes) && $mes==$i){
						echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
					}else{
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					$i++;
				}

			echo '</select>/';
			echo '<select name="ano'.$name.'" id="ano'.$name.'" class="form-texto">';

				$i=1990;

				while ($i <= date('Y')){

					if(!empty($ano) && $ano==$i){
						echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
					}else{
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					$i++;
				}

			echo '</select>';
		}

		function mesCombo($mesSel='', $nome='mes', $num='N'){
			$meses = array(
				''=>'todos',
				1=>'janeiro',
				2=>'fevereiro',
				3=>'mar&ccedil;o',
				4=>'abril',
				5=>'maio',
				6=>'junho',
				7=>'julho',
				8=>'agosto',
				9=>'setembro',
				10=>'outubro',
				11=>'novembro',
				12=>'dezembro'
				);

			$output = '
			<select name="'.$nome.'" id="'.$nome.'" class="form-texto" selected="selected">';

			for ($i=0; $i<13; $i++){
				$num=='N'?$mes=current($meses):$mes=key($meses);
				$mesSel==key($meses)?$sel='selected="selected"':$sel='';

				$output .= '
				<option value="'.key($meses).'" '.$sel.'>'.$mes.'</option>';
				next($meses);
			}
			$output .= '
			</select>';

			return $output;
		}

		function anoCombo($ano, $anoInicial=1900, $anoFinal='', $name="ano"){
			$output = '<select name="'.$name.'" id="'.$name.'" class="form-texto">';
			$i=$anoInicial;

			if (empty($anoFinal))
				$anoFinal = date('Y');

			$output .= '
			<option value="">todos</ano>';

			while ($i <= $anoFinal){
				if(!empty($ano) && $ano==$i){
					$output .= '
					<option selected="selected" value="'.$i.'">'.$i.'</option>';
				}else{
					$output .= '
					<option value="'.$i.'">'.$i.'</option>';
				}
				$i++;
			}
			$output .= '
			</select>';
			return $output;
		}
	}
?>
