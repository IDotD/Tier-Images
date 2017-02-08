<?php

namespace De\Idrinth\TierImages\Row;

class SizeFull extends Row {
    /**
     *
     * @var string[]
     */
    protected static $positions = [
        0 => 'name',
        200 => 'ap',
        250 => 'os',
        300 => 'maxTier',
        350 => 'allTiers',
    ];
    /**
     *
     * @param string $name
     * @param int $ap
     * @param int $os
     * @param int $maxTier
     * @param int[]|string $allTiers
     */
    public function __construct($name,$ap,$os,$maxTier,$allTiers) {
        $this->rows[0] = ['name' => $name,'ap' => $this->implode([$ap]),'os' => $this->implode([$os]),'maxTier' => $this->implode([$maxTier])];
        $count = 0;
        if(strlen($name) > 30) {
            foreach(explode("\n",wordwrap($name,30)) as $pos => $sub) {
                $this->rows[$pos]['name'] = $sub;
            }
        }
        if(is_array($allTiers)) {
            while(count($allTiers) > 0) {
                $this->rows[$count] = isset($this->rows[$count])?$this->rows[$count]:[];
                $this->rows[$count]['allTiers'] = $this->implode(array_splice($allTiers,0,7));
                $count++;
            }
        } else {
            $this->rows[0]['allTiers'] = $allTiers;
        }
    }
}