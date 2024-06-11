<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JsonController extends Controller
{
    public function index(Request $request)
    {
        // Fetch JSON data from the URL
        $response = Http::get('https://timesofindia.indiatimes.com/rssfeeds/-2128838597.cms?feedtype=json');
        $data = $response->json()['channel']['item'];

        // Convert array to collection
        $collection = collect($data);

        // Apply search filter
        $search = $request->input('search', '');
        if ($search) {
            $collection = $collection->filter(function ($item) use ($search) {
                return stripos($item['title'], $search) !== false;
            });
        }

        // Apply sorting
        $sortField = $request->input('sort', 'title');
        $sortDirection = $request->input('direction', 'asc');
        $collection = $collection->sortBy($sortField, SORT_NATURAL, $sortDirection === 'desc');

        // Paginate the data
        $perPage = 5;
        $currentPage = $request->input('page', 1);
        $currentPageItems = $collection->forPage($currentPage, $perPage);
        $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('json.index', [
            'data' => $paginatedItems,
            'search' => $search,
            'sort' => $sortField,
            'direction' => $sortDirection,
        ]);
    }
}
