<body>
    <h1>Orders Report</h1>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2 {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
    
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Food id and Count</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        <ul>
                            @foreach ($order->foods as $food)
                                <li>
                                    Food ID: {{ $food['food_id'] }}, Count: {{ $food['count'] }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <h2>Total Sum: {{$totalSum}}</h2>
</body>