<?php

namespace De\Idrinth\TierImages\Controller;

class SizeFull implements Controller {
    /**
     *
     * @var resource
     */
    protected $image;
    /**
     *
     */
    public function __construct() {
        $this->image = imagecreate(600,1);
    }
    /**
     *
     * @param array $data
     * @param array $set
     * @return resource
     */
    public function run($data,$set) {
        $r = true;
        $this->getImage("Name","AP","OS","Max Tier","All Tiers",[255,255,255]);
        foreach($data as $rData) {
            $this->handleFullRaid($set,$rData,$r);
        }
        return $this->image;
    }
    /**
     *
     * @param string $name
     * @param int $ap
     * @param int $os
     * @param int $maxTier
     * @param int[]|string $allTiers
     * @param int[] $background
     */
    protected function getImage($name,$ap,$os,$maxTier,$allTiers,$background) {
        $this->image = (new \De\Idrinth\TierImages\Row\SizeFull($name,$ap,$os,$maxTier,$allTiers))->addToImage($this->image,$background);
    }
    /**
     *
     * @param array $set
     * @param array $rData
     * @param boolean $r
     */
    protected function handleFullRaid($set,$rData,&$r) {
        foreach($set['raids'] as $sRaid) {
            if(stripos($rData['name'],$sRaid) !== false) {
                $this->getImage($rData['name'],$rData['ap'],$rData['os']['nm'],max($rData['nm']),$rData['nm'],$r?[200,200,200]:[255,255,255]);
                $r = !$r;
                return;
            }
        }
    }
}