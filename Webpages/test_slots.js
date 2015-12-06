// Unit Tests

// Credits before spin
var before;

// Check that credits is an integer
asyncTest('Credits test', function() {
    expect(1); // Number of async tests to run

    $.ajax({
        url: 'getCredits.php',
        type: 'POST',
        // Send id
        data: {'emailID': emailID},
        success: function(data)
        {
            // Convert to integer
            credits = parseInt(data);
            before = credits;
            equal(typeof(credits), 'number', 'Credits is an integer');
            // Continue test execution
            start();
        }
    });
});

// Check that credits is appropriately incremented or decremented
// depending on win or loss
asyncTest('Spin test', function() {
    expect(1); // Number of async tests to run

    var credits;
    var bet = parseInt($('#bet').val());

    $('#slotMachineButtonShuffle').trigger('click');
    $('#slotMachineButtonStop').trigger('click');
    $('#slotMachineButtonStop').trigger('click');
    $('#slotMachineButtonStop').trigger('click');

    // Set timeout to make sure that trigger calls complete before Ajax call
    setTimeout(function() {
        $.ajax({
            url: 'getCredits.php',
            type: 'POST',
            // Send id
            data: {'emailID': emailID},
            success: function(data)
            {
                // Convert to integer
                credits = parseInt(data);
                if (result1 == result2 && result2 == result3) {
                    equal(credits, before + bet, 'Credits should be incremented by bet');
                }
                else {
                    equal(credits, before - bet, 'Credits should be decremented by bet');
                }

                // Continue test execution
                start();
            }
        });
    }, 500);
});

// test('Example test', function() {
//     equal(1, 1, 'One is one');
// });
