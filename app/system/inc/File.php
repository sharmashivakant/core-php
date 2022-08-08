<?php
/**
 * Class File
 */
class File
{
    /**
     * @var array
     */
    static public $allowedFileFormats = array(
        '3gp'   => true,
        '7z'    => true,
        'amr'   => true,
        'apk'   => true,
        'avi'   => true,
        'bat'   => true,
        'bmp'   => true,
        'css'   => true,
        'djvu'  => true,
        'doc'   => true,
        'docx'  => true,
        'exe'   => true,
        'flv'   => true,
        'gif'   => true,
        'html'  => true,
        'ini'   => true,
        'ipa'   => true,
        'jar'   => true,
        'jpeg'  => true,
        'jpg'   => true,
        'js'    => true,
        'midi'  => true,
        'mp3'   => true,
        'mp4'   => true,
        'pdf'   => true,
        'php'   => true,
        'png'   => true,
        'pps'   => true,
        'ppt'   => true,
        'pptx'  => true,
        'psd'   => true,
        'rar'   => true,
        'sxc'   => true,
        'tar'   => true,
        'txt'   => true,
        'wav'   => true,
        'webm'  => true,
        'wma'   => true,
        'xls'   => true,
        'xlsx'  => true,
        'xml'   => true,
        'zip'   => true
    );

    /**
     * @var array
     */
    static public $allowedImageFormats = array(
        'gif'   => true,
        'png'   => true,
        'jpg'   => true,
        'jpeg'  => true
    );

    /**
     * @var array
     */
    static public $allowedDocFormats = array(
        'doc'   => true,
        'docx'  => true,
        'pdf'   => true,
        'txt'   => true,
        'fotd'  => true
    );

    static public $allowedVideoFormats = array(
        'mp4'   => true,
        'avi'  => true,
        'mkv'   => true,
    );

    /**
     * @var int
     */
    static public $allowedFileSize = 209715200; //200M

    /**
     * @var
     */
    static public $error;


    /**
     * @param $path
     * @return bool
     */
    static public function exist($path)
    {
        if (file_exists(_SYSDIR_.$path))
            return true;
        else
            return false;
    }

    static public function format($name)
    {
        $format = mb_strtolower($name);
        return mb_substr($format, mb_strrpos($format, '.')+1);
    }

    /**
     * @param $file
     * @param $data
     * @return int
     */
    static public function write($file, $data)
    {
        return file_put_contents($file, $data);
    }

    /**
     * @param $file
     * @return string
     */
    static public function read($file)
    {
        return file_get_contents($file);
    }

    /**
     * @param $path
     * @return bool
     */
    static public function remove($path)
    {
        return @unlink(_SYSDIR_.$path);
    }

    /**
     * Copy file
     * @param $filePath
     * @param $copyPath
     * @return bool
     */
    static public function copy($filePath, $copyPath)
    {
        $copyPath = trim($copyPath, '/');
        $array = explode('/', $copyPath);
        array_pop($array); // remove file name

        self::mkdir(implode('/', $array));
        return copy(_SYSDIR_ . $filePath, _SYSDIR_ . $copyPath);
    }


    /**
     * function mkdirRecursive
     * @param $path
     * @param int $chmod
     * @return string
     */
    static public function mkdir($path, $chmod = 0777)
    {
        $path = trim($path, '/');
        $array = explode('/', $path);

        $fullPath = _SYSDIR_;
        foreach ($array as $value) {
            $fullPath .= $value . '/';

            if (!is_dir($fullPath))
                @mkdir($fullPath, $chmod);
            @chmod($fullPath, $chmod);
        }

        return $fullPath;
    }



