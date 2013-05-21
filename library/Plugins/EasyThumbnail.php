<?php
/*
EasyThumbnail - versão 0.1 - Por Rogério Bragil  - Esta classe
cria um thumbnail de uma imagem através de um cálculo de aproximação. Você
pode criar miniaturas de imagens de diferentes tamanhos que o resultado será
uma coleção de thumbnails de dimensões parecidas. Ideal para albuns de fotos,
onde basta você fazer o upload da imagem e deixar a classe gerar o thumbnail.
OBS: trabalha com jpg e png somente. 

  e-mail: bragil@webdevel.com.br - Qualquer sugestão, dúvida ou crítica serão bem aceitos!
*/

class Plugins_EasyThumbnail
{
    private $debug= true;
    private $errflag= false;
    private $ext;
    private $origem;
    private $destino;
    private $errormsg;
    
    function __construct($imagem, $destino, $aprox)
    {
        // se o arquivo não existir, erro
        if (!file_exists($imagem))
        {
            $this->errormsg= "Arquivo não encontrado.";
            return false;
        }
        else
        {
            $this->origem= $imagem;
            $this->destino= $destino;
        }
        // obtém a extensão do arquivo
        if (!$this->ext= $this->getExtension($imagem))
        {
            $this->errormsg= "Tipo de arquivo inválido.";
            return false;
        }
        // gera a imagem do thumbnail com o caminho e nome do arquivo especificados
        $this->createThumbImg($aprox);
    }
    
    // retorna as dimensões (x,y) do thumbnail a ser gerado
    public function getThumbXY($x, $y, $aprox)
    {
    	
    	/*------------------*/
    	$old_x=$x;
	$old_y=$y;
	if ($old_x > $old_y) {
		$thumb_w=$aprox;
		$thumb_h=$old_y*($aprox/$old_x);
	}
	if ($old_x < $old_y) {
		$thumb_w=$old_x*($aprox/$old_y);
		$thumb_h=$aprox;
	}
	if ($old_x == $old_y) {
		$thumb_w=$aprox;
		$thumb_h=$aprox;
	}
	
	$vet= array("x" => $thumb_w, "y" => $thumb_h);
	return $vet;   	
    	
    	/*--------------------*/
    	/*
         if ($x >= $y)
        {
            if ($x > $aprox)
            {
                $x1= (int)($x * ($aprox/$x));
                $y1= (int)($y * ($aprox/$x));
            }
            else
            {
                $x1= $x;
                $y1= $y;
            }
        }
        else
        {
            if ($y > $aprox)
            {
                $x1= (int)($x * ($aprox/$y));
                $y1= (int)($y * ($aprox/$y));
            }
            // Caso a imagem seja menor do que
            // deve ser aproximado, mantém tamanho original para o thumb.
            else
            {
                $x1= $x;
                $y1= $y;
            }
        }
 //       $vet= array("x" => $x1, "y" => $y1);
 //       return $vet;
 */
    }
    
    // cria a imagem do thumbnail
    private function createThumbImg($aprox)
    {
        // imagem de origem
        $img_origem= $this->createImg();

        // obtém as dimensões da imagem original
        $origem_x= ImagesX($img_origem);
        $origem_y= ImagesY($img_origem);
        
        // obtém as dimensões do thumbnail
        $vetor= $this->getThumbXY($origem_x, $origem_y, $aprox);
        $x= $vetor['x'];
        $y= $vetor['y'];
        
        // cria a imagem do thumbnail
        $img_final = ImageCreateTrueColor($x, $y);
        ImageCopyResampled($img_final, $img_origem, 0, 0, 0, 0, $x+1, $y+1, $origem_x, $origem_y);
        // o arquivo é gravado
        if ($this->ext == "png")
            imagepng($img_final, $this->destino);
        elseif ($this->ext == "jpg")
            imagejpeg($img_final, $this->destino);
    }
    
    // cria uma imagem a partir do arquivo de origem
    private function createImg()
    {
        // imagem de origem
        if ($this->ext == "png")
            $img_origem= imagecreatefrompng($this->origem);
        elseif ($this->ext == "jpg" || $this->ext == "jpeg")
            $img_origem= imagecreatefromjpeg($this->origem);
        return $img_origem;
    }
    
    // obtém a extensão do arquivo
    private function getExtension($imagem)
    {
        // isso é para obter o mime-type da imagem.
        $mime= getimagesize($imagem);

        if ($mime[2] == 2)
        {
           $ext= "jpg";
           return $ext;
        }
        else
        if ($mime[2] == 3)
        {
           $ext= "png";
           return $ext;
        }
        else
           return false;
    }
    
    // mensagem de erro
    public function getErrorMsg()
    {
        return $this->errormsg;
    }
    
    public function isError()
    {
        return $this->errflag;
    }
}
?>
