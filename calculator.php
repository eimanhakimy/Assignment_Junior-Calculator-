<?php
// Fomula untuk Power
function CalculatePower($voltage, $current) {
    return ($voltage * $current) / 1000;
}

// fomula untuk total , energy
function CalculateHour($voltage, $current, $rate) {
    $hourlyEnergy = [];
    $hourlyTotal = [];
    $dailyEnergy = 0;
    $dailyTotal = 0;

    for ($hour = 1; $hour <= 24; $hour++) {
        $power = CalculatePower($voltage, $current);

        // untuk calculate current hour
        $energy = $power * $hour;
        $hourlyEnergy[$hour] = number_format($energy, 5);

        // untuk calculate total untuk current hour
        $total = $energy * ($rate / 100);
        $hourlyTotal[$hour] = number_format($total, 2);

        // untuk calculate energy dan total untuk per day
        $dailyEnergy += $energy;
        $dailyTotal += $total;
    }

    $dailyEnergy = number_format($dailyEnergy, 5);
    $dailyTotal = number_format($dailyTotal, 2);

    return [$hourlyEnergy, $hourlyTotal, $dailyEnergy, $dailyTotal];
}
?>