    /**
     * Function ImageResize
     * @param $src - file path
     * @param $name - old file name
     * @param $dst - file out
     * @param $width - new width
     * @param $height - new height
     * @param int $crop - crop image
     * @return bool|string
     */
    static public function ImageResize($src, $name, $dst, $width, $height, $crop = 0)
    {
//        $tmp=tmpfile();
//        $file=stream_get_meta_data($tmp)['uri'];
//        $ch=curl_init($link);
//
//        curl_setopt_array($ch,array(
//            CURLOPT_FILE=>$tmp,
//            CURLOPT_ENCODING=>''
//        ));
//
//        curl_exec($ch);
//        curl_close($ch);
//
//        list($width, $height) = getimagesize($file);
//        fclose($tmp); // << explicitly deletes the file, freeing up disk space etc~ - though php would do this automatically at the end of script execution anyway.
//        if (!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

        $type = strtolower(substr(strrchr($name, "."), 1));
        if ($type == 'jpeg') $type = 'jpg';


        switch ($type) {
            case 'bmp':
                $img = imagecreatefromwbmp($src);
                break;
            case 'gif':
                $img = imagecreatefromgif($src);
                break;
            case 'jpg':
                $img = imagecreatefromjpeg($src);
                break;
            case 'png':
                $img = imagecreatefrompng($src);
                break;
            default :
                return "Unsupported picture type!";
        }

        $w = imagesx($img);
        $h = imagesy($img);

        // resize
        if ($crop) {
            if ($w < $width or $h < $height) return "Picture is too small!";
            $ratio = max($width / $w, $height / $h);
            $h = $height / $ratio;
            $x = ($w - $width / $ratio) / 2;
            $w = $width / $ratio;
        } else {
            if ($w < $width and $h < $height) return "Picture is too small!";
            $ratio = min($width / $w, $height / $h);
            $width = $w * $ratio;
            $height = $h * $ratio;
            $x = 0;
        }

        $new = imagecreatetruecolor($width, $height);

        // preserve transparency
        if ($type == "gif" or $type == "png") {
            imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
            imagealphablending($new, false);
            imagesavealpha($new, true);
        }

        imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

        switch ($type) {
            case 'bmp':
                imagewbmp($new, $dst);
                break;
            case 'gif':
                imagegif($new, $dst);
                break;
            case 'jpg':
                imagejpeg($new, $dst);
                break;
            case 'png':
                imagepng($new, $dst);
                break;
        }

        imageDestroy($new);

        return true;
    }


    /**
     * Function UploadCV
     * @param $file
     * @param $path
     * @param $name
     * @return mixed
     */
    static public function UploadCV($file, $path, $name = false)
    {
        if (!$name)
            $name = randomHash();

        $format = mb_strtolower($file['name']);
        $format = mb_substr($format, mb_strrpos($format, '.')+1);

        if (is_uploaded_file($file['tmp_name'])) {
            if ($file['size'] <= self::$allowedFileSize) {
                if (self::$allowedDocFormats[$format] === true) {
                    self::mkdir($path);

                    if (copy($file['tmp_name'], _SYSDIR_ . $path . '/' . $name . '.' . $format)) {
                        // return data
                        $data               = array();
                        $data['fileName']   = $file['name'];
                        $data['name']       = $name;
                        $data['format']     = $format;
                        $data['size']       = $file['size'];
                        $data['path']       = _SYSDIR_ . $path;
                        $data['url']        = _SITEDIR_ . $path . $name . '.' . $format;
                        return $data;
                    } else {
                        self::$error = "Error while moving file to site storage.";
                        return false;
                    }
                } else {
                    self::$error = "WRONG_FORMAT";
                    return false;
                }
            } else {
                self::$error = "WRONG_SIZE";
                return false;
            }
        } else {
            self::$error = $file['error'];
            return false;
        }
    }







    /**
     * Function LoadFile
     * @param $file
     * @param $path
     * @param $name
     * @return mixed
     */
    static public function LoadFile($file, $path, $name = false, &$error = array(), &$data = array())
    {
        if (!$name)
            $name = randomHash();

        $format = mb_strtolower($file['name']);
        $format = mb_substr($format, mb_strrpos($format, '.')+1);

        if (is_uploaded_file($file['tmp_name'])) {
            if ($file['size'] <= self::$allowedFileSize) {
                if (self::$allowedFileFormats[$format] === true) {
                    self::mkdir($path, 0777); // Recursive mkdir

                    if (copy($file['tmp_name'], _SYSDIR_ . $path . '/' . $name . '.' . $format)) {
                        $data               = array();
                        $data['fileName']   = $file['name'];
                        $data['name']       = $name;
                        $data['format']     = $format;
                        $data['size']       = $file['size'];
                        $data['path']       = _SYSDIR_ . $path;
                        $data['url']        = _SITEDIR_ . $path . $name . '.' . $format;
                        return $data;
                    } else {
                        self::$error = "Error while moving file to site storage.";
                        return false;
                    }
                } else {
                    self::$error = "WRONG_FORMAT";
                    return false;
                }
            } else {
                self::$error = "WRONG_SIZE";
                return false;
            }
        } else {
            self::$error = $file['error'];
            return false;
        }
    }

