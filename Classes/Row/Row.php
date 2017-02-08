<?php

namespace De\Idrinth\TierImages\Row;

abstract class Row {
    /**
     *
     * @var array
     */
    protected $rows = [];
    /**
     *
     * @var int
     */
    protected static $width = 600;
    /**
     *
     * @param int[] $list
     * @return string
     */
    protected function implode($list) {
        if(!is_array($list)) {
            return '';
        }
        $string = '';
        foreach($list as $part) {
            if($part >= 1000000000000) {
                $string.='/' . number_format($part / 1000000000000,1) . 't';
            } elseif($part >= 1000000000) {
                $string.='/' . number_format($part / 1000000000,1) . 'b';
            } elseif($part >= 1000000) {
                $string.='/' . number_format($part / 1000000,1) . 'm';
            } elseif($part >= 1000) {
                $string.='/' . number_format($part / 1000,1) . 'k';
            } else {
                $string.='/' . $part;
            }
        }
        return str_replace('.0','',trim($string,'/'));
    }
    /**
     *
     * @param resource $image
     * @param int[] $background
     * @return resource
     */
    public function addToImage($image,$background) {
        $height = \De\Idrinth\TierImages\HeightService::getHeight($image);
        $im = imagecreate(static::$width,$height + count($this->rows) * 20);
        imagefill($im,0,0,imagecolorallocate($im,$background[0],$background[1],$background[2]));
        $black = imagecolorallocate($im,0,0,0);
        imagecopy($im,$image,0,0,0,0,static::$width,$height);
        foreach($this->rows as $num => $row) {
            foreach(static::$positions as $x => $text) {
                if(isset($row[$text])) {
                    imagestring($im,2,$x + 3,$height + 3 + $num * 20,$row[$text],$black);
                }
            }
        }
        foreach(static::$positions as $x => $text) {
            imageline($im,$x,0,$x,$height + count($this->rows) * 20,$black);
        }
        imageline($im,0,20,static::$width,20,$black);
        return $im;
    }
}