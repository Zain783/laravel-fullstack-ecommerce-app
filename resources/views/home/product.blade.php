<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>

        <div class="row">
            @foreach ($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details', $products->id) }}" class="option1">
                                    Product details
                                </a>

                                <form action="{{ url('add_cart', $products->id) }}" method="POST">
                                    @csrf
                                    <div class="row pt-3">
                                        <div class="col-md-4"><input type="number" name="quantity" value="1"
                                                style="width: 100px;" min="1" max="{{ $products->quantity }}">
                                        </div>
                                        <div class="col-md-4"><input style="border-radius: 15px;" type="submit"
                                                name="" value="Add To Cart"></div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="img-box">
                            <img src="{{ url('product/' . $products->image) }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>
                                {{ $products->title }}
                            </h6>
                            @if ($products->discount_price != null)
                                <h6 style="color: red;">Discount Price <br>
                                    ${{ $products->discount_price }}
                                </h6>
                                <h6 style="text-decoration: line-through; color:blue;">
                                    Price <br>
                                    ${{ $products->price }}
                                </h6>
                            @else
                                <h6> Price <br>
                                    ${{ $products->price }}
                                </h6>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <span style="padding-top:20px;"></span>
        {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>
</section>
