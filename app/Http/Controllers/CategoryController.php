<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // リレーション先のcategoryテーブルの名前に一致する記事だけページネーション
        $posts = Post::with('category')
            // $categoryには、サイドバーで選択したカテゴリー変数が格納されている
            ->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category->name);
            })->paginate(1);
        
        return view('categories.show', ['category' => $category, 'posts' => $posts]);
    }
}