    static public function UploadVideo($file, $path, $name = false)
    {
        if (!$name)
            $name = randomHash();

        $format = mb_strtolower($file['name']);
        $format = mb_substr($format, mb_strrpos($format, '.')+1);

        if (is_uploaded_file($file['tmp_name'])) {
            if ($file['size'] <= self::$allowedFileSize) {
                if (self::$allowedVideoFormats[$format] === true) {
                    self::mkdir($path);

                    if (copy($file['tmp_name'], _SYSDIR_ . $path . '/' . $name . '.' . $format)) {
                        // return data
                        $data               = array();
                        $data['fileName']   = $file['name'];
                        $data['name']       = $name;
                        $data['format']     = $format;
                        $data['size']       = $file['size'];
                        $data['path']       = _SYSDIR_ . $path;
                        $data['url']        = _SITEDIR_ . $path . $name . '.' . $format;
                        return $data;
                    } else {
                        self::$error = "Error while moving file to site storage.";
                        return false;
                    }
                } else {
                    self::$error = "WRONG_FORMAT";
                    return false;
                }
            } else {
                self::$error = "WRONG_SIZE";
                return false;
            }
        } else {
            self::$error = $file['error'];
            return false;
        }
    }

    static public function imageSize($path, $format = 'png')
    {
        $data = array();

        if ($format == 'jpg')
            $imageCreateFrom = 'ImageCreateFromJpeg';
        else
            $imageCreateFrom = 'ImageCreateFrom'.$format;

        // Create resource image
        $img = $imageCreateFrom($path);

        $data['height'] = imagesy($img);
        $data['width'] = imagesx($img);

        return $data;
    }


