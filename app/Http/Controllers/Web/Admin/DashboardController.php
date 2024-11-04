<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\ArticleTagRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\ArticleVisitorRepositoryInterface;

class DashboardController extends Controller
{
    private $articleVisitorRepository;
    private $articleTagRepository;
    protected $studentRepository;
    protected $transactionRepository;

    public function __construct(
        ArticleVisitorRepositoryInterface $articleVisitorRepository,
        ArticleTagRepositoryInterface $articleTagRepository,
        StudentRepositoryInterface $studentRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->articleVisitorRepository = $articleVisitorRepository;
        $this->articleTagRepository = $articleTagRepository;
        $this->studentRepository = $studentRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        // Article Data
        $tagsData = $this->articleTagRepository->getArticleCountByTag();
        $visitors = $this->articleVisitorRepository->getVisitorCountsByDate();

        // Student Data
        $registrations = $this->studentRepository->getStudentData();
        $activeStudentsByDay = $this->studentRepository->getActiveStudentsByDay();

        // Transaction Data
        $monthlyTransactions = $this->transactionRepository->getMonthlyTransaction();
        $classSales = $this->transactionRepository->getMonthlyTransaction();

        // Prepare Article Data
        $tagLabels = $tagsData->pluck('name');
        $tagData = $tagsData->pluck('articles_count');
        $articleDate = $visitors->pluck('date');
        $dataVisitor = $visitors->pluck('count');

        // Prepare Student Data
        $studentLabels = $registrations->pluck('date')->toArray();
        $studentData = $registrations->pluck('count')->toArray();
        $activeDates = $activeStudentsByDay->pluck('date')->toArray();
        $activeCounts = $activeStudentsByDay->pluck('count')->toArray();

        // Prepare Transaction Data
        $months = $monthlyTransactions->pluck('month')->toArray();
        $transactionCounts = $monthlyTransactions->pluck('transaction_count')->toArray();
        $totalAmounts = $monthlyTransactions->pluck('total_amount')->toArray();

        // Prepare Class Sales Data
        $courseNames = $classSales->pluck('course_name')->toArray();
        $quantities = $classSales->pluck('total_quantity')->toArray();

        return view('pages.admin.dashboard', compact(
            'articleDate', 'dataVisitor', 'tagLabels', 'tagData',
            'studentLabels', 'studentData', 'activeDates', 'activeCounts',
            'months', 'transactionCounts', 'totalAmounts',
            'courseNames', 'quantities'
        ));
    }
}
