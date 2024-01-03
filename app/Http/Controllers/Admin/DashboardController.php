<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $books_total = Book::all()->count();
        $bookCategories_total = BookCategory::all()->count();
        return view('admin.dashboard', [
            'books_total' => $books_total,
            'bookCategories_total' => $bookCategories_total
        ]);
    }
}
