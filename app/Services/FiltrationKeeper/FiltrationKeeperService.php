<?php

namespace App\Services\FiltrationKeeper;

use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use Illuminate\Support\Facades\Session;

class FiltrationKeeperService implements FiltrationKeeper
{

    /**
     * @param string $entityClass
     * @param array $params
     * @return bool
     */
    public function saveParams($entityClass, $params)
    {
        Session::put($entityClass, $params);
        return true;
    }

    /**
     * @param string $entityClass
     * @param null $default
     * @return array
     */
    public function getParams($entityClass, $default = null)
    {
        return Session::get($entityClass, $default);
    }
}
