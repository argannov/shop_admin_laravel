<?php

namespace App\Services\FiltrationKeeper\Interfaces;


use Illuminate\Http\Request;

interface FiltrationKeeper
{
    /**
     * @param string $entityClass
     * @param Request $request
     * @return bool
     */
    public function saveParams($entityClass, $request);

    /**
     * @param string $entityClass
     * @param array $default
     * @return array
     */
    public function getParams($entityClass, $default = null);
}
