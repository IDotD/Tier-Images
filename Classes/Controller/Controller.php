<?php

namespace De\Idrinth\TierImages\Controller;

interface Controller {
    /**
     *
     * @param array $data
     * @param array $set
     * @return resource
     */
    public function run($data,$set);
}