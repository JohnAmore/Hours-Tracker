<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">

</head>

<script>
    // This determines the .php file that we're redirected to based on the button that's clicked. It also prepares the data we're gonna send.
    function handleFormSubmit(action) {
        const form = document.getElementById('tableForm');
        form.action = action;

        // Get selected rows data
        const selectedRowsData = getSelectedRows();

        // Create a hidden input field to hold the selected rows data
        const selectedRowsInput = document.createElement('input');
        selectedRowsInput.type = 'hidden';
        selectedRowsInput.name = 'selectedRows';
        selectedRowsInput.value = JSON.stringify(selectedRowsData);

        // Append the hidden input field to the form
        form.appendChild(selectedRowsInput);

        // Submit the form
        form.submit();
    }
    // This looks for each element that was selected via checkbox.
    function getSelectedRows() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const selectedRows = [];

        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                // Get the start time, end time, and ID number of the selected row
                const startTime = document.getElementsByName('startTime[]')[index].value;
                const endTime = document.getElementsByName('endTime[]')[index].value;
                const id = document.getElementsByName('id[]')[index].value;

                // Push an object containing this information to the selectedRows array
                selectedRows.push({
                    startTime: startTime,
                    endTime: endTime,
                    id: id
                });
            }
        });

        return selectedRows;
    }
    // This looks for any checkbox that is selected. If it is, then disable the Add Row button. When there aren't any,
    // Re-enable the Add Row Button
    function handleCheckboxChange() {
        const addRowButton = document.getElementById('addRowButton');
        const checkboxes = document.querySelectorAll('.row-checkbox');

        for (let checkbox of checkboxes) {
            if (checkbox.checked) {
                addRowButton.disabled = true;
                addRowButton.style.textDecoration = "line-through";
                return; // Exit function early if any checkbox is checked
            }
        }
        addRowButton.style.textDecoration = "none";
        addRowButton.disabled = false; // Enable button if no checkbox is checked
    }
</script>

<body>

    <div class="parent">
        <div class="topBar">
            <span class="icon">
                <img src="stopwatch.png" id="icon">
                <!-- Attribution to flaticon.com -->
            </span>
            <span class="title">
                <h2 class="title">Hours Tracker</h2>
            </span>
        </div>
        <div class="greetAndgross">
            <h3 class="greet">Hello,
                <?php
                if (isset($_COOKIE['login'])) {
                    $cookie = json_decode($_COOKIE['login'], true);
                    echo $cookie["user"];

                    $dbName = $cookie["user"];
                }
                ?>!
            </h3>
            <h3 class="gross-pay">Gross Pay:</h3>
        </div>

        <div class="table">
            <form id="tableForm" method="POST">
                <ul class="fancy-table">
                    <li class="table-header">
                        <div class="col col-1">Edit</div>
                        <div class="col col-2">Day</div>
                        <div class="col col-3">Start Time</div>
                        <div class="col col-4">End Time</div>
                    </li>
                    <?php
                    include("readData.php");

                    $totalDuration = 0.0;
                    if ($db = new DataBaseReader("timeReader.txt", (string) $dbName)) {
                        echo "<script>console.log('Success!')</script>";
                    } else {
                        echo "<script>console.log('Success!')</script>";
                    }
                    $result = $db->getTimes();

                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_row();
                        //Parse times
                        $startTime = explode(' ', $row[1]);
                        $endTime = explode(' ', $row[2]);

                        //Create table entry
                        echo "<li class='table-row'>";
                        echo "<div class='col col-1'><input type='checkbox' class='row-checkbox' onchange='handleCheckboxChange()'></div>";
                        echo "<div class='col col-2'>" . $startTime[0] . "</div>";
                        echo "<div class='col col-3'>" . $startTime[1] . "</div>";
                        echo "<div class='col col-3'>" . $endTime[1] . "</div>";
                        echo "<input type='hidden' name='startTime[]' value='" . $startTime[1] . "'>";
                        echo "<input type='hidden' name='endTime[]' value='" . $endTime[1] . "'>";
                        echo "<input type='hidden' name='id[]' value='" . $row[0] . "'>";


                        // Convert time to a timestamp
                        $startTime = strtotime($row[0]);
                        $endTime = strtotime($row[1]);

                        $duration = $endTime - $startTime;

                        $totalDuration += $duration;
                    }
                    $totalPay = $totalDuration / 3600 * 12.48;

                    ?>

                </ul>
            </form>
        </div>

        <div class="button-container">
            <button id="addRowButton" onclick="handleFormSubmit('add.html')" class="SubmitButton">Add Entry</button>
            <button onclick="handleFormSubmit('modify.php')" class="SubmitButton">Modify Selected Entries</button>
            <button onclick="handleFormSubmit('delete.php')" class="SubmitButton">Delete Selected Entries</button>
        </div>

    </div>

    <script>
        handleCheckboxChange();
        //Outputs Gross Pay
        document.querySelector('.gross-pay').textContent = "Gross Pay: $<?php echo number_format($totalPay, 2); ?>";
    </script>
    <footer class="foot">
        <p>Attributions: Stopwatch Icon, <a href="https://www.flaticon.com/free-icons/timer" title="Stopwatch Timer Icon">
                Timer icons created by Freepik - Flaticon</a><br>
            &copy; Copyright 2024 Daniel Bennett, Carson-Newman University</p>
    </footer>
</body>

</html>