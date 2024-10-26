<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view ('pages.app.article.index');
    }

    public function show()
    {
        return view ('pages.app.article.show');
    }
}
