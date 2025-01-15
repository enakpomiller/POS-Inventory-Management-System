<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Matriculation Numbers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>


<div class="form-container">
    <h2>Generate Matriculation Numbers</h2>
    <form method="post" action="<?= site_url('products/generate') ?>"> 
        <!-- Adjust action URL to match your CodeIgniter controller -->
        <label for="year">Year (e.g., 2024):</label>
        <input type="text" name="year" id="year" placeholder="Enter year (e.g., 2024)" required>

        <label for="departments">Departments (Comma-separated, e.g., ARC,CSE,ENG):</label>
        <input type="text" name="departments" id="departments" placeholder="Enter department codes" required>

        <label for="studentsPerDept">Number of Students Per Department:</label>
        <input type="number" name="studentsPerDept" id="studentsPerDept" placeholder="Enter number of students" required>

        <button type="submit" class="btn btn-primary" >Generate Matriculation Numbers</button>
    </form>
</div>
    

<!-- Display Generated Numbers -->
<?php if (isset($matricNumbers) && !empty($matricNumbers)) : ?>
    <h3>Generated Matriculation Numbers</h3>
    <table class="table table-striped" style="width:50%" align="center">
        <thead>
            <tr>
                <th>Department</th>
                <th>Matriculation Number</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matricNumbers as $matricNumber) : ?>
                <tr>
                    <td><?= $matricNumber['department'] ?></td>
                    <td><?= $matricNumber['matric_number'] ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

   
<?php endif; ?>

</body>
</html>
