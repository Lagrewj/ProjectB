// Unit Tests
// Testing donation feature
// Credits before donation
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

//Check that donate properly subtracts credits from usr_db
asyncTest('Test Donatation', function() {
		expect(1); // Number of async tests to run
		
	var credits;
    var donation = parseInt($('#donation').val());

    $('#donate!').trigger('click');

    // Set timeout to make sure that trigger call completes before Ajax call
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
                equal(credits, before - donation, 'Credits should be decremented by donation');
                // Continue test execution
                start();
            }
        });
    }, 500);
});
// test('Example test', function() {
//     equal(1, 1, 'One is one');
// });
