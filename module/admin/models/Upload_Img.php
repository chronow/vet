<?php
namespace app\module\admin\models;

use yii\base\Model;
use yii\web\UploadedFile;

class Upload_Img extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $img_800x600;
    public $img_373x280;
    public $img_150x150;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
        
        //С помощью свойства skipOnEmpty = false делаем загрузку файла обязательным.
    }
    
    public function upload($id=0)
    {
        if ($this->validate()) {
            
            if($id==0){
                $img = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            }else{
                if(!is_dir('files/projects'))mkdir('files/projects', 0777);
                if(!is_dir('files/projects/'.$id))mkdir('files/projects/'.$id, 0777);
                if(!is_dir('files/projects/'.$id.'/original/'))mkdir('files/projects/'.$id.'/original/', 0777);
                
                $img = 'files/projects/'.$id.'/original/'. $this->imageFile->baseName . '.' . $this->imageFile->extension;
            }
            
            $this->imageFile->saveAs($img);
            return '/'.$img;
        } else {
            return false;
        }
    }
    
    /**
     * Обрезка и обжим
     * */
    public function crop_and_size($arr, $model)
    {   
        $id = $model->id;
        $file = ($model->img_original[0]=='/')?substr($model->img_original, 1):$model->img_original;
        
        if(file_exists($file)){
            
            if(!is_dir('files/projects'))mkdir('files/projects', 0777);
            if(!is_dir('files/projects/'.$id))mkdir('files/projects/'.$id, 0777);
            if(!is_dir('files/projects/'.$id.'/800x600/'))mkdir('files/projects/'.$id.'/800x600/', 0777);
            if(!is_dir('files/projects/'.$id.'/373x280/'))mkdir('files/projects/'.$id.'/373x280/', 0777);
            if(!is_dir('files/projects/'.$id.'/150x150/'))mkdir('files/projects/'.$id.'/150x150/', 0777);
            
            $pathinfo = pathinfo($model->img_original);
            
            list($w, $h) = getimagesize($file); // получаем размеры изображения
            
             /*800x600*/
            $img_800x600 = 'files/projects/'.$id.'/800x600/'.$pathinfo['basename'];
            
            if ($w < $h){ // если ширина меньше высоты
                $this->size($file, $img_800x600, 0,600);  // уменьшаем по высоте
                
                list($w2, $h2) = getimagesize($img_800x600);    // получаем размеры изображения                                
                if($w2<800){$x=-round((800-$w2)/2);}else{$x=0;} // смещаем по центру ширины                                
                if($w>800)$this->crop($img_800x600,$img_800x600, array($x,0,800+$x,600), false, 85); // и обрезаем с центрированием
            }else{
                $this->size($file,$img_800x600, 800,0);   // уменьшаем по ширине
                
                list($w2, $h2) = getimagesize($img_800x600);    // получаем размеры изображения
                if($h2<600){$y=-round((600-$h2)/2);}else{$y=0;} // смещаем по центру высоты                                                              
                if($h>600){
                    $this->crop($img_800x600,$img_800x600, array(0,$y,800,600+$y), false, 85); // и обрезаем с центрированием
                }else{
                    $this->crop($img_800x600,$img_800x600, array(0,$y,800,600+$y), false, 85); // и обрезаем с центрированием
                }

            }
            $this->img_800x600 = '/'.$img_800x600; //УМЕНЬШЕННАЯ КОПИЯ

            
            /*373x280*/
            $img_373x280 = 'files/projects/'.$id.'/373x280/'.$pathinfo['basename'];
            
            if ($w < $h){ // если ширина меньше высоты
                list($w3, $h3) = getimagesize($img_800x600);
    
                $this->size($img_800x600, $img_373x280, 0,280);  // уменьшаем по высоте
                //$this->crop($img_373x280,$img_373x280, array(0,0,373,280), false, 80);
            }else{
                $this->size($img_800x600,$img_373x280, 373,0);   // уменьшаем по ширине
                $this->crop($img_373x280,$img_373x280, array(0,0,373,280), false, 80);
            }
            $this->img_373x280 = '/'.$img_373x280; //УМЕНЬШЕННАЯ КОПИЯ
            
            
            /*150x150*/
            $img_150x150 = 'files/projects/'.$id.'/150x150/'.$pathinfo['basename'];
            
            if ($w < $h){ // если ширина меньше высоты
                $this->size($file, $img_150x150, 150,0);  // уменьшаем по меньшей стороне, ширине
                list($w2, $h2) = getimagesize($img_150x150);    // получаем размеры изображения
                if($h2>150){$y=-round((150-$h2)/2);}else{$y=0;} // смещаем по центру высоты                                                              
                if($h>150)$this->crop($img_150x150,$img_150x150, array(0,$y,150,150+$y), false, 90); // и обрезаем с центрированием
            }else{
                $this->size($file,$img_150x150, 0,150);   // уменьшаем по меньшей стороне, высоте
                
                list($w2, $h2) = getimagesize($img_150x150);    // получаем размеры изображения    
                if($w2>150){$x=-round((150-$w2)/2);}else{$x=0;} // смещаем по центру ширины   
                if($w>150)$this->crop($img_150x150,$img_150x150, array($x,0,150+$x,150), false, 90); // и обрезаем с центрированием
            }
            $this->img_150x150 = '/'.$img_150x150; //УМЕНЬШЕННАЯ КОПИЯ
            
            return true;
        }else{
            echo 'не верный путь';
        }
        
        return false;
    }
    
    
    /**
    * Масштабирование изображения
    *
    * @param string Расположение исходного файла
    * @param string Расположение конечного файла
    * @param integer Ширина конечного файла
    * @param integer Высота конечного файла
    * @param bool Размеры даны в пискелях или в процентах
    * @return bool
    */
    public function size($file_input, $file_output, $w_o, $h_o, $percent = false){
	   list($w_i, $h_i, $type) = getimagesize($file_input);
	   if (!$w_i || !$h_i) {
		  return;
       }
       $types = array('','gif','jpeg','png');
       $ext = $types[$type];
       if ($ext) {
       $func = 'imagecreatefrom'.$ext;
       $img = $func($file_input);
       } else {
	  	return;
       }
	   if ($percent) {
		$w_o *= $w_i / 100;
		$h_o *= $h_i / 100;
	   }
	   if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	   if (!$w_o) $w_o = $h_o/($h_i/$w_i);
	   $img_o = imagecreatetruecolor($w_o, $h_o);
	   if ($type == 3) {
	      imagesavealpha($img_o, true);
	      $trans_colour = imagecolorallocatealpha($img_o, 0, 0, 0, 127);
	      imagefill($img_o, 0, 0, $trans_colour);
       }
	   imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
	   if ($type == 2) {
		 return imagejpeg($img_o,$file_output,100);
	   } else {
		 $func = 'image'.$ext;
		 return $func($img_o,$file_output);
	   }
    }
    
    /**
    * Обрезка изображения
    * @param string Расположение исходного файла
    * @param string Расположение конечного файла
    * @param array Координаты обрезки
    * @param bool Размеры даны в пискелях или в процентах
    * @return bool
    */
    public function crop($file_input, $file_output, $crop = 'square',$percent = false, $compress=100){
	  list($w_i, $h_i, $type) = getimagesize($file_input);
	  if (!$w_i || !$h_i) {
		return;
      }
      $types = array('','gif','jpeg','png');
      $ext = $types[$type];
      if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
      } else {
		return;
      }
	  if ($crop == 'square') {
		if ($w_i > $h_i) {
	      $x_o = ($w_i - $h_i) / 2;
	      $min = $h_i;
        } else {
	      $y_o = ($h_i - $w_i) / 2;
	      $min = $w_i;
        }
		$w_o = $h_o = $min;
	  } else {
		list($x_o, $y_o, $w_o, $h_o) = $crop;
		if ($percent) {
			$w_o *= $w_i / 100;
			$h_o *= $h_i / 100;
			$x_o *= $w_i / 100;
			$y_o *= $h_i / 100;
		}
    	if ($w_o < 0) $w_o += $w_i;
	    $w_o -= $x_o;
	   	if ($h_o < 0) $h_o += $h_i;
		$h_o -= $y_o;
	  }
	  $img_o = imagecreatetruecolor($w_o, $h_o);
      if ($type == 3) {
	     imagesavealpha($img_o, true);
	     $trans_colour = imagecolorallocatealpha($img_o, 0, 0, 0, 127);
	     imagefill($img_o, 0, 0, $trans_colour);
      }
	  imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
	  if ($type == 2) {
		return imagejpeg($img_o,$file_output,$compress);
	  } else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	  }
    }
}