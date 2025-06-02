<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }
        .hotel-name {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 10px;
        }
        .receipt-title {
            font-size: 20px;
            color: #4a5568;
            margin-bottom: 5px;
        }
        .receipt-number {
            color: #718096;
            font-size: 14px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .label {
            color: #718096;
            font-size: 14px;
            margin-bottom: 3px;
        }
        .value {
            font-weight: 500;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
            border-top: 2px solid #eee;
            padding-top: 20px;
        }
        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #2d3748;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="hotel-name">Hotel Management System</div>
        <div class="receipt-title">Booking Receipt</div>
        <div class="receipt-number">Receipt #{{ $booking->id }}</div>
    </div>

    <div class="section">
        <div class="section-title">Room Information</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="label">Room Type</div>
                <div class="value">{{ $booking->room->type }}</div>
            </div>
            <div class="info-item">
                <div class="label">Room Name</div>
                <div class="value">{{ $booking->room->name }}</div>
            </div>
            <div class="info-item">
                <div class="label">Capacity</div>
                <div class="value">{{ $booking->room->capacity }} persons</div>
            </div>
            <div class="info-item">
                <div class="label">Price per Night</div>
                <div class="value">${{ number_format($booking->room->price, 2) }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Booking Details</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="label">Check-in Date</div>
                <div class="value">{{ $booking->check_in_date->format('M d, Y') }}</div>
            </div>
            <div class="info-item">
                <div class="label">Check-out Date</div>
                <div class="value">{{ $booking->check_out_date->format('M d, Y') }}</div>
            </div>
            <div class="info-item">
                <div class="label">Number of Guests</div>
                <div class="value">{{ $booking->guests }} persons</div>
            </div>
            <div class="info-item">
                <div class="label">Booking Status</div>
                <div class="value">{{ ucfirst($booking->status) }}</div>
            </div>
        </div>
    </div>

    @if($booking->special_requests)
    <div class="section">
        <div class="section-title">Special Requests</div>
        <div class="info-item">
            <div class="value">{{ $booking->special_requests }}</div>
        </div>
    </div>
    @endif

    <div class="total-section">
        <div class="label">Total Amount</div>
        <div class="total-price">${{ number_format($booking->total_price, 2) }}</div>
    </div>

    <div class="footer">
        <p>Thank you for choosing our hotel!</p>
        <p>This is a computer-generated receipt and does not require a signature.</p>
        <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    </div>
</body>
</html> 