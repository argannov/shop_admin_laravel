<?php

namespace App\Services\Repository;


use App\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GoodsRepository extends BaseRepository
{
    /**
     * @inheritdoc
     */
    public function get($slug)
    {
        return Goods::where('id', '=', $slug)->first();
    }


    /**
     * @inheritdoc
     */
    public function all(Request $request = null)
    {
        $builder = Goods::query();

        if ($title = $request->get('title')) {
            $builder->where('title', 'like', '%'.$title.'%');
        }

        if ($category = $request->get('category')) {
            $builder->where('category', $category);
        }

        if ($updatedAt = $request->get('updated_at')) {
            list($startDate, $endDate) = array_map(function ($value) {
                return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $value)));
            }, explode(' - ', $updatedAt));

            $builder->whereBetween('updated_at', [$startDate, $endDate]);
        }

        if ($status = $request->get('status')) {
            $builder->where('status', $status);
        }

        if ($price = $request->get('price')) {
            $builder->where('price', $price);
        }

        $this->filtrationKeeper->saveParams(Goods::class, $request);

        return $this->paginate($builder, $request->get(self::CURRENT_PAGE_PARAM_NAME, 1));
    }

    /**
     * @inheritdoc
     */
    public function create(Request $request): bool
    {
        $goods = new Goods();
        $goods->title = $request->namegoods;
        $goods->slug = $request->sluggoods;
        $goods->article = $request->articulegoods;
        $goods->meta_keywords = $request->seokeywordgoods;
        $goods->meta_description = $request->seodescriptiongoods;
        $goods->price = $request->pricegoods;
        $goods->image_detail = $request->imagedetail;
        $goods->status = $request->statusgoods;
        $goods->body = $request->body;
        $goods->category = $request->categorygoods;

        $imgfile = $request->file('imageanons');
        $imgfileDetail = $request->file('imagedetail');
        $imgpath = public_path() . '/img/product';
        File::makeDirectory($imgpath, $mode = 0777, true, true);
        $imgDestinationPath = $imgpath . '/' . $request->articulegoods;
        if ($imgfile) {
            $ext1 = $imgfile->getClientOriginalExtension();
            $filename1 = uniqid('vid_') . '.' . $ext1;
            $goods->image_anons = $filename1;
            $imgfile->move($imgDestinationPath, $filename1);
        }
        if ($imgfileDetail) {
            $ext2 = $imgfileDetail->getClientOriginalExtension();
            $filename2 = uniqid('vid_') . '.' . $ext2;
            $goods->image_detail = $filename2;
            $imgfileDetail->move($imgDestinationPath, $filename2);
        }

        return $goods->save();
    }

    /**
     * @param Goods $model
     * @param Request $request
     * @return bool
     */
    public function update($model, Request $request): bool
    {
        $model->title = $request->namegoods;
        $model->slug = $request->sluggoods;
        $model->article = $request->articulegoods;
        $model->image_anons = $request->imageanons;
        $model->meta_keywords = $request->seokeywordgoods;
        $model->meta_description = $request->seodescriptiongoods;
        $model->price = $request->pricegoods;
        $imgfile = $request->file('imageanons');
        $imgfileDetail = $request->file('imagedetail');
        $imgpath = public_path() . '/img/product';
        File::makeDirectory($imgpath, $mode = 0777, true, true);
        $imgDestinationPath = $imgpath . '/' . $request->articulegoods;
        if ($imgfile) {
            $ext1 = $imgfile->getClientOriginalExtension();
            $filename1 = uniqid('vid_') . '.' . $ext1;
            $model->image_anons = $filename1;
            $imgfile->move($imgDestinationPath, $filename1);
        }
        if ($imgfileDetail) {
            $ext2 = $imgfileDetail->getClientOriginalExtension();
            $filename2 = uniqid('vid_') . '.' . $ext2;
            $model->image_detail = $filename2;
            $imgfileDetail->move($imgDestinationPath, $filename2);
        }
        $model->status = $request->statusgoods;
        $model->body = $request->body;
        $model->category = $request->categorygoods;

        return $model->save();
    }

    /**
     * @inheritdoc
     */
    public function delete($model): bool
    {
        $image_anons = $model->image_anons;
        $image_detail = $model->image_detail;
        $article = $model->article;
        if ($image_anons != null) {
            $pathAnons = $_SERVER['DOCUMENT_ROOT'] . '/img/product/' . $article . '/' . $image_anons;
            File::delete($pathAnons);
        }
        if ($image_detail != null) {
            $pathDetail = $_SERVER['DOCUMENT_ROOT'] . '/img/product/' . $article . '/' . $image_detail;
            File::delete($pathDetail);
        }

        return (bool)$model->delete();
    }
}