    /**
     * Function LoadImg
     * @param $file
     * @param array $data
     * @return array
     */
    static public function LoadImg($file, $data = array())
    {
        /*
        "+" - (нужно указывать)
        "!" - (необязательно указывать)
        "-" - (не нужно указывать)

        $file - файл(+) / $_FILES['name']
        $data['path'] - путь загрузки(+) / 'app/public/'

        $data['new_name'] - новое имя(!) / 'name' else random md5 hash
        $data['new_format'] - новый формат загружаймого файла(! по умолчанию jpg) / 'png'
        $data['resize'] - resize картинки(! по умолчанию 0) / 0 - no resize(сжать), 1 - обрезать не изменяя размеров, 2 - обрезать симетрически уменьшив
        $data['allowed_formats'] - разрешаемые форматы(!) / array('jpg' => true, 'gif' => false)
        $data['mkdir'] - создание пути(!) / true, false
        $data['min_size'] - min размер(!)
        $data['max_size'] - max размер(!)
        $data['new_width'] - новая ширина(!)
        $data['new_height'] - новая высота(!)
        $data['min_width'] - min ширина(!)
        $data['min_height'] - min высота(!)
        $data['max_width'] - max ширина(!)
        $data['max_height'] - max высота(!)
        $data['ratio'] - коэффициент(!)

        $data['format'] - формат загружаймого файла(-)
        $data['tmp_name'] - хранение tmp(-)
        $data['size'] - размер файла(-)
        $data['type'] - тип файла(-)
        $data['name'] - имя файла(-)
        $data['width'] - ширина картинки(-)
        $data['height'] - высота картинки(-)
        $data['error'] - код ошибки(-)
        */

        $data['error'] = 0;
        $data['format'] = mb_strtolower(mb_substr($file['name'], mb_strrpos($file['name'], '.')+1));
        $data['tmp_name'] = $file['tmp_name'];
        $data['size'] = $file['size'];
        $data['type'] = $file['type'];
        $data['name'] = $file['name'];
        $data['originalPath'] = trim($data['path'], '/').'/';
        $data['path'] = _SYSDIR_.trim($data['path'], '/').'/';

        if (!$data['new_name'])
            $data['new_name'] = randomHash();
        if (!$data['new_format'])
            $data['new_format'] = 'jpg';
        if (!$data['resize'])
            $data['resize'] = 0;
        if (!$data['allowed_formats'])
            $data['allowed_formats'] = self::$allowedImageFormats;
        if (!$data['mkdir'])
            $data['mkdir'] = true;
        if ($data['mkdir'] === true)
            self::mkdir($data['originalPath'], 0777); // Recursive mkdir

        if ($data['allowed_formats'][$data['format']] !== true)
            $data['error'] = 10;

        if ($data['min_size'] && intval($data['min_size']) < $data['size'])
            $data['error'] = 20;

        if ($data['max_size'] && intval($data['max_size']) > $data['size'])
            $data['error'] = 30;

        if ($data['format'] == 'jpg')
            $imageCreateFrom = 'imagecreatefromjpeg';
        else
            $imageCreateFrom = 'imagecreatefrom'.$data['format'];

        if ($data['new_format'] == 'jpg')
            $imagePrint = 'imageJpeg';
        else
            $imagePrint = 'image'.$data['new_format'];

        // Create resource image
        $image = $imageCreateFrom($data['tmp_name']);

        $data['width'] = imagesx($image);
        $data['height'] = imagesy($image);

        // Min/Max resizing
        $minWidth = 0;
        $minHeight = 0;
        $maxWidth = 0;
        $maxHeight = 0;

        if ($data['min_width']){
            if ($data['min_width'] <= $data['width'])
                $minWidth = $data['width'];
            else
                $data['error'] = 40;
        }

        if ($data['min_height']) {
            if ($data['min_height'] <= $data['height'])
                $minHeight = $data['height'];
            else
                $data['error'] = 50;
        }

        if ($data['max_width']) {
            if ($data['max_width'] > $data['width'])
                $maxWidth = $data['width'];
            else
                $maxWidth = $data['max_width'];
        }

        if ($data['max_height']) {
            if ($data['max_height'] > $data['height'])
                $maxHeight = $data['height'];
            else
                $maxHeight = $data['max_height'];
        }

        // Приоритеты
        if (!$data['new_width']) {
            if ($maxWidth)
                $data['new_width'] = $maxWidth;
            else
                $data['new_width'] = $data['width'];
        }

        if (!$data['new_height']) {
            if ($maxHeight)
                $data['new_height'] = $maxHeight;
            else
                $data['new_height'] = $data['height'];
        }

        // Resizing
        if ($data['new_width'] == 0 && $data['new_height'] == 0) {
            $data['new_width'] = $data['width'];
            $data['new_height'] = $data['height'];
        } else if ($data['new_width'] != 0 && $data['new_height'] == 0) {
            $hw = round($data['height'] / $data['width'], 6);
            $data['new_height'] = round($hw * $data['new_width'], 0);
        } else if ($data['new_width'] == 0 && $data['new_height'] != 0) {
            $hw = round($data['width'] / $data['height'], 6);
            $data['new_width'] = round($hw * $data['new_height'], 0);
        } else if ($data['new_width'] != 0 && $data['new_height'] != 0) {

        }

        if ($data['resize'] == 1) {
            $data['height'] = $data['new_height'];
            $data['width'] = $data['new_width'];
        }

        if ($data['resize'] == 2) {
            if ($data['new_width'] > $data['new_height']) {
                $hw = round($data['new_height'] / $data['new_width'], 6);
                $data['height'] = round($hw * $data['width'], 0);
            } elseif ($data['new_width'] < $data['new_height']) {
                $hw = round($data['new_width'] / $data['new_height'], 6);
                $data['width'] = round($hw * $data['height'], 0);
            } else {
                if ($data['width'] > $data['height']) {
                    $data['width'] = $data['height'];
                } else {
                    $data['height'] = $data['width'];
                }
            }
        }

        if ($data['error'] != 0)
            return $data;


        if (!$data['cropPosX'] OR $data['cropPosX'] <= 0)
            $data['cropPosX'] = 0;

        if (!$data['cropPosY'] OR $data['cropPosY'] <= 0)
            $data['cropPosY'] = 0;

        if (!$data['crop_width'] OR $data['crop_width'] <= 0) {
            $imageWidth = $data['width'];
        } else {
            $imageWidth = $data['crop_width']-1;
            if ($data['make_bigger_quality'] == true) {
                if ($imageWidth > $data['new_width'] && $imageWidth <= 500)
                    $data['new_width'] = $imageWidth;
                elseif ($imageWidth > $data['new_width'] && $imageWidth > 500)
                    $data['new_width'] = 500;
            }
        }

        if (!$data['crop_height'] OR $data['crop_height'] <= 0) {
            $imageHeight = $data['height'];
        } else {
            $imageHeight = $data['crop_height']-1;
            if ($data['make_bigger_quality'] == true) {
                if ($imageHeight > $data['new_height'] && $imageHeight <= 500)
                    $data['new_height'] = $imageHeight;
                elseif ($imageHeight > $data['new_height'] && $imageHeight > 500)
                    $data['new_height'] = 500;
            }
        }

        $screen = imageCreateTrueColor($data['new_width'], $data['new_height']);

        if ($data['format'] == 'png') {
            imagealphablending($screen, false); // Disable pairing colors
            imagesavealpha($screen, true); // Including the preservation of the alpha channel
        }

        imageCopyResampled($screen, $image, 0, 0, $data['cropPosX'], $data['cropPosY'], $data['new_width'], $data['new_height'], $imageWidth, $imageHeight);
        $imagePrint($screen, $data['path'].$data['new_name'].'.'.$data['new_format']);
        imageDestroy($image);
        return $data;
    }

