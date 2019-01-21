<?
class HandleDates extends Control{

	function setDefaultPeriod($url){
		if(!isset($_GET["period"]) || empty($_GET["period"])){
			$periodo = date("Y").'-'.date("m");
			header("Location: $url&period=".$periodo);
		}
	}

	function stringToDateToString($myString){
		$date = explode("/", $myString);
		$newDate = $date[2]."/".$date[1]."/".$date[0];
		return $newDate;
	}

	function formatMySQLDate($myString, $hora="S"){
		$date = explode("-", $myString);
		$dia = explode(' ', $date[2]);

		if ($hora == 'S'){
			$hora = $dia[1];
            //Remove seconds from hour string
            $newHora = explode(":", $hora);
            $newHora = $newHora[0].":".$newHora[1]."h";
            $hora = $newHora;
		}else{
			$hora = '';
		}
		$newDate = array(($dia[0]."/".$date[1]."/".$date[0]), $hora);
		return $newDate;
	}

	function anosDecorridos($dataInput){
		$dataAtual = date("Y-m-d h:i:s");

		$arrayDataAtual = $this->splitDateTime($dataAtual);
		$arrayDataInput = $this->splitDateTime($dataInput);
		$dataAtualDias = ($arrayDataAtual[0]*365)+($arrayDataAtual[1]*30) + $arrayDataAtual[2];
		$dataInputDias = ($arrayDataInput[0]*365)+($arrayDataInput[1]*30) + $arrayDataInput[2];
		$difDias = $dataAtualDias - $dataInputDias;
		$anosDecorridos = floor($difDias/365);
		return $anosDecorridos;
	}

	function splitDateTime($dataInput, $horas = 'S'){
		$data = explode("-", $dataInput);
		$mes=$data[1];
		$ano=$data[0];
		if($horas == 'S'){
			$data = explode(" ", $data[2]);
			$dia=$data[0];
			$data = explode(":", $data[1]);
			$hora = $data[0];
			$minuto = $data[1];
			$segundo = $data[2];
			$dataCompleta = array($ano, $mes, $dia, $hora, $minuto, $segundo);
		}else{
			$dia = $data[2];
			$dataCompleta = array($ano, $mes, $dia);
		 }
		 return $dataCompleta;
	}

	function formatDateTime($dataInput){
		$format = $this->splitDateTime($dataInput);
		$dataFormatada = $format[2]."/". $format[1]."/".$format[0]." - ".$format[3].":".$format[4].":".$format[5];
		return $dataFormatada;
	}

	function calcDate($dia){
		$dataAtual = $this->splitDateTime(date('Y-m-d'));
		$diaAtual = $dataAtual[2]+($dataAtual[1]*30)+($dataAtual[0]*365);
		$dataFinal = $diaAtual - $dia;
		$anoFinal = (int)($dataFinal/365);
		$mesFinal = (int)(($dataFinal%365)/30);
		$diaFinal = (int)($dataFinal%365)%30;
		$arrayDataFinal = array('ano'=>$anoFinal, 'mes'=>$mesFinal, 'dia'=>$diaFinal);
		return $arrayDataFinal;
	}

	public function verificaDataMaior($dataInicial, $dataFinal, $hora = 'S'){
		$this->dataInicial = $dataInicial;
		$this->dataFinal = $dataFinal;
		$this->hora = $hora;

		$this->arrayDataInicial = $this->splitDateTime($this->dataInicial, $this->hora);
		$this->arrayDataFinal = $this->splitDateTime($this->dataFinal, $this->hora);

		if($this->hora == 'S'){
			$this->segundosDataInicial = ((((($this->arrayDataInicial[0] * 31104000) + $this->arrayDataInicial[1] * 2592000) + $this->arrayDataInicial[2] * 86400) + $this->arrayDataInicial[3] * 3600) + $this->arrayDataInicial[4] * 60) + $this->arrayDataInicial[5];
			$this->segundosDataFinal = ((((($this->arrayDataFinal[0] * 31104000) + $this->arrayDataFinal[1] * 2592000) + $this->arrayDataFinal[2] * 86400) + $this->arrayDataFinal[3] * 3600) + $this->arrayDataFinal[4] * 60) + $this->arrayDataFinal[5];
			if($this->segundosDataFinal < $this->segundosDataInicial){
				return false;
			}else{
				return true;
			}
		}else{
			$this->diasDataInicial = (($this->arrayDataInicial[0] * 365) + $this->arrayDataInicial[1] * 30) + $this->arrayDataInicial[2];
			$this->diasDataFinal = (($this->arrayDataFinal[0] * 365) + $this->arrayDataFinal[1] * 30) + $this->arrayDataFinal[2];
			if($this->diasDataFinal < $this->diasDataInicial){
				return false;
			}else{
				return true;
			}
		}

	}

