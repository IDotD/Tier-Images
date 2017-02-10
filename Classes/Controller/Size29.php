<?php

namespace De\Idrinth\TierImages\Controller;

class Size29 extends SizeHalf {
    /**
     *
     */
    public function __construct() {
        parent::__construct('2/9','2/9');
    }
    /**
     *
     * @param array $data
     * @param array $set
     * @return resource
     */
    public function run($data,$set) {
        foreach($data as &$rData) {
            $rData['2/9']['nm'] = '';
            if(isset($rData['epics']) && isset($rData['epics']['nm'])) {
                $pos = array_keys($rData['epics']['nm'],2);
                if(is_array($pos) && count($pos) > 0) {
                    $rData['2/9']['nm'] = $rData['nm'][$pos[0]];
                }
            }
        }
        return parent::run($data,$set);
    }
}