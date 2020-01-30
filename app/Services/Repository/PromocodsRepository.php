<?php


namespace App\Services\Repository;


use App\Promocods;
use Illuminate\Http\Request;

class PromocodsRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function get($slug)
    {
        return Promocods::find($slug);
    }

    /**
     * @inheritDoc
     */
    public function all(Request $request = null)
    {
        $builder = Promocods::query();

        return $this->paginate($builder, $request->get(self::CURRENT_PAGE_PARAM_NAME));
    }

    /**
     * @inheritDoc
     */
    public function create(Request $request): bool
    {
        $promo = Promocods::create($request->post());

        return $promo->save();
    }

    /**
     * @inheritDoc
     */
    public function update($model, Request $request): bool
    {
        return $model->update($request->post());
    }

    /**
     * @inheritDoc
     */
    public function delete($model): bool
    {
        return (bool) $model->delete();
    }
}
