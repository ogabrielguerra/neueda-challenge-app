<?php
	Class PagingData extends Control{
		public $totalRegistros;
		public $itensPorPagina;
		private $proximaPagina;
		private $paginaAnterior;
		private $numeroMinimo;
		private $numeroMaximo;
		public $url;
		public $actPage;

		public function setQueryLimit($totalRegistros, $itensPorPagina, $filter){
			if( isset($_GET['pa']) && !empty($_GET['pa']) ){
				$this->actPage = $_GET['pa'];
			}else{
				$this->actPage = 1;
			}
			$this->totalRegistros = $totalRegistros;
			$this->numeroMinimo = $itensPorPagina * ($this->actPage-1);
			$this->numeroMaximo = ($itensPorPagina) * $this->actPage;
			$this->totalPaginas = ceil($this->totalRegistros/$itensPorPagina);
			$filter = $filter." LIMIT ".$this->numeroMinimo.",".$itensPorPagina;
			return $filter;
		}

		function navigation($url){

			if($this->totalPaginas > 1){
				$this->proximaPagina = ($this->actPage) + 1;
				$this->paginaAnterior = ($this->actPage) - 1;

				//Checks if url has more than 2 parameters
				$fullUrl = $_SERVER['REQUEST_URI'];
				$numParams = explode('&', $fullUrl);

				$extraParams='';
				$iniChar='';
				$first = false;
				$countNumParams = count($numParams);
				if($countNumParams>1){
					for($i=1; $i<$countNumParams; $i++){
						$search = strpos($numParams[$i], 'pa');
						if($search===false){
							if(!$first){
								$iniChar='&';
								$first=true;
							}
							$extraParams .= $iniChar.$numParams[$i];
						}
					}
				}

				$menu = '';
					$menu .= '<nav class="text-left"><ul class="pagination pagination-sm">';

				if($this->paginaAnterior > 0)
					$menu .= '<li><a href="'.$url.'&pa='.$this->paginaAnterior.$extraParams.'" class="esquerda"><<</a></li>';

					for($i = 0; $i < $this->totalPaginas; $i++){
						$num = $i+1;

						if( ($num) != $this->actPage ){
							$newUrl = $url.$extraParams.'&pa='.$num;

							if($num<30)
								$menu .= '<li><a href="'.$newUrl.'">'.$num.'</a></li>';
						}else{
							$menu .= '<li class="active"><a>'.$num."</a></li>";
						}
					}

				if($this->proximaPagina <= $this->totalPaginas)
					$menu .= '<li><a href="'.$url.'&pa='.$this->proximaPagina.$extraParams.'" class="direita"> >></a></li>';

				$menu .= '</ul></nav>';
				return $menu;
			}
		}
	}
?>
