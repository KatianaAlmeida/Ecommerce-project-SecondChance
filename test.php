<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        .styled-table th, .styled-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .styled-table th {
            background-color: #f2f2f2;
            border-bottom: 2px solid #ddd;
        }
        .styled-table tr:hover {
            background-color: #f5f5f5;
        }
        .expand-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Order Number</th>
                <th>Status</th>
                <th>Price</th>
                <th>Order Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2024-05-29</td>
                <td>secondchange1799</td>
                <td></td>
                <td>850</td>
                <td><button class="expand-button">Expand</button></td>
            </tr>
            <tr>
                <td>2024-05-30</td>
                <td>secondchange9541</td>
                <td></td>
                <td>500</td>
                <td><button class="expand-button">Expand</button></td>
            </tr>
            <tr>
                <td>2024-05-30</td>
                <td>secondchange7553665842b7ab75d</td>
                <td></td>
                <td>230</td>
                <td><button class="expand-button">Expand</button></td>
            </tr>
            <tr>
                <td>2024-05-30</td>
                <td>secondchange7261665845c7b54b0</td>
                <td></td>
                <td>115</td>
                <td><button class="expand-button">Expand</button></td>
            </tr>
            <tr>
                <td>2024-05-30</td>
                <td>secondchange8100665846125b0a9</td>
                <td></td>
                <td>98</td>
                <td><button class="expand-button">Expand</button></td>
            </tr>
        </tbody>
    </table>
</body>
</html>