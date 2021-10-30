<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedBackRequest;
use App\Models\Idea;


class FeedBackController extends Controller
{
    
    public function create()
    {
        return view('page.feedback');
    }

    public function store(FeedBackRequest $request)
    {
        Idea::create($request->all());
        return redirect()->route('page.index')->with('success', 'Cảm ơn bạn đã góp ý');
    }
    
}
