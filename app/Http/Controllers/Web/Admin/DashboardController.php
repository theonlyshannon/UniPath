<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\ArticleTagRepositoryInterface;
use App\Interfaces\ArticleVisitorRepositoryInterface;

class DashboardController extends Controller
{
    private $articleVisitorRepository;
    private $articleTagRepository;
    protected $studentRepository;

    public function __construct(ArticleVisitorRepositoryInterface $articleVisitorRepository, ArticleTagRepositoryInterface $articleTagRepository, StudentRepositoryInterface $studentRepository)
    {
        $this->articleVisitorRepository = $articleVisitorRepository;
        $this->articleTagRepository = $articleTagRepository;
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $tagsData = $this->articleTagRepository->getArticleCountByTag();
        $visitors = $this->articleVisitorRepository->getVisitorCountsByDate();
        $registrations = $this->studentRepository->getStudentData();

        $studentLabels = $registrations->pluck('date')->toArray();
        $studentData = $registrations->pluck('count')->toArray();

        $articleDate = $visitors->pluck('date');
        $dataVisitor = $visitors->pluck('count');

        $tagLabels= $tagsData->pluck('name');
        $tagData = $tagsData->pluck('articles_count');

        return view('pages.admin.dashboard', compact('articleDate', 'dataVisitor','tagLabels', 'tagData', 'studentLabels', 'studentData'));
    }
}
