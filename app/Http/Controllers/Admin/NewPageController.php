<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Pages;

class NewPageController extends Controller
{
    function index()
    {
        $page = Pages::all();
        $count = 0;
        foreach ($page as $itemPage){
            $count = $count + 1;
        }
        $arrayUtf = array('\u0410', '\u0430', '\u0411', '\u0431', '\u0412', '\u0432', '\u0413', '\u0433', '\u0414', '\u0434', '\u0415', '\u0435', '\u0401', '\u0451', '\u0416', '\u0436', '\u0417', '\u0437', '\u0418', '\u0438', '\u0419', '\u0439', '\u041a', '\u043a', '\u041b', '\u043b', '\u041c', '\u043c', '\u041d', '\u043d', '\u041e', '\u043e', '\u041f', '\u043f', '\u0420', '\u0440', '\u0421', '\u0441', '\u0422', '\u0442', '\u0423', '\u0443', '\u0424', '\u0444', '\u0425', '\u0445', '\u0426', '\u0446', '\u0427', '\u0447', '\u0428', '\u0448', '\u0429', '\u0449', '\u042a', '\u044a', '\u042b', '\u044b', '\u042c', '\u044c', '\u042d', '\u044d', '\u042e', '\u044e', '\u042f', '\u044f');
        $arrayCyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь', 'Э', 'э', 'Ю', 'ю', 'Я', 'я');
        $page = str_replace($arrayUtf, $arrayCyr, json_encode($page));
        $page = json_decode($page, true);

        //dd($page);
        return view("admin.pages.index", ["pages" => $page,'count'=>$count]);
    }

    function create()
    {
        return view("admin.pages.createpage");
    }

    public function createPost(Request $request)
    {

        //DB::insert('insert into pages (title, slug, body, image, meta_description, meta_keywords, status, created_at, updated_at, banners) values (?,?,?,?,?,?,?,?,?,?)', [$namepages, $slugpages, 0, 0, $seodescriptiongoods, $seokeywordgoods, $statusgoods, date('y-m-d H:i:s'), date('y-m-d H:i:s'), $encode]);
        $page = new Pages;
        $page->title = $request->namepages;
        $page->slug = $request->slugpages;
        $page->body = $request->contentpage;
        $page->image = $request->imagepage;
        $page->meta_description = $request->seodescriptiongoods;
        $page->meta_keywords = $request->seokeywordgoods;
        $page->status = $request->statusgoods;
        $imagesbanner = $request->imagesbanner;
        $imagebannerArr = array();
        $intArr = 0;
        foreach ($imagesbanner as $intArr => $imagebannerArrDate) {
            $imagebannerArr[$intArr]['image'] = $imagebannerArrDate;
            $intArr++;
        }
        $encode = json_encode($imagebannerArr);
        $page->banners = $encode;
        $page->save();
        return redirect('/admin/pages/');
    }

    public function onePage($slug)
    {
        if ($slug == 'glavnaya') {
            $slug = '/';
        }
        $page = Pages::where('id','=', $slug)->first();
        return view('admin.pages.editPage', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages,Request $request,$slug)
    {
        $page = Pages::where('id','=',$slug)->first();
        $page->title = $request->namepages;
        $page->slug = $request->slugpages;
        $page->body = $request->contentpage;
        $page->image = $request->imagepage;
        $page->meta_description = $request->seodescriptiongoods;
        $page->meta_keywords = $request->seokeywordgoods;
        $page->status = $request->statusgoods;
        $imagesbanner = $request->imagesbanner;
        $imagebannerArr = array();
        $intArr = 0;
        foreach ($imagesbanner as $intArr => $imagebannerArrDate) {
            $imagebannerArr[$intArr]['image'] = $imagebannerArrDate;
            $intArr++;
        }
        $encode = json_encode($imagebannerArr);
        $page->banners = $encode;
        $page->save();
        return redirect('/admin/pages/');
    }
    public function deletePage($slug,Request $request){
        $page = Pages::where('id','=',$slug);
        $page->delete();
        return redirect('/admin/pages/');
    }
}
