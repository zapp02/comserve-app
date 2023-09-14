@extends('layout.home')

@section('title', 'My Payments and Order')

@section('content')
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-5">
                
                <h2>My Payment</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Date</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payment)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <h2>My Request</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Date</th>
                        <th>Request Total</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td>{{ $order->order_total }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Checkout End -->
@endsection