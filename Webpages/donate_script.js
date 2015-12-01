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
        data: {'id': 1},
        success: function(data)
        {
            // Convert to integer
            credits = parseInt(data);
            $('#msg').text('credits: ' + credits);
        }
    });
});