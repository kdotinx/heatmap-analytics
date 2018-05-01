
<html>
    <style>
        body{
            margin: 0;
        }
    </style>
    <head>
        <title>Heatmap analytics</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <img id='theImg' style="background-size: cover" src="../upload<?php echo $_REQUEST['image']?>">
        <canvas id='myCanvas' width='200' height='200'></canvas>
        <script src="js/jquery-1.7.2.js"></script>
        <script src="js/draw-location.js"></script>
    </body>
</html>
