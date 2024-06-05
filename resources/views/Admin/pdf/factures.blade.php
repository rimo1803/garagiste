<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Ajoutez ici le style CSS pour la facture */
    </style>
</head>
<body>
    <h1>Invoice</h1>
    <p>Invoice ID: {{ $invoice->id }}</p>
    <p>Repair ID: {{ $invoice->repairId }}</p>
    <p>Additional Charges: {{ $invoice->additionalCharges }}</p>
    <p>Total Amount: {{ $invoice->totalAmount }}</p>
</body>
</html>
