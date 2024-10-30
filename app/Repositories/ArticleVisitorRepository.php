<?php
namespace App\Repositories;
use App\Interfaces\ArticleVisitorRepositoryInterface;
use Illuminate\Support\Facades\DB;
class ArticleVisitorRepository implements ArticleVisitorRepositoryInterface
{
    public function getVisitorCountsByDate()
    {
        return DB::table('article_visitors')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }
}
