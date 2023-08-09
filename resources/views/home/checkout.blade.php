@extends('layout.home')

@section('title', 'Checkout')

@section('content')
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-5">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Order Details</h4>
                        </div>
                        
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-medium">Member name</h5>
                                <h5 class="font-weight-medium">{{ $orders->member->member_name }} </h5>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-medium">Binusian ID</h5>
                                <h5 class="font-weight-medium">{{ $orders->member->id_binusian }} </h5>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-medium">Major</h5>
                                <h5 class="font-weight-medium">{{ $orders->member->major }} </h5>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-medium">Request Total</h5>
                                <h5 class="font-weight-medium">{{ $orders->order_total }} Pts</h5>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-medium">Invoice</h5>
                                <h5 class="font-weight-medium">{{ $orders->invoice }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 card border-secondary mb-5">
                    <form name="checkout" class="checkout" method="POST" action="/payments">
                        @csrf
                        <input type="hidden" name="id_order" value="{{ $orders->id }}">

                        <div class="card-header bg-secondary border-1">
                            <h4 class="font-weight-semi-bold m-0">Request Activity</h4>
                        </div>
                        <div class="card-body">
                            <br>
                            <div class=" border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h6 class="font-weight">After placing request, you are required to meet the requirements (if any) for each activity in order to be approved.</h6>
                                </div>
                            </div>
                            <div class=" border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h6 class="font-weight">If there any difficulties please, contact the authorities.</h6>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="submit" name="checkout_place_request" class="text-light btn btn-block btn-primary my-3 py-3 checkout" id="place_request" value="Place Request">
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->
@endsection