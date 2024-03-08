<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compress {
    
    // @var file_url
    public $file_url;
    // @var new_name_image
    public $new_name_image;
    // @var quality
    public $quality;
    // @var png quality
    public $pngQuality;
    // @var destination
    public $destination;

    public function __construct($file_url = null, $new_name_image = null, $quality = null, $pngQuality = null, $destination = null) {
        $this->file_url = $file_url;
        $this->new_name_image = $new_name_image;
        $this->quality = $quality;
        $this->pngQuality = $pngQuality;
        $this->destination = $destination;
    }
    
    /**
     * Function to compress image
     * @return array
     * @throws Exception
     */
    public function compress_image(){
        
        //Send image array
        $array_img_types = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
        $new_image = null;
        $last_char = null;
        $image_extension = null;
        $destination_extension = null;
        $png_compression = null;
        $real_path_file = $_SERVER['DOCUMENT_ROOT'].parse_url($this->file_url, PHP_URL_PATH);
        $real_destination = $_SERVER['DOCUMENT_ROOT'].parse_url($this->destination, PHP_URL_PATH);
        $result = array();
        $maxsize = 5245330;
        
        try{
            
            //If not found the file
            if(empty($this->file_url) && !file_exists($this->file_url)){
                throw new Exception('Please inform the image!');
                return false;
            }

            //Get image width, height, mimetype, etc..
            $image_data = getimagesize($this->file_url);
            //Set MimeType on variable
            $image_mime = $image_data['mime'];
            
            //Verifiy if the file is a image
            if(!in_array($image_mime, $array_img_types)){
                throw new Exception('Please send a image!');
                return false; 
            }
            
            //Get file size
            $image_size = filesize($real_path_file);

            //if image size is bigger than 5mb
            if($image_size >= $maxsize){
                throw new Exception('Please send a imagem smaller than 5mb!');
                return false;
            }
            
            //If not found the destination
            if(empty($this->new_name_image)){
                throw new Exception('Please inform the destination name of image!');
                return false;
            }
            
            //If not found the quality
            if(empty($this->quality)){
                throw new Exception('Please inform the quality!');
                return false;
            }

            //If not found the png quality
            $png_compression = (!empty($this->pngQuality)) ? $this->pngQuality : 9 ;
            
            $image_extension = pathinfo($this->file_url, PATHINFO_EXTENSION);
            //Verify if is sended a destination file name with extension
            $destination_extension = pathinfo($this->new_name_image, PATHINFO_EXTENSION); 
            //if empty
            if(empty($destination_extension)){
                $this->new_name_image = $this->new_name_image.'.'.$image_extension;
            }
            
            //Verify if folder destination isn't empty
            if(!empty($real_destination)){
                
                //And verify the last one element of value
                $last_char = substr($real_destination, -1);
                
                if($last_char !== '/'){
                    $real_destination = $real_destination.'/';
                }
            }
            
            //Switch to find the file type
            switch ($image_mime){
                //if is JPG and siblings
                case 'image/jpeg':
                case 'image/pjpeg':
                    //Create a new jpg image
                    $new_image = imagecreatefromjpeg($this->file_url);
                    imagejpeg($new_image, $real_destination.$this->new_name_image, $this->quality);
                    break;
                //if is PNG and siblings
                case 'image/png':
                case 'image/x-png':
                    //Create a new png image
                    $new_image = imagecreatefrompng($this->file_url);
                    imagealphablending($new_image , false);
                    imagesavealpha($new_image , true);
                    imagepng($new_image, $real_destination.$this->new_name_image, $png_compression);
                    break;
                // if is GIF
                case 'image/gif':
                    //Create a new gif image
                    $new_image = imagecreatefromgif($this->file_url);
                    imagealphablending($new_image, false);
                    imagesavealpha($new_image, true);
                    imagegif($new_image, $real_destination.$this->new_name_image);
            }
            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        
        $result = array(
            'image' => $this->new_name_image,
            'real_file_path' => $real_destination.$this->new_name_image,
            'url_file_path' => $this->destination.'/'.$this->new_name_image
        );
        
        //Return the new image resized
        return $result;
        
    }
}