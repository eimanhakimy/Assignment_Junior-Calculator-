<?php
// function akan ambil dari calculator.php untuk dapatkan function untuk calculate electricity
require_once 'calculator.php';
$voltage = $current = $rate = $hourlyEnergy = $hourlyTotal = $dailyEnergy = $dailyTotal = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voltage = $_POST["voltage"];
    $current = $_POST["current"];
    $rate = $_POST["rate"];

    [$hourlyEnergy, $hourlyTotal, $dailyEnergy, $dailyTotal] = calculateHour($voltage, $current, $rate);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assignment_Junior</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }

        .result-container,
        .result-summary {
            border: 1px solid blue;
            padding: 10px;
            margin-top: 30px;
            text-align: left;
            color: blue;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>TNB Electricity Calculator</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="voltage">Voltage (V):</label><br>
                <input type="number" name="voltage" step="0.01" required><br>
                <label>Voltage (v)</label>
            </div>
            <div class="form-group">
                <label for="current">Current (A):</label><br>
                <input type="number" name="current" step="0.01" required><br>
                <label>Ampere (A)</label>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate (RM):</label><br>
                <input type="number" name="rate" step="0.01" required><br>
                <label>sen/kWh</label>
            </div>
            <div class="form-group">
                <button type="submit" name="calculate" class="btn btn-primary">Calculate</button>
            </div>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <div class="result-container">
                <h3>Results (Per Hour)</h3>
                <p>Power: <?php echo number_format(calculatePower($voltage, $current), 2); ?> kW</p>
                <p>Rate: <?php echo number_format($rate / 100, 3); ?> RM</p>
            </div>

            <div class="result-summary">
                <h3>Daily Consumption (Per Day)</h3>
                <p>Total Energy (kWh): <?php echo $dailyEnergy; ?></p>
                <p>Total Charge (RM): <?php echo $dailyTotal; ?></p>
            </div>

            <div class="container result-table">
                <h3>Hourly Consumption</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hour</th>
                            <th>Energy (kWh)</th>
                            <th>Total (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($hour = 1; $hour <= 24; $hour++): ?>
                            <tr>
                                <td><?php echo $hour; ?></td>
                                <td><?php echo $hour; ?></td>
                                <td><?php echo $hourlyEnergy[$hour]; ?></td>
                                <td><?php echo $hourlyTotal[$hour]; ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</body>
</html>
