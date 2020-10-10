<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>Lorem...</p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Width</h5>
                                </td>
                                <td>
                                    <h5>128mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Height</h5>
                                </td>
                                <td>
                                    <h5>508mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Depth</h5>
                                </td>
                                <td>
                                    <h5>85mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Weight</h5>
                                </td>
                                <td>
                                    <h5>52gm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Quality checking</h5>
                                </td>
                                <td>
                                    <h5>yes</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Freshness Duration</h5>
                                </td>
                                <td>
                                    <h5>03days</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>When packeting</h5>
                                </td>
                                <td>
                                    <h5>Without touch of hand</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Each Box contains</h5>
                                </td>
                                <td>
                                    <h5>60pcs</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row total_rate mb-4">
                            <div class="col-md-12">
                                @if( ($count = (count($product->comments))) > 0 )
                                <div class="box_total mb-4">
                                    <h5>Overall</h5>
                                    <div class="d-flex align-items-center justify-content-center my-2">
                                        <h5 class="text-warning">{{ $product->getRating() }}</h5>
                                        <i class="fa fa-star text-warning ml-1"></i>
                                    </div>
                                    <h6>({{ $count }} Reviews)</h6>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="review_list">
                            @php
                            $id = auth()->id();
                            @endphp

                            @forelse( $product->comments as $comment )
                            <div class="review_item">
                                <div class="media align-items-center">
                                    <div class="d-flex">
                                        <img src="{{ asset('img/product/review-1.png') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h4>{{ $comment->user->name }}</h4>
                                            <h4 class="text-warning ml-3">({{ $comment->rating }} <i class="fa fa-star"></i>)</h4>
                                        </div>

                                        <div>{{ $comment->created_at }}</div>
                                    </div>
                                    @if( $id == $comment->user->id )
                                    <div>
                                        <form method="POST" action="{{ route('comment.destroy', [$product->id, $comment->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                <p>{{ $comment->body }}</p>
                            </div>
                            @empty
                            <p class="text-center">No Reviews Yet...</p>
                            @endforelse

                        </div>
                    </div>

                    @can('add-review', $product->comments)
                    <div class="col-md-12 p-3 shadow-sm bg-light mt-5">
                        <div class="review_box">
                            <!-- ========================== Review Form ============================== -->
                            <form action="{{ route('comment.store', $product->id) }}" method="POST">
                                @csrf
                                <h4>Add a Review</h4>
                                <div class="form-group mb-0">
                                    <label for="body">Enter your Comment</label>
                                    <textarea required class="form-control" name="body" id="body" rows="5"></textarea>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="font-weight-bold">Pick a rating</div>
                                    <x-product.rating />
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Add Review</button>
                                </div>
                            </form>
                            <!-- ====================================================================== -->

                        </div>
                    </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</section>