    /**
     * Function LoadImage
     * @param array $file ex. $_FILES['name']
     * @param string $path ex. 'app/public/'
     * @param null $name ex. 'name'
     * @param string $format ex. 'jpg'
     * @param array $allowedFormats ex. array('jpg' => true, 'gif' => false)
     * @param int $size - max file size
     * @param int $resize ex. 0 - no resize(сжать), 1 - обрезать не изменяя размеров, 2 - обрезать симетрически уменьшив
     * @param int $minHeight
     * @param int $minWidth
     * @param int $maxHeight
     * @param int $maxWidth
     * @return mixed
     */
//    static public function LoadImage($file, $path, $name = null, $format = 'jpg', $allowedFormats = array(), $options) // todo $options INSTEAD: $size = 0, $resize = 0, $minHeight = 0, $minWidth = 0, $maxHeight = 0, $maxWidth = 0
    static public function LoadImage($file, $path, $name = null, $format = 'jpg', $allowedFormats = array(), $size = 0, $resize = 0, $minHeight = 0, $minWidth = 0, $maxHeight = 0, $maxWidth = 0)
    {
        $data = array('error' => 0);
        $data['format'] = mb_strtolower(mb_substr($file['name'], mb_strrpos($file['name'], '.')+1));
        $data['new_format'] = $format;
        $data['path'] = _SYSDIR_.trim($path, '/').'/';
        $data['tmp_name'] = $file['tmp_name'];
        $data['size'] = $file['size'];
        $data['type'] = $file['type'];
        $data['name'] = $file['name'];

        // Recursive mkdir
        self::mkdir($path, 0777);

        if (!$name)
            $data['new_name'] = randomHash();
        else
            $data['new_name'] = $name;

        if (!is_array($allowedFormats) OR empty($allowedFormats))
            $allowedFormats = self::$allowedImageFormats;

        if ($allowedFormats[$data['format']] !== true) {
            $data['error'] = 1;
            $data['error_msg'] = 'Incorrect file format';
            return $data;
        }

        if (intval($size) > 0 && $data['size'] > $size) {
            $data['error'] = 2;
            $data['error_msg'] = 'File size is too large';
            return $data;
        }

        if ($data['format'] == 'jpg')
            $imageCreateFrom = 'ImageCreateFromJpeg';
        else
            $imageCreateFrom = 'ImageCreateFrom'.$data['format'];

        if ($data['new_format'] == 'jpg')
            $imagePrint = 'imageJpeg';
        else
            $imagePrint = 'image'.$data['new_format'];

        // Create resource image
        $img = $imageCreateFrom($file['tmp_name']);

        $data['height'] = imagesy($img);
        $data['width'] = imagesx($img);

        // Min resizing
        if ($minHeight == 0 && $minWidth == 0) {
            $data['new_height'] = $data['height'];
            $data['new_width'] = $data['width'];
        } else if ($minHeight != 0 && $minWidth == 0) {
            $data['new_height'] = $minHeight;
            $hw = round($data['width'] / $data['height'], 6);
            $data['new_width'] = round($hw * $minHeight,0);
        } else if ($minHeight == 0 && $minWidth != 0) {
            $data['new_width'] = $minWidth;
            $hw = round($data['height'] / $data['width'], 6);
            $data['new_height'] = round($hw * $minWidth, 0);
        } else if ($minHeight != 0 && $minWidth != 0) {
            $data['new_height'] = $minHeight;
            $data['new_width'] = $minWidth;
        }

        // Max resizing
        if ($maxHeight != 0 && $maxWidth == 0 && $maxHeight < $data['height']) {
            $data['new_height'] = $maxHeight;
            $hw = round($data['width'] / $data['height'], 6);
            $data['new_width'] = round($hw * $maxHeight,0);
        } else if ($maxHeight == 0 && $maxWidth != 0 && $maxWidth < $data['width']) {
            $data['new_width'] = $maxWidth;
            $hw = round($data['height'] / $data['width'], 6);
            $data['new_height'] = round($hw * $maxWidth, 0);
        } else if ($maxHeight != 0 && $maxWidth != 0 && ($maxHeight < $data['height'] OR $maxWidth < $data['width'])) {
            if ($data['height'] > $data['width']) {
                $data['new_height'] = $maxHeight;
                $hw = round($data['width'] / $data['height'], 6);
                $data['new_width'] = round($hw * $maxHeight,0);
            } elseif ($data['height'] < $data['width']) {
                $data['new_width'] = $maxWidth;
                $hw = round($data['height'] / $data['width'], 6);
                $data['new_height'] = round($hw * $maxWidth, 0);
            }
        }

        if ($resize == 1) {
            $data['height'] = $data['new_height'];
            $data['width'] = $data['new_width'];
        }

        if ($resize == 2) {
            if ($data['new_width'] > $data['new_height']) {
                $hw = round($data['new_height'] / $data['new_width'], 6);
                $data['height'] = round($hw * $data['width'], 0);
            } elseif ($data['new_width'] < $data['new_height']) {
                $hw = round($data['new_width'] / $data['new_height'], 6);
                $data['width'] = round($hw * $data['height'], 0);
            } else {
                if ($data['width'] > $data['height']) {
                    $data['width'] = $data['height'];
                } else {
                    $data['height'] = $data['width'];
                }
            }
        }

        $screen = imageCreateTrueColor($data['new_width'], $data['new_height']);

        if ($data['format'] == 'png') {
            imagealphablending($screen, false); // Disable pairing colors
            imagesavealpha($screen, true); // Including the preservation of the alpha channel
        }

        imageCopyResampled($screen, $img, 0, 0, 0, 0, $data['new_width'], $data['new_height'], $data['width'], $data['height']);
        $imagePrint($screen, $data['path'].$data['new_name'].'.'.$data['new_format']);
        imageDestroy($img);
        return $data;
    }


