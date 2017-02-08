<?php

namespace De\Idrinth\TierImages\Row;

class Size29 extends Row {
    /**
     *
     * @var string[]
     */
    protected static $positions = [
        0 => 'name',
        200 => 'ap',
        250 => 'os'
    ];
    /**
     *
     * @param string $name
     * @param int $ap
     * @param int $os
     * @param int $maxTier
     * @param int[]|string $allTiers
     */
    public function __construct($name,$ap,$os) {
        $this->rows[0] = ['name' => $name,'ap' => $this->implode([$ap]),'os' => $this->implode([$os])];
        if(strlen($name) > 30) {
            foreach(explode("\n",wordwrap($name,30)) as $pos => $sub) {
                $this->rows[$pos]['name'] = $sub;
            }
        }
    }
}