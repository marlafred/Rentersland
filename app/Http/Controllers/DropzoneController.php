<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Request;
use Response;
 
class DropzoneController extends Controller {
 
    public function index() {
        return view('dropzone_demo');
    }
 
    public function uploadFiles() {
        
        extract($_POST);
       
        $sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
        $image = imagecreatefromstring(file_get_contents($sourcePath));
        $exif = exif_read_data($sourcePath);
        
        if(!empty($exif['Orientation'])) {
            switch($exif['Orientation']) {
                case 1: // nothing
                break;

                case 2: // horizontal flip

                break;

                case 3: // 180 rotate left
                    $image = imagerotate($image,180,0);
                break;

                case 4: // vertical flip

                break;

                case 5: // vertical flip + 90 rotate right
                    $image = imagerotate($image,-90,0);
                break;

                case 6: // 90 rotate right
                   $image = imagerotate($image,-90,0);
                break;

                case 7: // horizontal flip + 90 rotate right
                    $image = imagerotate($image,-90,0);
                break;

                case 8:    // 90 rotate left
                    $image = imagerotate($image,90,0);
                break;	

            }
        }

        $file = $_FILES['file']['name'];
        $File_Ext = substr($file, strrpos($file,'.'));
        $file = 	time().rand(1,1000).$File_Ext;

        $targetPath = public_path()."/uploads/".$file;
        $upload_success = false;
        
        if(imagejpeg($image, $targetPath)){
            $upload_success = true;
        }
        
        
        /*Small Thumbs*/
        $destination = public_path()."/uploads/small_thumbs/".$file;
        $filename = $targetPath;
        $mode = 3;
        $width = 150;
        $height = 150;
        $this->resizeImage($filename, $destination, $mode, $width, $height);

        /*Large (Home Page) Thumbs*/
        $destination = public_path()."/uploads/large_thumbs/".$file;
        $filename = $targetPath;
        $mode = 3;
        $width = 370;
        $height = 270;
        $this->resizeImage($filename, $destination, $mode, $width, $height);

        /** Slider Images **/
        $destination = public_path()."/uploads/slider/".$file;
        $filename = $targetPath;
        $mode = 3;
        $width = 550;
        $height = 360;
        $this->resizeImage($filename, $destination, $mode, $width, $height);
        
        
        if ($upload_success) {
			//$success
            return Response::json($file,200);
        } else {
            return Response::json('error', 400);
        }
    }/*upload files*/ 
    
    //helper function to resize an image based on input, output and size
    function resizeImage($input, $output, $mode, $w, $h = 0)
    {
        switch($this->getMimeType($input))
        {
            case "image/png":
                $img = ImageCreateFromPng($input);
                break;
            case "image/gif":
                $img = ImageCreateFromGif($input);
                break;
            case "image/jpeg":
            default:
                $img = ImageCreateFromJPEG ($input);
                break;
        }

        $image['sizeX'] = imagesx($img);
        $image['sizeY'] = imagesy($img);
        switch ($mode){
        case 1: //Quadratic Image
            $thumb = imagecreatetruecolor($w,$w);
            if($image['sizeX'] > $image['sizeY'])
            {
                imagecopyresampled($thumb, $img, 0,0, ($w / $image['sizeY'] * $image['sizeX'] / 2 - $w / 2),0, $w,$w, $image['sizeY'],$image['sizeY']);
            }
            else
            {
                imagecopyresampled($thumb, $img, 0,0, 0,($w / $image['sizeX'] * $image['sizeY'] / 2 - $w / 2), $w,$w, $image['sizeX'],$image['sizeX']);
            }
            break;

        case 2: //Biggest side given
            if($image['sizeX'] > $image['sizeY'])
            {
                $thumb = imagecreatetruecolor($w, $w / $image['sizeX'] * $image['sizeY']);
                imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
            }
            else
            {
                $thumb = imagecreatetruecolor($w / $image['sizeY'] * $image['sizeX'],$w);
                imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
            }
            break;
        case 3; //Both sides given (cropping)
            $thumb = imagecreatetruecolor($w,$h);
            if($h / $w > $image['sizeY'] / $image['sizeX'])
            {
                imagecopyresampled($thumb, $img, 0,0, ($image['sizeX']-$w / $h * $image['sizeY'])/2,0, $w,$h, $w / $h * $image['sizeY'],$image['sizeY']);
            }
            else
            {
                imagecopyresampled($thumb, $img, 0,0, 0,($image['sizeY']-$h / $w * $image['sizeX'])/2, $w,$h, $image['sizeX'],$h / $w * $image['sizeX']);
            }
            break;

        case 0:
            $thumb = imagecreatetruecolor($w,$w / $image['sizeX']*$image['sizeY']);
            imagecopyresampled($thumb, $img, 0,0, 0,0, $w,$w / $image['sizeX']*$image['sizeY'], $image['sizeX'],$image['sizeY']);
            break;
    }        

        if(!file_exists($output)) imagejpeg($thumb, $output, 90);
    }


    //helper function to get the mime type of a file
    function getMimeType($file)
    {
        $forbiddenChars = array('?', '*', ':', '|', ';', '<', '>');

        if(strlen(str_replace($forbiddenChars, '', $file)) < strlen($file))
            // throw new \ArgumentException("Forbidden characters!");

        $file = escapeshellarg($file);

        ob_start();
        $type = system("file --mime-type -b ".$file);
        ob_clean();

        return $type;
    }

    
}