<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate QR code for lab components</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $.get('get_departments.php', function(data) {
            $('#departments').html(data);
        });

        $('#departments').on('change', function() {
            var department_id = $(this).val();
            $.get('get_labs.php?department_id=' + department_id, function(data) {
                $('#labs').html(data);
            });
        });

        $('#labs').on('change', function() {
            var lab_id = $(this).val();
            $.get('get_systems.php?lab_id=' + lab_id, function(data) {
                $('#systems').html(data);
            });
        });

        $('#systems').on('change', function() {
            var system_id = $(this).val();
            $.get('get_components.php?system_id=' + system_id, function(data) {
                $('#components').html(data);
            });
        });

        $('#components').on('change', function() {
            var component_id = $(this).val();
            $.get('generate_qr.php?component_id=' + component_id, function(data) {
                $('#qr_code').html(data);
            });
        });
    });
    </script>
    <style>
    nav{background-color: lightblue; padding: 15px; }
        nav a {
        color: #fff; /* Text color */
        text-decoration: none; /* Remove underline */
        padding: 10px 20px; /* Padding around each link */
        margin: 0px 10px; /* Spacing between links */
        border-radius: 5px; /* Rounded corners */
        background-color: #555;
        display: inline-block; /* Use flexbox */
        flex-wrap: wrap;
         }
        nav a:hover {
        background-color:blue;/* Background color on hover */
        }
 </style>
</head>
<body>
    <center>
    <h1 style="background-color:#161B7F;color:yellow">Generate QR code for lab components</h1>
    <nav>
        <b><h1>Select Department</h1></b>
        <select id="departments"></select>
        <b><h1>Select Lab</h1></b>
        <select id="labs"></select>
        <b><h1>Select System</h1></b>
        <select id="systems"></select>
        <b><h1>Select Component</h1></b>
        <select id="components"></select>
        <br><br><div id="qr_code"></div>
    </nav>
    </center>
    <!-- <footer>
        <hr/>
        <center>
            Made by Sharanabasava | GEC Hassan - 573201
        </center>
     </footer> -->

</body>
</html>
