<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goods;
use Illuminate\Support\Facades\File;

class NewGoodsController extends Controller
{
    //
    function index()
    {

        $goods = Goods::all();
        $count = 0;
        foreach ($goods as $itemGood){
            $count = $count + 1;
        }
        $arrayUtf = array('\u0410', '\u0430', '\u0411', '\u0431', '\u0412', '\u0432', '\u0413', '\u0433', '\u0414', '\u0434', '\u0415', '\u0435', '\u0401', '\u0451', '\u0416', '\u0436', '\u0417', '\u0437', '\u0418', '\u0438', '\u0419', '\u0439', '\u041a', '\u043a', '\u041b', '\u043b', '\u041c', '\u043c', '\u041d', '\u043d', '\u041e', '\u043e', '\u041f', '\u043f', '\u0420', '\u0440', '\u0421', '\u0441', '\u0422', '\u0442', '\u0423', '\u0443', '\u0424', '\u0444', '\u0425', '\u0445', '\u0426', '\u0446', '\u0427', '\u0447', '\u0428', '\u0448', '\u0429', '\u0449', '\u042a', '\u044a', '\u042b', '\u044b', '\u042c', '\u044c', '\u042d', '\u044d', '\u042e', '\u044e', '\u042f', '\u044f');
        $arrayCyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь', 'Э', 'э', 'Ю', 'ю', 'Я', 'я');
        $goods = str_replace($arrayUtf, $arrayCyr, json_encode($goods));
        $goods = json_decode($goods, true);
        //dd($goods);
        return view('admin.product.allProduct', ['goods' => $goods,'count'=>$count]);
    }

    function formProduct()
    {
        return view('admin.product.createProduct');
    }

    public function addProduct(Request $request)
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
        if($imgfile) {
            $ext1 = $imgfile->getClientOriginalExtension();
            $filename1 = uniqid('vid_') . '.' . $ext1;
            $goods->image_anons = $filename1;
            $imgfile->move($imgDestinationPath, $filename1);
        }
        if($imgfileDetail) {
            $ext2 = $imgfileDetail->getClientOriginalExtension();
            $filename2 = uniqid('vid_') . '.' . $ext2;
            $goods->image_detail = $filename2;
            $imgfileDetail->move($imgDestinationPath, $filename2);
        }
        $goods->save();
        return redirect('/admin/product');
    }

    public function editProduct($slug)
    {
        $goods = Goods::where('id', '=', $slug)->first();
        return view('admin.product.editProduct', ['good' => $goods]);
    }

    public function saveEditProduct($slug, Request $request)
    {
        $goods = Goods::where('id', '=', $slug)->first();
        $goods->title = $request->namegoods;
        $goods->slug = $request->sluggoods;
        $goods->article = $request->articulegoods;
        $goods->image_anons = $request->imageanons;
        $goods->meta_keywords = $request->seokeywordgoods;
        $goods->meta_description = $request->seodescriptiongoods;
        $goods->price = $request->pricegoods;
        $imgfile = $request->file('imageanons');
        $imgfileDetail = $request->file('imagedetail');
        $imgpath = public_path() . '/img/product';
        File::makeDirectory($imgpath, $mode = 0777, true, true);
        $imgDestinationPath = $imgpath . '/' . $request->articulegoods;
        if($imgfile) {
            $ext1 = $imgfile->getClientOriginalExtension();
            $filename1 = uniqid('vid_') . '.' . $ext1;
            $goods->image_anons = $filename1;
            $imgfile->move($imgDestinationPath, $filename1);
        }
        if($imgfileDetail) {
            $ext2 = $imgfileDetail->getClientOriginalExtension();
            $filename2 = uniqid('vid_') . '.' . $ext2;
            $goods->image_detail = $filename2;
            $imgfileDetail->move($imgDestinationPath, $filename2);
        }
        $goods->status = $request->statusgoods;
        $goods->body = $request->body;
        $goods->category = $request->categorygoods;
        $goods->save();
        return redirect('/admin/product');
    }

    public function deleteProduct($slug)
    {
        $goods = Goods::where('id', '=', $slug)->first();

        $image_anons = $goods->image_anons;
        $image_detail = $goods->image_detail;
        $article = $goods->article;
        if ($image_anons != null) {
            $pathAnons = $_SERVER['DOCUMENT_ROOT'].'/img/product/'.$article.'/'.$image_anons;
            File::delete($pathAnons);
        }
        if($image_detail != null){
            $pathDetail = $_SERVER['DOCUMENT_ROOT'].'/img/product/'.$article.'/'.$image_detail;
            File::delete($pathDetail);
        }
        $goods->delete();
        return redirect('/admin/product/');
    }
}
