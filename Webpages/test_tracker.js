// Unit Tests

// Checks that name displays correctly
QUnit.test('Test Charity Name', function() {
    
    var data = document.getElementsByTagName("td");
	
	equal(data[0].innerHTML, 'American Heart Association', 'Charity name displays correctly');
});

// Check that received amount displays correctly
asyncTest('Test Charity Amount', function() {
    expect(1); // Number of async tests to run
    
    var data = document.getElementsByTagName("td");

    $.ajax({
        url: 'getCharityAmount.php',
        type: 'POST',
        // Send id
        data: {'charityID': 1},
        success: function(response)
        {
            // Convert to integer
            credits = parseInt(response);
            equal(credits, data[1].innerHTML, 'Received amount displays correctly');
            // Continue test execution
            start();
        }
    });
});

// Check that goal amount displays correctly
QUnit.test('Test Goal Amount', function() {
    var data = document.getElementsByTagName("td");
    
    equal(data[2].innerHTML, '10000', 'Goal amount displays correctly');
});

// Check that percentage of goal achieved displays correctly
asyncTest('Test Percentage', function() {
    expect(1); // Number of async tests to run
    
    var data = document.getElementsByTagName("td");

    $.ajax({
        url: 'getCharityAmount.php',
        type: 'POST',
        // Send id
        data: {'charityID': 1},
        success: function(response)
        {
            // Convert to integer
            credits = parseInt(response);
            credits = (credits / 10000).toFixed(2);
            equal(credits + '%', data[3].innerHTML, 'Percentage displays correctly');
            // Continue test execution
            start();
        }
    });
});