<?php

namespace App\Http\Controllers\Api\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ArticleController extends Controller
{
    public function index()
    {
        $articles=Article::select('id','name_'.app()->getLocale() .' as name','body_'.app()->getLocale() .' as body','images','created_at',
        )->get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'articles'=>$articles,
            ));
    }
    //    public function views(Request $request)
    // {
    //     $count=ArticleView::where('user_id',Auth::guard('user-api')->user()->id)->where('article_id',$request->article_id)->count();
    //     if($count==0)
    //     {
    //         ArticleView::create([
    //             'article_id'=>$request->article_id,
    //             'user_id'=>Auth::guard('user-api')->user()->id,
    //             ]);
    //         $article=Article::where('id',$request->article_id)->first();
    //         $article->num_of_views+=1;
    //         $article->save();
    //         return Response::json(array(
    //             'status'=>200,
    //             'message'=>'done',
    //             ));
    //     }
    //     return Response::json(array(
    //         'status'=>200,
    //         'message'=>'viewed_before',
    //         ));
    // }
}
