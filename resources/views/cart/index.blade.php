@extends('layout')

@section('content')
<div class="container">
    <div class="row py-4">
        <div class="col-md-6 offset-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product List</h5>
                    <ul class="list-group">
                           <h2>Your Cart</h2>

                    @if (count($cart) > 0)
                        <table border="1" cellpadding="10">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($cart as $item)
                                    @php
                                        $subtotal = $item['price'] * $item['qty'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ number_format($item['price'], 2) }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>{{ number_format($subtotal, 2) }}</td>
                                        <td colspan="5" align="right">
                                            <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-danger">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" align="right"><strong>Total:</strong></td>
                                    <td><strong>{{ number_format($total, 2) }}</strong></td>
                                </tr>

                            </tbody>
                        </table>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
