<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Catering;
use App\Models\Dish;
use App\Models\Image;
use App\Models\Location;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Promo;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $covers = Image::whereIsCover(true)->get();

        return view('home', compact('covers'));
    }

    public function menu(Category $category = null)
    {
        $groups = (optional($category)->dishes ?? Dish::all())->groupBy('category.title');

        $categories = Category::all();

        $promos = Promo::all();

        return view('menu', compact('groups', 'category', 'categories', 'promos'));
    }

    public function book()
    {
        $locations = Location::all();

        return view('book', compact('locations'));
    }

    public function blog(Request $request)
    {
        $posts = filled($category = $request->query('c'))
        ? PostCategory::findBySlugOrFail($category)->posts()->orderBy('created_at', 'desc')->get()
        : Post::forEveryone()->orderBy('created_at', 'desc')->get();

        $categories = PostCategory::all();

        return view('blog', compact('posts', 'categories'));
    }

    public function post(Post $post)
    {
        return view('post', compact('post'));
    }

    public function catering()
    {
        $caterings = Catering::all();

        return view('catering', compact('caterings'));
    }
}
