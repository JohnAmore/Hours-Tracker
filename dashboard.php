<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">

</head>

<script>
    function handleFormSubmit(action) {
        const form = document.getElementById('tableForm');
        form.action = action;
        form.submit();
    }

    function getSelectedRows() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const selectedRows = [];

        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                selectedRows.push(index);
            }
        });

        return selectedRows;
    }

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

                    ?>

                </ul>
            </form>
        </div>

        <div class="button-container">
            <button id="addRowButton" onclick="handleFormSubmit('add.php')" class="SubmitButton">Add Row</button>
            <button onclick="handleFormSubmit('modify.php')" class="SubmitButton">Modify Selected Rows</button>
            <button onclick="handleFormSubmit('delete.php')" class="SubmitButton">Delete Selected Rows</button>
        </div>

    </div>

    <script>
        handleCheckboxChange();
    </script>
    <footer class="foot">
        <p>Attributions: Stopwatch Icon, <a href="https://www.flaticon.com/free-icons/timer" title="Stopwatch Timer Icon">
                Timer icons created by Freepik - Flaticon</a><br>
            &copy; Copyright 2024 Daniel Bennett, Carson-Newman University</p>
    </footer>
</body>

</html>