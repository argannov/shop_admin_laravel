<?php


namespace App\Services\Repository;


use App\Orders;
use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use Illuminate\Http\Request;

class OrdersRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function get($slug)
    {
        return Orders::with('user')->find($slug);
    }

    /**
     * @inheritDoc
     */
    public function all(Request $request = null)
    {
        if (is_null($request)) {
            return Orders::with('users')->get();
        }

        $builder = Orders::with('user');

        if ($username = $request->get('name')) {
            $builder->whereHas('user', function ($query) use ($username) {
                $query->where('name', 'like', '%'.$username.'%');
            });
        }

        if ($email = $request->get('email')) {
            $builder->whereHas('user', function ($query) use ($email) {
                $query->where('email', 'like', '%'.$email.'%');
            });
        }

        if ($delivery_name = $request->get('delivery_name')) {
            $builder->where('delivery_name', $delivery_name);
        }

        if ($price = $request->get('price')) {
            $builder->where('price', $price);
        }

        $this->filtrationKeeper->saveParams(Orders::class, $request);

        return $this->paginate($builder, $request->get('currentPage', 1));
    }

    /**
     * @inheritDoc
     */
    public function create(Request $request): bool
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function update($model, Request $request): bool
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function delete($model): bool
    {
        return (bool) $model->delete();
    }
}