    static public function translit($text, $case = false)
    {
        $search = array(" ", "<", ">", "\"", "$", "&", "'", "Ё","Ж","Ч","Ш","Щ","Э","Ю","Я","ё","ж","ч","ш","щ","э","ю","я","А","Б","В","Г","Д","Е","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ь","Ы","а","б","в","г","д","е","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ь","ы","Ґ","ґ","Ї","ї","І","і","Є","є");
        $replace = array("_", "",  "",  "", "", "", "", "Jo","Zh","Ch","Sh","Sch","Je","Jy","Ja","jo","zh","ch","sh","sch","je","jy","ja","A","B","V","G","D","E","Z","I","J","K","L","M","N","O","P","R","S","T","U","F","H","C","","Y","a","b","v","g","d","e","z","i","j","k","l","m","n","o","p","r","s","t","u","f","h","c","","y","G","g","I","i","I","i","E","e");

        if ($case == 'lower')
            return mb_strtolower(str_replace($search, $replace, $text));
        elseif ($case == 'upper')
            return mb_strtoupper(str_replace($search, $replace, $text));
        else
            return str_replace($search, $replace, $text);
    }

}

/**
 * https://stackoverflow.com/questions/13076480/php-get-actual-maximum-upload-size
 * @return int
 */
function file_upload_max_size()
{
    static $max_size = -1;

    if ($max_size < 0) {
        // Start with post_max_size.
        $post_max_size = parse_ini_size(ini_get('post_max_size'));
        if ($post_max_size > 0) {
            $max_size = $post_max_size;
        }

        // If upload_max_size is less, then reduce. Except if upload_max_size is zero, which indicates no limit.
        $upload_max = parse_ini_size(ini_get('upload_max_filesize'));
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }
    }
    return $max_size;
}

function parse_ini_size($size)
{
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    } else {
        return round($size);
    }
}

function format_bytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');

    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function file_upload_max_size_format()
{
    return format_bytes(file_upload_max_size());
}


/* End of file */