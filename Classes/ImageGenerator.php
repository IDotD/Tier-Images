<?php

namespace De\Idrinth\TierImages;

class ImageGenerator {
    /**
     *
     * @param string $set
     * @param string $data
     * @return void
     */
    public function run($set,$data) {
        header('Content-Type: image/jpeg');
        $set = json_decode(file_get_contents('config.json'),true)[$set];
        if(!$set) {
            $r = array_keys(json_decode(file_get_contents('config.json'),true));
            array_unshift($r,'Known Configurations:');
            return $this->errorImage($r);
        }
        /* 'https://dotd.idrinth.de/static/tier-service/' => tiers.json */
        $data = json_decode(file_get_contents($data),true);
        if(!$data) {
            return $this->errorImage(['Failed to load tier data']);
        }
        imagejpeg($this->getHandler($set['type'])->run($data,$set),null,100);
    }
    /**
     *
     * @param string[] $lines
     */
    protected function errorImage($lines) {
        $image = imagecreate(600,count($lines) * 20);
        $white = imagecolorallocate($image,255,255,255);
        imagefill($image,0,0,$white);
        $black = imagecolorallocate($image,0,0,0);
        foreach($lines as $pos => $line) {
            imagestring($image,2,5,$pos * 20 + 3,$line,$black);
        }
        imagejpeg($image);
    }
    /**
     *
     * @param string $type
     * @return \De\Idrinth\TierImages\Controller\Controller
     */
    protected function getHandler($type) {
        switch($type) {
            case 'small':
                return new Controller\SizeHalf('os','OS');
            case '2/9':
                return new Controller\Size29();
            case 'full':
            default:
                return new Controller\SizeFull();
        }
    }
}