	public function verificaIgualdadeDatas($dataInicial, $dataFinal, $hora = 'S'){
		$this->dataInicial = $dataInicial;
		$this->dataFinal = $dataFinal;
		$this->hora = $hora;

		$this->arrayDataInicial = $this->splitDateTime($this->dataInicial, $this->hora);
		$this->arrayDataFinal = $this->splitDateTime($this->dataFinal, $this->hora);

		if($this->hora == 'S'){
			$this->segundosDataInicial = ((((($this->arrayDataInicial[0] * 31104000) + $this->arrayDataInicial[1] * 2592000) + $this->arrayDataInicial[2] * 86400) + $this->arrayDataInicial[3] * 3600) + $this->arrayDataInicial[4] * 60) + $this->arrayDataInicial[5];
			$this->segundosDataFinal = ((((($this->arrayDataFinal[0] * 31104000) + $this->arrayDataFinal[1] * 2592000) + $this->arrayDataFinal[2] * 86400) + $this->arrayDataFinal[3] * 3600) + $this->arrayDataFinal[4] * 60) + $this->arrayDataFinal[5];
			if($this->segundosDataFinal == $this->segundosDataInicial){
				return true;
			}else{
				return false;
			}
		}else{
			$this->diasDataInicial = (($this->arrayDataInicial[0] * 365) + $this->arrayDataInicial[1] * 30) + $this->arrayDataInicial[2];
			$this->diasDataFinal = (($this->arrayDataFinal[0] * 365) + $this->arrayDataFinal[1] * 30) + $this->arrayDataFinal[2];
			if($this->diasDataFinal == $this->diasDataInicial){
				return true;
			}else{
				return false;
			}
		}
	}

	function buildTimeStamp($fonte){
			$data = explode("-", $fonte);
			$mes=$data[1];
			$ano=$data[0];
			$data = explode(" ", $data[2]);
			$dia=$data[0];
			$data = explode(":", $data[1]);
			$hora = $data[0];
			$minuto = $data[1];
			$segundo = $data[2];

			$stamp = mktime($hora, $minuto, $segundo, $mes, $dia, $ano);
			return $stamp;
	}

	function timeStampToYear($value){
		$qtdSegundosPorAnos = 31536000;
		$numAnos = floor($value / $qtdSegundosPorAnos);
		return $numAnos;
	}

	function getFirstDayOfThisWeek($weekend='S'){
		// Basicamente: Que dia caiu domingo passado?
		// *** Não contar fim de semana ainda não foi implementado

		$hoje = getdate();

		$dia = $hoje['mday'];
		$diaSemana = $hoje['wday'];
		$mes = $hoje['mon'];
		$mesAtual = $mes;
		$ano = $hoje['year'];

		// Mes do inicio da pesquisa
		$mesInicio = $mes;

		// Dia de inicio da pesquisa = hoje - dia da semana + o proprio dia da semana:
		$diaInicio = $dia - ($diaSemana + 1);

		// se $diaInicio < 1 a data de inicio é no mês anterior
		if ($diaInicio < 1){
			$mesInicio--;
			$diaInicio = strftime("%d", mktime(0, 0, 0, $mes, 0, $ano)) . $diaInicio;
		}

		// se $mesInicio < 1 a data de inicio é no ano anterior
		if ($mesInicio < 1){
			$ano--;
			$mesInicio = strftime("%m", mktime(0, 0, 0, $mes, 0, $ano)) . $diaInicio;
		}

		$mesInicio = str_pad($mesInicio, 2, '0', STR_PAD_LEFT);
		$dataInicio = $ano.'-'.str_pad($mesInicio, 2, '0', STR_PAD_LEFT).'-'.$diaInicio;

		return $dataInicio;
	}

	function getLastDayOfThisWeek($weekend='S'){
		// Basicamente: Que dia cairá o próximo Sábado?
		$hoje = getdate();

		$dia = $hoje['mday'];
		$diaSemana = $hoje['wday'];
		$mes = $hoje['mon'];
		$mesAtual = $mes;
		$ano = $hoje['year'];

		// Dia do fim da pesquisa = hoje + (sábado - dia da semana):
		$diaFim = $dia + (6 - $diaSemana);
		$mesFim = str_pad($mes, 2, '0', STR_PAD_LEFT);

		// Quantos dias tem esse mês:
		$diasMesAtual = strftime("%d", mktime(0, 0, 0, $mes+1, 0, $ano));

		// Se $diaFim > numero de dias no mes, a data de termino é no mes seguinte:
		if ($diaFim > $diasMesAtual){
			$mesFim++;
			$diaFim = $diaFim - $diasMesAtual;
		}

		$diaFim = str_pad($diaFim, 2, '0', STR_PAD_LEFT);
		$dataFim = $ano.'-'.str_pad($mesFim, 2, '0', STR_PAD_LEFT).'-'.$diaFim;

		return $dataFim;
	}
}
?>
