<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ArticleVisitorRepositoryInterface;

class DashboardController extends Controller
{
    private $articleVisitorRepository;

    public function __construct(ArticleVisitorRepositoryInterface $articleVisitorRepository)
    {
        $this->articleVisitorRepository = $articleVisitorRepository;
    }

    public function index()
    {
        $visitors = $this->articleVisitorRepository->getVisitorCountsByDate();

        $labels = $visitors->pluck('date');   
        $data = $visitors->pluck('count');

        return view('pages.admin.dashboard', compact('labels', 'data'));
    }
}
