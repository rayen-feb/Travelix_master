document.addEventListener('DOMContentLoaded', function() {
    var formSubmitButton = document.getElementById('form_submit_button');
    formSubmitButton.addEventListener('click', function(event) {
        var sujet = document.getElementById('contact_form_subject').value;
        var message = document.getElementById('contact_form_message').value;

        if (sujet.trim() === '' || message.trim() === '') {
            alert('Please fill in all fields.');
            event.preventDefault(); // Prevent form submission
        } else {
            var confirmSend = confirm('Are you sure you want to send the message?');
            if (!confirmSend) {
                event.preventDefault(); // Prevent form submission
            }
        }
    });
});
