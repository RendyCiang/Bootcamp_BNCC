<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>User Invoices</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Your Invoices</h2>
        @if($invoices->isEmpty())
            <p>You have no invoices.</p>
        @else
            @foreach($invoices as $invoice)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Invoice Number: {{ $invoice->invoice_number }}</h5>
                        <p class="card-text"><strong>Address:</strong> {{ $invoice->address }}</p>
                        <p class="card-text"><strong>Postal Code:</strong> {{ $invoice->postal_code }}</p>
                        <h6>Items:</h6>
                        <ul>
                            @foreach($invoice->invoiceItems as $item)
                                <li>{{ $item->product->name }} - {{ $item->quantity }} pcs - Rp {{ number_format($item->total_price, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                        <h6>Total Price: Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</h6>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
