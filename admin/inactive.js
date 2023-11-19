

// Set the inactivity timeout to 30 minutes (adjust as needed)
var inactivityTimeout =30 * 60 * 1000;  // 30 minutes in milliseconds

var timeoutId;

function resetTimeout() {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(function () {
        // Call a function to log out the user or destroy the session
        // Use AJAX to communicate with the server-side script
        // Example using jQuery $.ajax:
        $.ajax({
            url: '../admin_logout.php',
            type: 'GET',
            success: function(data) {
                // Handle the response if needed
                console.log(data);
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    }, inactivityTimeout);
}

// Attach event listeners for user activity
$(document).on('mousemove keypress', function() {
    resetTimeout();
});

// Call resetTimeout() on page load to start the inactivity timer
resetTimeout();