<?php
	session_start();
	//Turn on error reporting
	ini_set('display_errors', 'On');
	
	if(!isset($_SESSION['email_address']) && !isset($_SESSION['logged_in_status'])) {
		header("Location: signin.php");
		exit();
	}
	
	//Connects to the database
	require "./db_connect.php";
	require "./navigation.php";
?>
<!-- Sources Used: -->
<!-- https://github.com/josex2r/jQuery-SlotMachine -->
<!-- Using JQuery AJAX and php to fetch data from a mysql database: http://openenergymonitor.org/emon/node/107 -->
<!-- http://stackoverflow.com/questions/20404407/ajax-update-mysql-database-using-function-called-from-html-generated-from-php -->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Using Lottery to Cure Poverty</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="jQuery-SlotMachine/dist/jquery.slotmachine.js"></script>
        <script type="text/javascript" src="script.js"></script>
    </head>

    <body>
	<div class="container">
	<?php echo $navbar; ?>
	<h1 class="pageHeader">Welcome! <?php echo $_SESSION['first_name']; ?></h1>
	</div>
        <div class="line" style="padding-top:50px;">
            
            <div class="content" style="text-align: center; background: url('./img/machine.png') no-repeat 50% 120px; height: 500px;">
                
                <h1 id="msg"></h1>
                
                <div style="clear:both; padding-top: 215px;width: 335px;margin: 0 auto;">
                    <div id="machine4" class="slotMachine" style="margin-left: -65px;">
                        <div class="slot slot1"></div>
                        <div class="slot slot2"></div>
                        <div class="slot slot3"></div>
                        <div class="slot slot4"></div>
                        <div class="slot slot5"></div>
                        <div class="slot slot6"></div>
                    </div>
                    
                    <div id="machine5" class="slotMachine">
                        <div class="slot slot1"></div>
                        <div class="slot slot2"></div>
                        <div class="slot slot3"></div>
                        <div class="slot slot4"></div>
                        <div class="slot slot5"></div>
                        <div class="slot slot6"></div>
                    </div>
                    
                    <div id="machine6" class="slotMachine">
                        <div class="slot slot1"></div>
                        <div class="slot slot2"></div>
                        <div class="slot slot3"></div>
                        <div class="slot slot4"></div>
                        <div class="slot slot5"></div>
                        <div class="slot slot6"></div>
                    </div>
                    
                </div>
                
            </div>
            
            <!-- Bet Amount -->
            <div class="content text-center bet">
                <label>Bet</label>
                <input type="number" id="bet" name="bet" min="10" max="50" step="10" value="10" required>
            </div>
            
            <div class="content text-center buttons">
                <!-- Spin and Stop Buttons -->
                <div id="slotMachineButtonShuffle" class="slotMachineButton" style="font-size: 25px">Spin!</div>
                <div id="slotMachineButtonStop" class="slotMachineButton" style="font-size: 25px">Stop!</div>
            </div>
            <div class="clearfix"></div>
            
        </div>
    </body>
</html>