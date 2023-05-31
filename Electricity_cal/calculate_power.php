<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h2>Calculate : </h2>
    <form id="electricityForm">
      <div class="form-group">
        <label for="voltage">Voltage (V):</label>
        <input type="number" class="form-control" id="voltage" required>
      </div>
      <div class="form-group">
        <label for="current">Current (A):</label>
        <input type="number" class="form-control" step ="any" id="current" required>
      </div>
      <div class="form-group">
        <label for="hour">Hours:</label>
        <input type="number" class="form-control" id="hour" required>
      </div>
      <div class="form-group">
        <label for="rate">Current Rate:</label>
        <input type="number" class="form-control" step ="any" id="rate" required>
      </div>
      <button type="submit" class="btn btn-primary">Calculate</button>
    </form>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>Hour</th>
          <th>Power (Wh)</th>
          <th>Energy (kWh)</th>
          <th>Total (RM)</th>
        </tr>
      </thead>
      <tbody id="resultTable">
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function() {
      $('#electricityForm').submit(function(e) {
        e.preventDefault();
        
        var voltage = parseFloat($('#voltage').val()); 
        var current = parseFloat($('#current').val());
        var hour = parseFloat($('#hour').val());
        var rate = parseFloat($('#rate').val());

        /* Condition of electricity calculation */ 

        var power = (voltage * current).toFixed(2);
        var energy = ((power * hour) / 1000).toFixed(2); // 2 decimal point
        var total = (energy * (rate / 100)).toFixed(2);

        /* display result in table created */

        var resultRow = '<tr><td>' + hour + '</td><td>' + power + '</td><td>' + energy + '</td><td>' + total + '</td></tr>';
        $('#resultTable').html(resultRow);
      });
    });
  </script>
</body>
</html>
