@extends('layout.home')

@section('content')

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Available Activities</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">

            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="/uploads/{{ $product->image }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h5 class="text-truncate mb-3">
                            <a href="/product/{{ $product->id }}">{{ $product->product_name }}</a>
                        </h5>
                        <div class="d-flex justify-content-center">
                            <a href="/products/{{ $product->id_subcategory }}">{{ $product->subcategory->subcategory_name }}</a>
                        </div>

                        <br>
                        
                        <div class="d-flex justify-content-center">
                            <h6>{{ number_format($product->obtained)}} Points</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="/product/{{ $product->id }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <!-- Products End -->

    <!-- Testimonies -->

    <div id="header-carousel" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
    @foreach ($testimonis as $testimoni)

            <div class="carousel-item active" style="height: 300px;">
                <img class="img-fluid" src="/front/img/bl_sky.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">

                    <div class="p-3" style="max-width: 700px;">
                        <p class="display-4 text-white text-uppercase font-weight-semi-bold mb-4">{{ $testimoni->testimoni_name }}</p>
                        <span class="text-light font-weight-medium mb-3">{{ $testimoni->description }}</span>
                        
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>

    <!-- Testimonies -->
@endsection