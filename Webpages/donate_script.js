$(document).ready(function() {
    $('#donate').keydown(function() {
        // Do not allow changes to input field
        return false;
    });

    var credits;
    var donate;

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
});