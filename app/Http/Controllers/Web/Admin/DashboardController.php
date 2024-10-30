<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ArticleRepositoryInterface;

class DashboardController extends Controller
{
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->getArticlesCountByDate();

        $labels = $articles->pluck('date');
        $data = $articles->pluck('count');

        return view('pages.admin.dashboard', compact('labels', 'data'));
    }
}
