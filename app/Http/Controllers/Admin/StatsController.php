<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalItems = Item::count();
        $totalCategories = Category::count();

        $itemsByStatus = Item::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.stats.index', compact('totalUsers', 'totalItems', 'totalCategories', 'itemsByStatus', 'recentUsers'));
    }
}
