<!DOCTYPE html>
<html>
<head><title>Invoice</title></head>
<body>
    <h2>Sales Order #{{ $salesOrder->id }}</h2>
    <p>Customer: {{ $salesOrder->customer_name }}</p>
    <p>Total: ₹{{ $salesOrder->total_amount }}</p>

    <table border="1" cellpadding="5">
        <thead>
            <tr><th>Product</th><th>Qty</th><th>Price</th></tr>
        </thead>
        <tbody>
            @foreach ($salesOrder->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->pivot->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
