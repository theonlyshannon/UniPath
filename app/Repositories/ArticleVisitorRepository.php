<?php
namespace App\Repositories;

use App\Interfaces\ArticleVisitorRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 *
 * implements the ArticleVisitorRepositoryInterface and provides methods to interact with article visitor data.
 */
class ArticleVisitorRepository implements ArticleVisitorRepositoryInterface
{
    /**
     * Retrieve visitor counts grouped by date.
     *
     * This method queries the 'article_visitors' table to get the count of visitors for each date.
     * It returns a collection of results, where each result contains the date and the corresponding visitor count.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getVisitorCountsByDate()
    {
        return DB::table('article_visitors')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }
}
