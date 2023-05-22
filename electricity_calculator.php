<!DOCTYPE html>
<html>
<head>
    <title>Assignment_Junior</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .result-container {
            margin-top: 20px;
            border: 1px solid blue;
            padding: 10px;
            color: blue;
            font-size: 30px;
            font-weight: bold;
        }
        .result-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>TNB Electricity Calculator</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="voltage">Voltage (V):</label>
                <input type="number" class="form-control" id="voltage" name="voltage" required>
                <label>Voltage (V)</label>
            </div>
            <div class="form-group">
                <label for="current">Current (A):</label>
                <input type="number" step="any" class="form-control" id="current" name="current" required>
                <label>Ampere (A)</label>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate:</label>
                <input type="number" step="any" class="form-control" id="rate" name="rate" required>
                <label>sen/kWh</label>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $voltage = $_POST["voltage"];
        $current = $_POST["current"];
        $rate = $_POST["rate"];
        
        // untuk ubah watt ke Kwatt kena letak /1000.
        // calculation fomula untuk power
        $power = ($voltage * $current) / 1000;

        // untuk calculate energy and total charge untuk setiap jam.
        $hourlyEnergy = $hourlyTotal = [];

        for ($hour = 1; $hour <= 24; $hour++) {
            $energy = $power * $hour;
            $total = $energy * ($rate / 100);
            $hourlyEnergy[$hour] = number_format($energy, 5);
            $hourlyTotal[$hour] = number_format($total, 2);
        }
    ?>
    
    <div class="container result-container">
        <h3>Results</h3>
        <p>Power: <?php echo $power; ?> kW</p>
        <p>Rate: RM <?php echo $rate; ?></p>
    </div>


    <div class="container result-table">
        <h3>Hourly Consumption</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Hour</th>
                    <th>Energy (kWh)</th>
                    <th>Total (RM)</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                // untuk table 
                for ($hour = 1; $hour <= 24; $hour++): 
                ?>
                <tr>
                    <td><?php echo $hour; ?></td>
                    <td><?php echo number_format($power * $hour, 5); ?></td>
                    <td>RM <?php echo number_format(($power * $hour) * ($rate / 100), 2); ?></td>
                </tr>

                <?php 
              endfor; 
              ?>
              
            </tbody>
        </table>
    </div>
    <?php } ?>

</body>
</html>
