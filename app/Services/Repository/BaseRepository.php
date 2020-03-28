<?php


namespace App\Services\Repository;


use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\Interfaces\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements Repository
{
    const DEFAULT_COUNT_PER_PAGE = 10;
    const CURRENT_PAGE_PARAM_NAME = 'currentPage';
    const COUNT_PER_PAGE_PARAM_NAME = 'countPerPage';
    const PAGINATION_PARAMS = [
        self::CURRENT_PAGE_PARAM_NAME,
        self::COUNT_PER_PAGE_PARAM_NAME
    ];

    /**
     * @var FiltrationKeeper
     */
    protected $filtrationKeeper;

    public function __construct(FiltrationKeeper $filtrationKeeper)
    {
        $this->filtrationKeeper = $filtrationKeeper;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $currentPage
     * @param int $countPerPage
     * @return Collection
     */
    protected function paginate($builder, $currentPage = 1, $countPerPage = self::DEFAULT_COUNT_PER_PAGE)
    {
        /** @var LengthAwarePaginator $pagination */
        $pagination = $builder->paginate($countPerPage, ['*'], 'Страница', $currentPage);
        /** @var Collection $collection */
        $collection = $pagination->getCollection();

        $previousPage = explode('=', $pagination->previousPageUrl())[1] ?? null;
        $nextPage = explode('=', $pagination->nextPageUrl())[1] ?? null;

        $collection->put('pagination', [
            'total' => $pagination->total(),
            'pages' => [
                'previous' => $previousPage ? intval($previousPage) : null,
                'current' => $pagination->currentPage(),
                'next' => $nextPage ? intval($nextPage) : null,
            ],
            'lastPage' => $pagination->lastPage()
        ]);

        return $collection;
    }
}
