<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::get();
        return view('dashboard.articles.index', compact('articles'));
    }

    public function create()
    {

        return view('dashboard.articles.create');
    }
    public function store(Request $request)
    {
        // return $request;
        //  $request->validate([
        //     'name_ar'=>'required',
        //     'name_en'=>'required',
        //     'body_ar'=>'required',
        //     'body_en'=>'required',]);

        // try {

        DB::beginTransaction();

        $data = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalName();
                $name = "article-" . uniqid() . ".$ext";
                $image->move(public_path('images/articles'), $name);
                $data[] = $name;
            }
        }

        Article::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
            'images' => $data,

        ]);

        DB::commit();
        return redirect(route('admin.articles.index'))->with(['success' => 'تم اضافة المقال بنجاح']);

        // } catch (\Exception $ex) {
        //     DB::rollback();
        //     return redirect()->route('admin.articles.index')->with(['error' => ' Error Please try again']);
        // }
    }
    public function edit(Article $article)
    {
        return view('dashboard.articles.edit')->with('article', $article);
    }
    public function update(Request $request, article $article)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',

        ], [
            'name_en.required' => 'الاسم مطلوب',
            'name_ar.required' => 'الاسم مطلوب',


        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalName();
                $name = "article-" . uniqid() . ".$ext";
                $image->move(public_path('images/articles'), $name);
                $data[] = $name;
            }
            $article->images = $data;
        }


        $article->name_ar = $request->name_ar;
        $article->name_en = $request->name_en;

        $article->body_ar = $request->body_ar;
        $article->body_en = $request->body_en;
        $article->save();
        return redirect(route('admin.articles.index'))->with(['success' => 'تم  تعديل المقال بنجاح']);
    }
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('admin.articles.index'))->with(['success' => 'تم   حذف المقال بنجاح']);
    }
}
