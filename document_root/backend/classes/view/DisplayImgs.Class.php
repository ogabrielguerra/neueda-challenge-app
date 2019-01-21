<?
	
	class DisplayImgs extends View{
		
		//public $fotosPorPagina
		
		function showRowOfThumbs($fotosPorPagina, $thumbsPorLinha, $pagAtual, $path, $url, $idCategoria){
			
			require('control/HandleFiles.Class.php');
			$checkFiles = new HandleFiles();
			$listaThumbs = $checkFiles->checkForFiles($path);

			if($listaThumbs){
				$primeiraFoto = ((($pagAtual * $fotosPorPagina)-$fotosPorPagina));//+1;
				$ultimaFoto = ($pagAtual * $fotosPorPagina)-1;
				$totalFotos = count($listaThumbs);
				$quebrador = 0;
				
				if($totalFotos==1){ $primeiraFoto=0; }
				
				echo '<div id="boxThumbs">';
				for($i=$primeiraFoto; $i<=$ultimaFoto; $i++){
					
					if($i<$totalFotos){
						
						$quebrador ++;
					
						$imgFull = $url.$listaThumbs[$i];
						$imgFull = strrchr($imgFull,"/");
						$imgFull = str_replace("/tmb_", "", $imgFull);
						
						$categoria = explode("/", $url);
						
						for($j=0; $j<count($categoria); $j++){
							if($categoria[$j]=="tmb"){
								$index = $j-1;								
							}
						}
						
						$categoria = $categoria[$index];
						
						//echo $categoria."<br>";
					
						if($quebrador % $thumbsPorLinha != 0){
							echo '<div>';
							echo '<a href="javascript:abre_pop(\'/clix/modeloPopup.php?cat='.$categoria.'&img='.$imgFull.'\',\'popup\',\'620\',\'520\');">';
							echo '<img src="'.$url.$listaThumbs[$i].'" border="0" width="80" height="60" style="margin: 3px;" alt"avatar" /></a>';
							echo '</div>';
						} else {
							
							echo '<div><a href="javascript:abre_pop(\'/clix/modeloPopup.php?cat='.$categoria.'&img='.$imgFull.'\',\'popup\',\'620\',\'520\');">';
							echo '<img src="'.$url.$listaThumbs[$i].'" border="0" width="80" height="60" style="margin: 3px;" alt"avatar" />';
							echo '</a></div>';
							echo '<p class="clear"></p>';
						}
					}
				}
				echo '</div><p class="clear"></p>';
			
			}else{
				echo 'Esta categoria n�o possui imagem no momento.';
			}
		}
		
		function showRowOfThumbsEdit($fotosPorPagina, $thumbsPorLinha, $pagAtual, $path, $url, $idCategoria){
			
			require('control/HandleFiles.Class.php');
			//echo $path;
			$checkFiles = new HandleFiles();
			$listaThumbs = $checkFiles->checkForFiles($path);
			
			if($listaThumbs){
				$primeiraFoto = (($pagAtual * $fotosPorPagina)-$fotosPorPagina);
				$ultimaFoto = $pagAtual * $fotosPorPagina;
				$totalFotos = count($listaThumbs);
				$quebrador = 0;
				
				if($totalFotos==1){ $primeiraFoto=0; }
				
				echo '<div id="boxThumbs">';
				for($i=$primeiraFoto; $i<=$ultimaFoto; $i++){
					
					if($i<$totalFotos){
						$quebrador ++;
					
					$imgFull = $url.$listaThumbs[$i];
					$imgFull = strrchr($imgFull,"/");
					$imgFull = str_replace("/tmb_", "", $imgFull);
					
					$categoria = explode("/", $url);
					$categoria = $categoria[3];
					
					//echo $categoria."<br>";
					
						if($quebrador % $thumbsPorLinha != 0){
							echo '<div><a href="javascript:abre_pop(\'modeloPopup.php?cat='.$categoria.'&img='.$imgFull.'\',\'popup\',\'620\',\'520\');">';
							echo '<img src="'.$url.$listaThumbs[$i].'" border="0" width="80" height="60" style="margin: 3px;" alt"avatar" />';
							echo '</a><a href="deleteImg.php?idCategoria='.$idCategoria.'&idImg='.$i.'" class="excluirImg">excluir</a></div>';
						} else {
							
							echo '<div><a href="javascript:abre_pop(\'modeloPopup.php?cat='.$categoria.'&img='.$imgFull.'\',\'popup\',\'620\',\'520\');">';
							echo '<img src="'.$url.$listaThumbs[$i].'" border="0" width="80" height="60" style="margin: 3px;" alt"avatar" />';
							echo '</a><a href="deleteImg.php?idCategoria='.$idCategoria.'&idImg='.$i.'" class="excluirImg">excluir</a></div>';
							echo '<p class="clear"></p>';
						}
					}
				}
				echo '</div><div class="clear"></div>';
			
			}else{
				echo 'Esta categoria n�o possui imagem no momento.';
			}
		}
		
		function montaMenuNavegacao($totalRegistros, $fotosPorPagina, $url, $paginaAtual){
			
			$totalPaginas = ceil($totalRegistros/$fotosPorPagina);
			if($totalPaginas > 1){
	
				$proximaPagina = ($paginaAtual) + 1;
				$paginaAnterior = ($paginaAtual) - 1;
	
				echo '<div id="buscaNavegacao">';
	
				if($paginaAnterior > 0)
					echo '<a href="'.$url.'&paginaAtual='.$paginaAnterior.'">�</a> ';
	
				for($i = 0; $i < $totalPaginas; $i++){
					if(($i+1) != $paginaAtual)
						echo '<a href="'.$url.'&paginaAtual='.($i+1).'">'.($i+1).'</a>  | ';
					else
						echo '<span>'.($i+1) . "</span> | ";
				}
	
				if($proximaPagina <= $totalPaginas)
					echo '<a href="'.$url.'&paginaAtual='.$proximaPagina.'"> �</a> ';
	
				echo '</div>';
			}
		}
		
	}
?>				

