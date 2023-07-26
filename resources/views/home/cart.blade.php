@extends('layout.home')

@section('title', 'Cart')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <form class="form-cart">
            <input type="hidden" name="member_id" value="{{ Auth::guard('webmember')->user()->id }}">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Activity</th>
                                <th>Obtained</th>
                                <th>Period</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">

                            @foreach ($carts as $cart)
                            <input type="hidden" name="id_product[]" value="{{ $cart->product->id }}">
                            <input type="hidden" name="quantity[]" value="{{ $cart->quantity }}">
                            <input type="hidden" name="period[]" value="{{ $cart->period }}">
                            <input type="hidden" name="total[]" value="{{ $cart->total }}">

                            <tr>
                                <td class="align-middle"><img src="/uploads/{{ $cart->product->image }}" alt="" style="width: 50px;"> {{ $cart->product->product_name }}</td>
                                <td class="align-middle">{{ $cart->product->obtained }}</td>
                                <td class="align-middle">{{ $cart->period }}</td>
                                <td class="align-middle">{{ $cart->quantity }}</td>
                                <td class="align-middle">{{ $cart->total }}</td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-primary">
                                        <a href="/delete_from_cart/{{ $cart->id }}"></a>
                                            <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Points Obtained</h6>
                                <h6 class="font-weight-medium cart-total">{{ $cart_total }} Pts</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Order Total</h6>
                                <td>
                                    <input type="hidden" name="order_total" class="order_total">
                                    <h6 class="font-weight-heavy order-total"> {{ $cart_total }}Pts</h6>
                                </td>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                            </div>
                            <div>
                                <a href="#" class="text-light btn btn-block btn-primary my-3 py-3 checkout">Proceed to Request</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Cart End -->
@endsection

@push('js')
<script>
    $(function(){
        $('.checkout').click(function(e){
            e.preventDefault()
            $.ajax({
                url : '/checkout_orders',
                method : 'POST',
                data : $('.form-cart').serialize(),
                headers : {
                    'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                },
                success : function(){
                    location.href = '/checkout'
                }
            })
        })
    });
</script>
@endpush
