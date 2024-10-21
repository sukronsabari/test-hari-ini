<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class PostsDatatablesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Post::query();

            return DataTables::of($model)
                ->addColumn('action', function ($row) {
                    $editUrl = route('posts.edit', $row->id);
                    $visitUrl = route('posts.show', $row->id);

                    return '
                        <div class="flex items-center gap-3">
                            <a href="'.$visitUrl.'" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none">Visit</a>
                            <a href="'.$editUrl.'" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none">Edit</a>
                            <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none delete-btn" data-id="'.$row->id.'">Delete</button>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

     public function odd(Request $request)
    {
        if ($request->ajax()) {
            $model = Post::whereRaw('id % 2 != 0'); // Mendapatkan post dengan ID ganjil

            return DataTables::of($model)
                ->addColumn('action', function ($row) {
                    $editUrl = route('posts.edit', $row->id);
                    $visitUrl = route('posts.show', $row->id);

                    return '
                        <div class="flex items-center gap-3">
                            <a href="'.$visitUrl.'" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none">Visit</a>
                            <a href="'.$editUrl.'" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none">Edit</a>
                            <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none delete-btn" data-id="'.$row->id.'">Delete</button>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function even(Request $request)
    {
        if ($request->ajax()) {
            $model = Post::whereRaw('id % 2 = 0'); // Mendapatkan post dengan ID genap

            return DataTables::of($model)
                ->addColumn('action', function ($row) {
                    $editUrl = route('posts.edit', $row->id);
                    $visitUrl = route('posts.show', $row->id);

                    return '
                        <div class="flex items-center gap-3">
                            <a href="'.$visitUrl.'" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none">Visit</a>
                            <a href="'.$editUrl.'" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none">Edit</a>
                            <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none delete-btn" data-id="'.$row->id.'">Delete</button>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
