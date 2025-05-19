<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;
use App\Services\ReviewService;
use App\Models\Review;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $reviews = Review::paginate(6);
        return view('review.review', ['reviews' => $reviews]);
    }

    public function store(StoreReviewRequest $request)
    {
        $this->reviewService->create($request->validated());
        return redirect('/review');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
