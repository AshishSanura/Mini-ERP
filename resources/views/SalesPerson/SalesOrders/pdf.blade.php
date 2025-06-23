<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Order #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>
    <h2>Sales Order #{{ $order->id }}</h2>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
    <p><strong>Salesperson:</strong> {{ $order->user->name }}</p>

    <h4>Items</h4>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (₹)</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ $item->price }}</td>
                    <td>₹{{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right;">Total Amount: ₹{{ $order->total_amount }}</h3>
</body>
</html>
