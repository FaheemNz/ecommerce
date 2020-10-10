<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCommentRequest;
use App\Models\Product;
use App\Models\Comment;

class ProductCommentController extends Controller
{
    public function store(Product $product, ProductCommentRequest $request)
    {
        $product->addComment($request->validated());
        return redirect()->back()->with('success_message', 'Review added successfully...');
    }

    public function destroy(Product $product, Comment $comment)
    {
        $this->authorize('update', $comment);

        if ($comment->delete()) {
            return redirect()->back()->with('success_message', 'Review Deleted');
        }
    }
}
