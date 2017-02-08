<?php

namespace De\Idrinth\TierImages\Controller;

class Size29 implements Controller {
    /**
     *
     * @var resource
     */
    protected $leftImage;
    /**
     *
     * @var resource
     */
    protected $rightImage;
    /**
     *
     */
    public function __construct() {
        $this->rightImage = imagecreate(300,1);
        $this->leftImage = imagecreate(300,1);
    }
    /**
     *
     * @param array $data
     * @param array $set
     * @return resource
     */
    public function run($data,$set) {
        $r = 0;
        $this->getLeftImage("Name","AP","2/9",[255,255,255]);
        $this->getRightImage("Name","AP","2/9",[255,255,255]);
        foreach($data as $rData) {
            $this->handleFullRaid($set,$rData,$r);
        }
        $height = max(
                \De\Idrinth\TierImages\HeightService::getHeight($this->leftImage),\De\Idrinth\TierImages\HeightService::getHeight($this->rightImage)
        );
        $img = imagecreate(600,$height);
        imagecopy($img,$this->rightImage,300,0,0,0,300,\De\Idrinth\TierImages\HeightService::getHeight($this->rightImage));
        imagecopy($img,$this->leftImage,0,0,0,0,300,\De\Idrinth\TierImages\HeightService::getHeight($this->leftImage));
        return $img;
    }
    /**
     *
     * @param string $name
     * @param int $ap
     * @param int $os
     * @param int[] $background
     */
    protected function getLeftImage($name,$ap,$os,$background) {
        $this->leftImage = (new \De\Idrinth\TierImages\Row\Size29($name,$ap,$os))->addToImage($this->leftImage,$background);
    }
    /**
     *
     * @param string $name
     * @param int $ap
     * @param int $os
     * @param int[] $background
     */
    protected function getRightImage($name,$ap,$os,$background) {
        $this->rightImage = (new \De\Idrinth\TierImages\Row\Size29($name,$ap,$os))->addToImage($this->rightImage,$background);
    }
    /**
     *
     * @param array $set
     * @param array $rData
     * @param int $r
     */
    protected function handleFullRaid($set,$rData,&$r) {
        foreach($set['raids'] as $sRaid) {
            if(stripos($rData['name'],$sRaid)) {
                switch($r % 4) {
                    case 3:
                        $this->getRightImage($rData['name'],$rData['ap'],$rData['os']['nm'],[255,255,255]);
                        break;
                    case 2:
                        $this->getLeftImage($rData['name'],$rData['ap'],$rData['os']['nm'],[255,255,255]);
                        break;
                    case 1:
                        $this->getRightImage($rData['name'],$rData['ap'],$rData['os']['nm'],[200,200,200]);
                        break;
                    case 0:
                    default:
                        $this->getLeftImage($rData['name'],$rData['ap'],$rData['os']['nm'],[200,200,200]);
                }
                $r++;
                return;
            }
        }
    }
}