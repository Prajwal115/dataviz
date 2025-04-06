
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Options</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
 
</head>
<body>
    <div class="chart-options-container">
        <p>Plot a</p>
        <select id="graph_type">
            <option value="bar">Bar Graph</option>
            <option value="line">Line Graph</option>
            <option value="scatter">Scatter Plot</option>
        </select>
        <p>with X:</p>
        <select id="x_axis">
            <option value="year">Year</option>
            <option value="month">Month</option>
            <option value="date">Date</option>
        </select>
        <p>and Y:</p>
        <select id="y_axis">
            <option value="sales">Sales</option>
            <option value="revenue">Revenue</option>
            <option value="profit">Profit</option>
        </select>
    </div>
</body>
</html>
