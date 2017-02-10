<?php

namespace De\Idrinth\TierImages;

class HeightService {
    /**
     *
     * @param resource $image
     * @return int
     */
    public static function getHeight($image) {
        $file = '/tmp/' . sha1(json_encode($_SERVER)) . microtime(true) . '.jpg';
        imagejpeg($image,$file);
        $height = getimagesize($file)[1];
        unlink($file);
        return $height;
    }
}