<!DOCTYPE html>
<html>
<head>
    <title>Electricity Calculation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Calculate</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="voltage">Voltage (V):</label>
                <input type="text" class="form-control" name="voltage" id="voltage" required>
            </div>
            <div class="form-group">
                <label for="current">Current (A):</label>
                <input type="text" class="form-control" name="current" id="current" required>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate:</label>
                <input type="text" class="form-control" name="rate" id="rate" required>
            </div>
            <div class="form-group">
                <label for="hours">Hours:</label>
                <input type="text" class="form-control" name="hours" id="hours" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voltage = $_POST["voltage"];
            $current = $_POST["current"];
            $rate = $_POST["rate"];
            $hours = $_POST["hours"];

            // Validate input
            if (isset($_POST["hours"]) && is_numeric($voltage) && is_numeric($current) && is_numeric($rate) && is_numeric($hours)) {
                // Call the function and get the result
                $energy = calculateEnergy($voltage, $current, $hours, $rate);

                // Display the result in a table
                echo "<h3 class='mt-4'>Calculation Result</h3>";
                echo "<table class='table table-bordered'>";
                echo "<thead class='thead-light'><tr><th>Voltage (V)</th><th>Current (A)</th><th>Rate</th><th>Hours of Usage</th><th>Energy Consumption (kWh)</th><th>Total Cost</th></tr></thead>";
                echo "<tbody><tr><td>$voltage</td><td>$current</td><td>$rate</td><td>$hours</td><td>$energy</td><td>" . ($energy * ($rate / 100)) . "</td></tr></tbody>";
                echo "</table>";
            } else {
                echo "<p class='mt-4 text-danger'>Invalid input. Please enter numeric values for voltage, current, rate, and hours of usage.</p>";
            }
        }

        function calculateEnergy($voltage, $current, $hours, $rate) {
            $power = $voltage * $current; // Calculate power in Watts
            $power_in_wh = $power * $hours; // Calculate power in Watt-hours
            $energy_in_kwh = $power_in_wh / 1000; // Convert to kilowatt-hours
            $total_energy = $energy_in_kwh * ($rate / 100); // Calculate total energy consumption

            return $total_energy;
        }
        ?>
    </div>
    
</body>
</html>
