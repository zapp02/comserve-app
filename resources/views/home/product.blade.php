@extends('layout.home')

@section('title', 'Activity')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="/uploads/{{ $product->image }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->product_name }}</h3>
                <br>
                <h4 class="font-weight-semi mb-4">{{ number_format($product->obtained)}} Points</h4>
                <p>Individual or Group (MAX 3 Person).</p>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Period:</p>
                    @php
                    $periods = explode(',',$product->period)
                    @endphp

                    @foreach ($periods as $period)
                    <div class="period custom-control custom-radio">
                        <input type="radio" id="{{ $period }}" name="periods" value="{{ $period }}" class="period">
                        <label for="{{ $period }}">{{ $period }}</label>
                    </div>

                    @endforeach
                </div>
                <div class=" quantity d-flex align-items-center mb-4 pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Quantity:</p>
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input name="qty" type="number" step="1" min="0" class="input-text text quantity form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <a href="#" class="add-to-cart"><span>Add to Cart</span></a>

                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Activity Description</h4>
                        <p>{{ $product->description }}.</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>This activity has terms and conditions in order to request and complete it</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        <h4 class="mb-3">Period</h4>
                                        <p>Students must complete the activity in between following dates : </p>
                                        <p>{{ $product->period }}</p>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <h4 class="mb-3">Location</h4>
                                        <p>The activity take a place in the following region :</p>
                                        <p>{{ $product->location }}</p>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <h4 class="mb-3">Requirements</h4>
                                        <p>Student must provide a few or specific data or document in order to able request it :</p>
                                        <p>{{ $product->requirements }}</p>
                                    </li>
                                  </ul> 
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "{{ $product->product_name }}"</h4>
                                <div class="media mb-4">
                                    <img src="/front/img/user.jpg" png="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3 review">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection

@push('js')
    <script>
        
        $(function() {
            
            $('.add-to-cart').click(function(){
                member_id = {{ Auth::guard('webmember')->user()->id }}
                id_product = {{ $product->id }}
                quantity = $('input[type=number][name="qty"]').val()
                period = $('input[name="periods"]:checked').val()
                total = {{ $product->obtained }}*quantity
                is_checkout = 0
                

                $.ajax({
                    url : '/add_to_cart',
                    method : "POST",
                    headers : {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                    },
                    data : {
                        member_id,
                        id_product,
                        quantity,
                        period,
                        total,
                        is_checkout,
                    },
                    success : function (data) {
                        window.location.href = '/cart'
                    }

                });
            })
        })
    </script>
@endpush