<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class ReviewsController extends Controller
{
    /**
     * Display the reviews page.
     */
    public function ReviewsPage()
    {
        // Get approved reviews to display on the page
        $reviews = Review::with('images')
                   ->where('status', 'approved')
                   ->orderBy('created_at', 'desc')
                   ->get();
                    
        return view('reviews', compact('reviews'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        // Log the incoming request data
        \Log::info('Review submission received', [
            'has_files' => $request->hasFile('reviewImages'),
            'post_data' => $request->except(['reviewImages']),
            'files_count' => $request->hasFile('reviewImages') ? count($request->file('reviewImages')) : 0
        ]);
        
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'reviewerName' => 'required|string|max:255',
            'reviewerEmail' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'reviewTitle' => 'required|string|max:255',
            'reviewContent' => 'required|string',
            'reviewImages.*' => 'nullable|image|max:5120', // Max 5MB per image
        ]);

        if ($validator->fails()) {
            \Log::warning('Review validation failed', ['errors' => $validator->errors()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Create new review
            $review = new Review();
            $review->reviewer_name = $request->reviewerName;
            $review->reviewer_email = $request->reviewerEmail;
            $review->rating = $request->rating;
            $review->title = $request->reviewTitle;
            $review->content = $request->reviewContent;
            $review->status = 'pending'; // Default status is pending
            $review->user_id = Auth::check() ? Auth::id() : null;
            $review->save();
    
            // Handle image uploads
            if ($request->hasFile('reviewImages')) {
                \Log::info('Files detected in request: ' . count($request->file('reviewImages')));
                $images = $request->file('reviewImages');
                
                foreach ($images as $image) {
                    try {
                        \Log::info('Processing file: ' . $image->getClientOriginalName() . ', size: ' . $image->getSize());
                        $reviewImage = new ReviewImage();
                        $reviewImage->review_id = $review->id;
                        
                        // Get file contents
                        $imageContents = file_get_contents($image->getRealPath());
                        \Log::info('Read image contents, size: ' . strlen($imageContents) . ' bytes');
                        
                        $reviewImage->image = $imageContents;
                        $reviewImage->filename = $image->getClientOriginalName();
                        $reviewImage->mime_type = $image->getMimeType();
                        
                        if ($reviewImage->save()) {
                            \Log::info('Image saved successfully with ID: ' . $reviewImage->id);
                        } else {
                            \Log::error('Failed to save image');
                        }
                    } catch (\Exception $e) {
                        \Log::error('Error processing image: ' . $e->getMessage());
                    }
                }
            } else {
                \Log::warning('No files found in request');
            }

            return response()->json([
                'success' => true, 
                'message' => 'Your review has been submitted and is pending approval.',
                'review_id' => $review->id
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error saving review: ' . $e->getMessage());
            return response()->json(['errors' => ['general' => 'An error occurred while saving your review.']], 500);
        }
    }
    
    /**
     * Get a review image from the database.
     */
    public function getReviewImage($id)
    {
        try {
            $image = ReviewImage::findOrFail($id);
            
            // Log some info for debugging
            \Log::info("Serving image ID: $id, Filename: {$image->filename}, MIME: {$image->mime_type}, Size: " . strlen($image->image) . " bytes");
            
            return Response::make($image->image, 200, [
                'Content-Type' => $image->mime_type,
                'Content-Disposition' => 'inline; filename="' . $image->filename . '"',
            ]);
        } catch (\Exception $e) {
            \Log::error("Error serving image ID: $id - " . $e->getMessage());
            abort(404);
        }
    }
}
