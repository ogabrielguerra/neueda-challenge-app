<?
class HandleImgs extends HandleFiles{

	public $dirDestino;
	public $imagemOriginal;
	public $thumb;
	
	function createNewImg($img, $newSize="", $dirDestino) {
		
		//Antes de qualquer coisa, copia a img para o dir de trabalho
		$this->copyImg($img, $dirDestino);
		//
		
		$myExt = strrchr($img, ".");
		
		if($myExt == ".jpg"){
			$img_origem = ImageCreateFromJPEG($this->thumb);
		}else{
			$img_origem = ImageCreateFromGif($this->thumb);
		}
		
		echo "<br>".$this->thumb."<br>";
		
		$origem_x = ImagesX($img_origem);
		$origem_y = ImagesY($img_origem);
			
		//Checa se é tamanho fixo ou proporção

		if(!empty($newSize)){
			echo "<br>COM redimensionamento<br>";
			$search = strpos($newSize, "x");

			//é fixo
			if($search!==false){
				echo "Fixo";
				$xArray = explode("x", $newSize);
				$x = $xArray[0];
				$y = $xArray[1];
	
			//é proporcional
			}else{
				echo "Prop";
				$xArray = explode("%", $newSize);
	
				if($origem_x>$xArray[0] || $origem_y>$xArray[1]){
	
					if($origem_x > $origem_y){
						echo "x é maior...<br>";
						$xOrY = $origem_x;
						$finalSize = $xArray[0];
					}else{
						echo "y é maior...<br>";
						$xOrY = $origem_y;
						$finalSize = $xArray[1];
					}
	
				//** x = TamImagem / TamFinal						
				$percentual = ($finalSize*100) / $xOrY;
				$x = $origem_x * $percentual /100;
				$y = $origem_y * $percentual /100; 

				}
			}
	

		}else{
			echo "<br>SEM redimensionamento<br>";
			$x = $origem_x;
			$y = $origem_y;
		}

		// cria a imagem final, que ir� conter a miniatura
		$imagemPronta = ImageCreateTrueColor($x,$y);

		// copia a imagem original redimensionada para dentro da imagem final
		ImageCopyResampled($imagemPronta, $img_origem, 0, 0, 0, 0, $x+1, $y+1, $origem_x , $origem_y);
		
		// salva o arquivo
		if($myExt == ".jpg"){
			ImageJPEG($imagemPronta, $this->thumb, 100);
		}else{
			ImageGif($imagemPronta, $this->thumb, 100);
		}
echo $imagemPronta;
		ImageDestroy($img_origem);
		ImageDestroy($imagemPronta);

		//echo "<br><br>$img<br><br>";
		//echo "<br><br>-----> $indice<br><br>";
		echo "<br>Img Original: ". $this->imagemOriginal."<br>";
		echo "THUMB: ".$this->thumb."<br><br>";
		echo $origem_x."<br>";	echo $x."<br>";	echo $y."<br>";
		
	}
	
	function resizeImg($img, $newSize="", $makeThumb="yes") {
		
		//retorna a extens�o do arquivo
		$myExt = strrchr($img, ".");
		
		if(file_exists($img)){ // Verifica se existe alguma imagem
			
			if($makeThumb=="yes"){
				$arrayImg = explode("/", $img);
				$indice = count($arrayImg) - 1;
				$this->arquivo_miniatura = str_replace($arrayImg[$indice], "tmb_".$arrayImg[$indice], $img);
			}else{
				$this->arquivo_miniatura = $img;
			}
			
			if($myExt == ".jpg"){
				$img_origem = ImageCreateFromJPEG($img);
			}else{
				$img_origem = ImageCreateFromGif($img);
			}
			
			$origem_x = ImagesX($img_origem);
			$origem_y = ImagesY($img_origem);
			
			if(!empty($newSize)){
				$xArray = explode("x", $newSize);
				$x = $xArray[0];
				$y = $xArray[1];
			}else{
				$x = $origem_x / 2;
				$y = $origem_y / 2;
			}

			// cria a imagem final, que ir� conter a miniatura
			$img_final = ImageCreateTrueColor($x,$y);
			
			// copia a imagem original redimensionada para dentro da imagem final
			ImageCopyResampled($img_final, $img_origem, 0, 0, 0, 0, $x+1, $y+1, $origem_x , $origem_y);
			
			// salva o arquivo
			if($myExt == ".jpg"){
				ImageJPEG($img_final, $this->arquivo_miniatura, 100);
			}else{
				ImageGif($img_final, $this->arquivo_miniatura, 100);
			}
			
			ImageDestroy($img_origem);
			ImageDestroy($img_final);
		} 
		
		//Decide se cria os thumbs ou n�o
		if($makeThumb=="yes"){
			$this->thumb = str_replace($arrayImg[$indice], "tmb/tmb_".$arrayImg[$indice], $img);
			$this->thumbDir = str_replace($arrayImg[$indice], "tmb/", $img);
			$this->makeThumb();
		}
			
	}
	
	function copyImg($img, $dirDestino){
		
		//retorna a extens�o do arquivo
		$myExt = strrchr($img, ".");
 		$arrayImg = explode("/", $img);
		$indice = count($arrayImg) - 1;
		
		$this->imagemOriginal = str_replace($arrayImg[$indice], $arrayImg[$indice], $img);
		$this->thumb = str_replace($arrayImg[$indice], $dirDestino.$arrayImg[$indice], $img);


		$this->dirDestino = str_replace($arrayImg[$indice], $dirDestino, $img);

		if(!file_exists($this->dirDestino)){
			mkdir($this->dirDestino, 0777);
		}
		copy($this->imagemOriginal, $this->thumb);
	}
	
	function resizeWithProportion(){
		if($origem_x > $origem_y){
			$xOrY = $origem_x;
		}else{
			$xOrY = $origem_y;
		}
		//** x = TamImagem / TamFinal
		$finalSize = 64;
		$percentual = ($finalSize*100) / $xOrY;
	}
	

}	
?>