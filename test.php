<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Table</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .styled-table {
      width: 100%;
      border-collapse: collapse;
      margin: 25px 0;
      font-size: 18px;
      text-align: left;
    }

    .styled-table th,
    .styled-table td {
      padding: 12px 15px;
    }

    .styled-table thead tr {
      background-color: #751fff;
      color: #ffffff;
      text-align: left;
      font-weight: bold;
    }

    .styled-table tbody tr {
      border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f8;
    }

    .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #751fff;
    }

    .styled-table tbody tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <div class="table-container">
    <table class="styled-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Age</th>
          <th>Country</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>John Doe</td>
          <td>30</td>
          <td>USA</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Jane Smith</td>
          <td>25</td>
          <td>Canada</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Sam Johnson</td>
          <td>35</td>
          <td>Australia</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Lisa Brown</td>
          <td>28</td>
          <td>UK</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>