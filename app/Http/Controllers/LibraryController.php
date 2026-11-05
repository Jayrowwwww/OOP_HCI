<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    private array $resources = [
        ['title' => 'The Creative Act: A Way of Being', 'author' => 'Rick Rubin', 'type' => 'Book', 'category' => 'Books', 'meta' => '2023 · Penguin Press', 'color' => 'lavender', 'cover' => 'book', 'status' => 'Available'],
        ['title' => 'Designing Data-Intensive Applications', 'author' => 'Martin Kleppmann', 'type' => 'Book', 'category' => 'Books', 'meta' => '2017 · O’Reilly Media', 'color' => 'peach', 'cover' => 'data', 'status' => 'Available'],
        ['title' => 'The New Yorker Archive', 'author' => 'The New Yorker', 'type' => 'Article', 'category' => 'Research', 'meta' => 'Digital collection · 1925–today', 'color' => 'mint', 'cover' => 'archive', 'status' => 'Online'],
        ['title' => 'Introduction to Urban Ecology', 'author' => 'Nora Mills', 'type' => 'Research guide', 'category' => 'Research', 'meta' => 'Research guide · Updated this week', 'color' => 'blue', 'cover' => 'guide', 'status' => 'Online'],
        ['title' => 'Kind of Blue', 'author' => 'Miles Davis', 'type' => 'Music', 'category' => 'Digital media', 'meta' => 'Album · 1959 · 45 min', 'color' => 'indigo', 'cover' => 'music', 'status' => 'Stream'],
        ['title' => 'The Art of Looking', 'author' => 'Lena Hart', 'type' => 'eBook', 'category' => 'Books', 'meta' => 'eBook · 6 hours read', 'color' => 'rose', 'cover' => 'art', 'status' => 'Available'],
    ];

    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $resources = collect($this->resources)->take(4)->all();
        if ($query !== '') {
            $resources = collect($this->resources)->filter(fn ($item) => str_contains(strtolower(implode(' ', $item)), strtolower($query)))->values()->all();
        }

        return view('library.home', compact('resources', 'query'));
    }

    public function catalog(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', 'All resources'));
        $resources = collect($this->resources)->filter(function ($item) use ($query, $category) {
            $matchesQuery = $query === '' || str_contains(strtolower(implode(' ', $item)), strtolower($query));
            $matchesCategory = $category === 'All resources' || $item['category'] === $category || $item['type'] === $category;
            return $matchesQuery && $matchesCategory;
        })->values()->all();

        return view('library.catalog', compact('resources', 'query', 'category'));
    }

    public function login() { return view('library.auth', ['mode' => 'login']); }
    public function register() { return view('library.auth', ['mode' => 'register']); }
}
