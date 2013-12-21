<?php 
/**
 * Image resize
 * @param int $width
 * @param int $height
 */
function resize($width, $height, $urm){
  /* Get original image x y*/
  list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
  /* calculate new image size with ratio */
  $ratio = max($width/$w, $height/$h);
  $h = ceil($height / $ratio);
  $x = ($w - $width / $ratio) / 2;
  $w = ceil($width / $ratio);

  $extension = 'jpg';
  switch ($_FILES['image']['type']) {
    case 'image/jpeg':
      $extension = 'jpg';
      break;
    case 'image/png':
      $extension = 'png';
      break;
    case 'image/gif':
      $extension = 'gif';
      break;
    default:
      exit;
      break;
  }




  /* new file name */
  // $path = 'class_assets/class_1/'.$width.'x'.$height.'_Header.'.$extension;
 $path = $urm.$width.'x'.$height.'_Header.'.$extension;

  /* read binary data from image file */
  $imgString = file_get_contents($_FILES['image']['tmp_name']);
  /* create image from string */
  $image = imagecreatefromstring($imgString);
  $tmp = imagecreatetruecolor($width, $height);
  imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $width, $height,
    $w, $h);
  /* Save image */
  switch ($_FILES['image']['type']) {
    case 'image/jpeg':
      imagejpeg($tmp, $path, 100);
      break;
    case 'image/png':
      imagepng($tmp, $path, 0);
      break;
    case 'image/gif':
      imagegif($tmp, $path);
      break;
    default:
      exit;
      break;
  }
  return $path;
  /* cleanup memory */
  imagedestroy($image);
  imagedestroy($tmp);
}


?>