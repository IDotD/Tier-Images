<?php

namespace De\Idrinth\TierImages;

class ImageGenerator {
    /**
     *
     * @param string $set
     * @return void
     */
    public function run($set) {
        header('Content-Type: image/jpeg');
        $set = json_decode(file_get_contents('config.json'),true)[$set];
        if(!$set) {
            return;
        }
        /* 'https://dotd.idrinth.de/static/tier-service/' => tiers.json */
        $data = json_decode(file_get_contents('tiers.json'),true);
        if(!$data) {
            return;
        }
        imagejpeg($this->getHandler($set['type'])->run($data,$set),null,100);
    }
    /**
     *
     * @param string $type
     * @return \De\Idrinth\TierImages\Controller\Controller
     */
    protected function getHandler($type) {
        switch($type) {
            case 'small'://todo
            case '2/9':
                return new Controller\Size29();
            case 'full':
            default:
                return new Controller\SizeFull();
        }
    }
}