<?php
// loosely based on http://sleeplessgeek.blogspot.de/2010/03/rails-caching-and-cache-busting-in-php.html

/* Configuration options */
define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('IMG_BASE_PATH', ROOT_PATH . '/img/');
define('IMG_BASE_URL', '/img/');
define('CSS_BASE_PATH', ROOT_PATH . '/css/');
define('CSS_BASE_URL', '/css/');
define('JS_BASE_PATH', ROOT_PATH . '/js/');
define('JS_BASE_URL', '/js/');

/**
 * @param string $fileName the file name
 * @param string $attr optional html attribute
 * @return a generated html tag string
 */
function staticFile($fileName, $attr = null){
  $filetype = substr($fileName,strripos($fileName, '.') + 1);

  switch ($filetype){
    case 'css':
        $output = '<link rel="stylesheet" type="text/css" href="' . CSS_BASE_URL;
        $output .= getAssetFp(CSS_BASE_PATH, $fileName);
        $output .= '"';
        if ($attr) {
         $output .= $attr . ' ';
        }
        $output .= '/>' . "\n";
        break;
    case 'js':
        $output = '<script type="text/javascript" src="' . JS_BASE_URL;
        $output .= getAssetFp(JS_BASE_PATH, $fileName);
        $output .= '"';
        $output .= '</script>' . "\n";
        break;
   case 'jpg':
   case 'gif':
   case 'png':
        $output = '<img src="' . IMG_BASE_URL;
        $output .= getAssetFp(IMG_BASE_PATH, $fileName);
        $output .= '"';
        $imgsize = getimagesize(IMG_BASE_PATH . $fileName);
        $output .= ' ' . $imgsize[3];
        if ($attr) {
         $output .= ' ' . $attr;
        }
        $output .= ' />';
        break;
    }

    return $output;
}

/**
 * @param string $basePath the base path for the file
 * @param string $fileName the file name
 * @return string the file name with an added asset fingerprint
 */
function getAssetFp($basePath, $fileName) {
    $dotPos = strrpos($fileName, '.');
    $ext = substr($fileName, $dotPos);
    $name_without_ext = substr($fileName, 0, $dotPos);
    if (!file_exists($basePath . $fileName)) return $fileName;
    return $name_without_ext . '-'. md5_file($basePath . $fileName) . $ext;
}