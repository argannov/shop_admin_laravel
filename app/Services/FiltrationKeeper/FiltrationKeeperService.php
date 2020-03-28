<?php

namespace App\Services\FiltrationKeeper;

use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FiltrationKeeperService implements FiltrationKeeper
{

    /**
     * @param string $entityClass
     * @param Request $request
     * @return bool
     */
    public function saveParams($entityClass, $request)
    {
        Session::put($entityClass, $request->except(BaseRepository::PAGINATION_PARAMS));
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
