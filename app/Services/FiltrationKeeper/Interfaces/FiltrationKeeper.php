<?php

namespace App\Services\FiltrationKeeper\Interfaces;

interface FiltrationKeeper
{
    /**
     * @param string $entityClass
     * @param array $params
     * @return bool
     */
    public function saveParams($entityClass, $params);

    /**
     * @param string $entityClass
     * @param array $default
     * @return array
     */
    public function getParams($entityClass, $default = null);
}
