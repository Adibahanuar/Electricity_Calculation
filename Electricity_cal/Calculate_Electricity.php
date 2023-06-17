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
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

         <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voltage = $_POST["voltage"];
            $current = $_POST["current"];
            $rate = $_POST["rate"];

            // Validate input
            if (is_numeric($voltage) && is_numeric($current) && is_numeric($rate)) {
                // Display the result in a table
                echo "<h3 class='mt-4'>Calculation Result</h3>";
                echo "<table class='table table-bordered'>";
                echo "<thead class='thead-light'><tr><th>#</th><th>Hours</th><th>Energy (kWh)</th><th>Total Cost (RM)</th></tr></thead>";
                echo "<tbody>";
                
                // Calculate and display the result for each hour
                for ($i = 1; $i <= 24; $i++) {
                    $energy = calculateEnergy($voltage, $current, $i, $rate);
                    $totalCost = calculateTotalCost($energy, $rate);

                    echo "<tr><td>$i</td><td>$i</td><td>" . ($energy) . "</td><td>" . number_format($totalCost, 2) . 
                    "</td></tr>";
                }
                
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p class='mt-4 text-danger'>Invalid input. Please enter numeric values for voltage, current, and rate.</p>";
            }
        }

        function calculateEnergy($voltage, $current, $hours, $rate) {
            $power = $voltage * $current; // Calculate power in Watts
            $energy_in_wh = $power * $hours; // Calculate energy in Watt-hours
            $energy_in_kwh = $energy_in_wh / 1000; // Convert to kilowatt-hours
            $total_energy = $energy_in_kwh * ($rate / 100); // Convert to kilowatt-hours

            return $energy_in_kwh;
        }

        function calculateTotalCost($energy, $rate) {
            return $energy * ($rate / 100);
        }
        ?>
    </div>
</body>
</html>
