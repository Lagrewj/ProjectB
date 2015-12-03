$(document).ready(function() {
    $('#bet').keydown(function() {
        // Do not allow changes to input field
        return false;
    });

    var credits;
    var bet;

    // Get credits from database
    $.ajax({
        url: 'getCredits.php',
        type: 'POST',
        // Send id
        data: {'emailID': emailID},
        success: function(data)
        {
            // Convert to integer
            credits = parseInt(data);
            $('#msg').text('Credits: ' + credits);
        }
    });

    // Randomize slots with different odds
    var machine4 = $('#machine4').slotMachine({
        active: 0,
        delay: 500,
        randomize: function(activeElementIndex) {
            var spinResult = Math.floor(Math.random() * 85) + 1;
            if (spinResult <= 30) {
                return 1;
            }
            else if (spinResult > 30 && spinResult <= 50) {
                return 2;
            }
            else if (spinResult > 50 && spinResult <= 65) {
                return 3;
            }
            else if (spinResult > 65 && spinResult <= 75) {
                return 4;
            }
            else if (spinResult > 75 && spinResult <= 80) {
                return 5;
            }
            else {
                return 6;
            }
        }
    });

    // Randomize slots with different odds
    var machine5 = $('#machine5').slotMachine({
        active: 1,
        delay: 500,
        randomize: function(activeElementIndex) {
            var spinResult = Math.floor(Math.random() * 85) + 1;
            if (spinResult <= 30) {
                return 1;
            }
            else if (spinResult > 30 && spinResult <= 50) {
                return 2;
            }
            else if (spinResult > 50 && spinResult <= 65) {
                return 3;
            }
            else if (spinResult > 65 && spinResult <= 75) {
                return 4;
            }
            else if (spinResult > 75 && spinResult <= 80) {
                return 5;
            }
            else {
                return 6;
            }
        }
    });

    // Randomize slots with different odds
    window.machine6 = $('#machine6').slotMachine({
        active: 2,
        delay: 500,
        randomize: function(activeElementIndex) {
            var spinResult = Math.floor(Math.random() * 85) + 1;
            if (spinResult <= 30) {
                return 1;
            }
            else if (spinResult > 30 && spinResult <= 50) {
                return 2;
            }
            else if (spinResult > 50 && spinResult <= 65) {
                return 3;
            }
            else if (spinResult > 65 && spinResult <= 75) {
                return 4;
            }
            else if (spinResult > 75 && spinResult <= 80) {
                return 5;
            }
            else {
                return 6;
            }
        }
    });

    var started = 0;

    // Spin reel
    $('#slotMachineButtonShuffle').click(function() {
        $('#msg').text('Credits: ' + credits);
        // Get bet
        bet = parseInt($('#bet').val());
        
        // Check for insufficient credits
        if (credits == 0 || credits < bet) {
            $('#slotMachineButtonShuffle').prop('disabled', true);
            alert('Insufficient credits. Please see the cashier.');
        }
        // If machine4.active is not zero, then slot1 has stopped
        // Prevent users from clicking on spin again before spin has completed
        else if (machine4.active != 0) {
            $('#slotMachineButtonShuffle').prop('disabled', true);
        }
        // There are enough credits to play
        else {
            started = 3;
            machine4.shuffle();
            machine5.shuffle();
            machine6.shuffle();
        }
    });

    // Stop reel
    $('#slotMachineButtonStop').click(function() {
        switch (started) {
            case 3:
                machine4.stop();
                break;
            case 2:
                machine5.stop();
                break;
            case 1:
                machine6.stop();
                result1 = machine4.active;
                result2 = machine5.active;
                result3 = machine6.active;

                // If all three images match
                if (result1 == result2 && result2 == result3) {
                    // Get bet
                    bet = parseInt($('#bet').val());

                    // Award credits
                    credits += bet;
                    $('#msg').text('Winner! | +' + bet + ' credits | Credits: ' + credits);

                    // Update credits
                    $.ajax({
                        url: 'updateCredits.php',
                        type: 'POST',
                        // Send id and credits
                        data: {'emailID': emailID, 'credits': credits},
                        success: function()
                        {
                            // Reset slot
                            machine4.active = 0;
                        }
                    });
                }
                else {
                    // Get bet
                    bet = parseInt($('#bet').val());

                    // Deduct credits
                    credits -= bet;
                    $('#msg').text('Sorry, next time! | -' + bet + ' credits | Credits: ' + credits);

                    // Update credits
                    $.ajax({
                        url: 'updateCredits.php',
                        type: 'POST',
                        // Send id and credits
                        data: {'emailID': emailID, 'credits': credits},
                        success: function()
                        {
                            // Reset slot
                            machine4.active = 0;
                        }
                    });
                }
                break;
        }
        started--;
    });
});
