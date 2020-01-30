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
        if (is_null($request)) {
            return Promocods::all();
        }

        $builder = Promocods::query();

        if ($discount_name = $request->get('discount_name')) {
            $builder->where('discount_name', 'like', '%'.$discount_name.'%');
        }

        if ($active = $request->get('active')) {
            $builder->where('active', $active);
        }

        if ($coupon = $request->get('coupon')) {
            $builder->where('coupon', 'like', '%'.$coupon.'%');
        }

        if ($date_apply = $request->get('date_apply')) {
            list($startDate, $endDate) = array_map(function ($value) {
                return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $value)));
            }, explode(' - ', $date_apply));

            $builder->whereBetween('date_apply', [$startDate, $endDate]);
        }

        $this->filtrationKeeper->saveParams(Promocods::class, $request);

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
