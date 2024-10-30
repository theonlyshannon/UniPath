<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ArticleTagRepositoryInterface;
use App\Interfaces\ArticleVisitorRepositoryInterface;

class DashboardController extends Controller
{
    private $articleVisitorRepository;
    private $articleTagRepository;

    public function __construct(ArticleVisitorRepositoryInterface $articleVisitorRepository, ArticleTagRepositoryInterface $articleTagRepository)
    {
        $this->articleVisitorRepository = $articleVisitorRepository;
        $this->articleTagRepository = $articleTagRepository;
    }

    public function index()
    {
        $tagsData = $this->articleTagRepository->getArticleCountByTag();

        $visitors = $this->articleVisitorRepository->getVisitorCountsByDate();

        $articleDate = $visitors->pluck('date');
        $dataVisitor = $visitors->pluck('count');

        $labels = $tagsData->pluck('name'); // Nama tag
        $data = $tagsData->pluck('articles_count'); // Jumlah artikel per tag

        return view('pages.admin.dashboard', compact('articleDate', 'dataVisitor','labels', 'data'));
    }
}
