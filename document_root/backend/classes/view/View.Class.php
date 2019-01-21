<?

	Class View{

		function getAlignmentStyle(string $alg){
			if($alg=='center'){
				$class = 'class="text-center"';
			}else{
				$class = '';
			}
		}

		function simpleCombo(array $arrayObjs){
			$output = '<select id="combo-template-servicos" class="form-control"><option value="">Selecione um serviço</option>';
			$countObjs = count($arrayObjs);
			for($i=0; $i<$countObjs; $i++){
				$id = $arrayObjs[$i]->servico_id;
				$servicoTitulo = $arrayObjs[$i]->servico_titulo;
				$output .= '<option id="'.$id.'" value="'.$id.'">'.$servicoTitulo.'</option>';
		    }

		    $output .= '</select>';
			return $output;
		}

		function listItensTable(array $options, string $rows, $navigation=false){
			$nav = '';
			if($navigation){
				$nav = $navigation;
			}

			$header = $nav.'<br><table class="table table-striped table-vcenter"><thead><tr>';
			$countOptions = count($options);
			for($i=0; $i<$countOptions; $i++){
				$title = $options[$i][0];
				$size = $options[$i][1];
				$class = $this->getAlignmentStyle($options[$i][2]);
				$header .= '<th '.$class.' style=" width: '.$size.';">'.$title.'</th>';
			}

			$header .= '</tr></thead>';

			$table = $header.'
		        <tbody>
		            '.$rows.'
		        </tbody>
		    </table>

			';

			return $table;
		}

		function searchBox(){

			echo '
			<form action="index.php?pag=&k=" method="get">
				<div class="box-busca">
					<div class="row">
				        <div class="col-md-2">
				            <input type="hidden" name="pag" value="'.$_GET["pag"].'">
				            <input type="text" class="form-control" name="k" placeholder="Buscar" />
				        </div>
						<div class="col-md-1">
							<button class="btn btn-default" id="" type="submit">BUSCAR</button>
				        </div>
					</div>
			    </div>
			</form>
			';
		}

		function getMonths() : array {
			$months = array();
			for($i=1; $i<13; $i++){

				if (!defined('CHARSET')) define('CHARSET', 'utf-8');
				$m = utf8_encode( strftime('%B', strtotime('2018-'.$i.'-01')) );
				$month = array( $m, $i);
				array_push($months, $month);
			}
			return $months;
		}

		function filterByPeriod(string $url){

			if(isset($_GET['period']) && !empty($_GET['period'])){
				$activeYear = explode('-', $_GET['period'])[0];
				$activeMonth = explode('-', $_GET['period'])[1];
			}else{
				$activeMonth = '';
				$activeYear = '';
			}
			//MONTHS
			$months = $this->getMonths();
			$comboMonths = '';
			$countMonths = count($months);
			for($i=0; $i<$countMonths; $i++){
				if($activeMonth == $months[$i][1]){
					$selected = 'selected="selected"';
				}else{
					$selected = '';
				}
				$comboMonths .= '<option '.$selected.' value="'.$months[$i][1].'">'.$months[$i][0].'</option>';
			}

			//YEARS
			$thisYear = date("Y");

			$comboYears = '';
			for($i=3; $i>0; $i--){
				$year = $thisYear--;
				if($activeYear == $year){
					$selected = 'selected="selected"';
				}else{
					$selected = '';
				}
				$comboYears .= '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
			}

			echo '
			<div class="row">
				<div class="col-md-10">
					<p style="margin: 20px 0px 10px 0px;">Filtrar por período:</p>
				</div>
			</div>
			<input type="hidden" id="urlToGo" value="'.$url.'" />
			<div class="row">
				<div class="col-md-2">
					<select class="form-control" id="periodo-mes" style="">
						<option value="">Selecione o mês</option>
						'.$comboMonths.'
					</select>
				</div>
				<div class="col-md-2">
					<select class="form-control" id="periodo-ano" style="">
						<option value="">Selecione o ano</option>
						'.$comboYears.'
					</select>
				</div>
				<div class="col-md-2">
					<button class="btn btn-default" id="btnSetFilter">FILTRAR</button>
				</div>
			</div>';
		}

		function filterByYear(string $url){

			if(isset($_GET['period']) && !empty($_GET['period'])){
				$activeYear = explode('-', $_GET['period'])[0];
			}else{
				$activeYear = '';
			}

			$thisYear = date("Y")-1;

			$comboYears = '';
			for($i=3; $i>0; $i--){
				$year = $thisYear--;
				if($activeYear == $year){
					$selected = 'selected="selected"';
				}else{
					$selected = '';
				}
				$comboYears .= '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
			}

			echo '
			<div class="row">
				<div class="col-md-10">
					<p style="margin: 20px 0px 10px 0px;">Filtrar por ano:</p>
				</div>
			</div>
			<input type="hidden" id="urlToGo" value="'.$url.'" />
			<div class="row">
			
				<div class="col-md-2">
					<select class="form-control" id="periodo-ano" style="">
						<option value="">Selecione o ano</option>
						'.$comboYears.'
					</select>
				</div>
				<div class="col-md-2">
					<button class="btn btn-default" id="btnSetFilter">FILTRAR</button>
				</div>
			</div>';
		}

		function compareByYear(string $url){

			if(isset($_GET['period']) && !empty($_GET['period'])){
				$activeYear = explode('-', $_GET['period'])[0];
			}else{
				$activeYear = '';
			}

			$thisYear = date("Y")-1;

			$comboYears = '';
			for($i=3; $i>0; $i--){
				$year = $thisYear--;
				if($activeYear == $year){
					$selected = 'selected="selected"';
				}else{
					$selected = '';
				}
				$comboYears .= '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
			}

			echo '
			<div class="row">
				<div class="col-md-10">
					<p style="margin: 20px 0px 10px 0px;">Filtrar por ano:</p>
				</div>
			</div>
			<input type="hidden" id="urlToGo" value="'.$url.'" />
			<div class="row">
			
				<div class="col-md-2">
					<select class="form-control" id="periodo-ano" style="">
						<option value="">Selecione o ano</option>
						'.$comboYears.'
					</select>
				</div>
				<div class="col-md-2">
					<select class="form-control" id="periodo-a-comparar" style="">
						<option value="">Comparar com</option>
						'.$comboYears.'
					</select>
				</div>
				<div class="col-md-2">
					<button class="btn btn-default" id="btnSetFilter">FILTRAR</button>
				</div>
			</div>';
		}

		public function defaultError(){
			echo '
				<div>
					<h1>Oooops! That\'s an embarassing error :(</h1>
					<p>Please contact the System Administrator.</p>
				</div>';
		}
	}

?>
