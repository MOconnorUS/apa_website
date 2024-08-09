// Add this to your theme's functions.php or a custom plugin

function handle_job_application_form() {
    if (isset($_POST['action']) && $_POST['action'] === 'submit_job_application') {
        $position = sanitize_text_field($_POST['position']);
        $employed = sanitize_text_field($_POST['employed']);
        $start_date = sanitize_text_field($_POST['start-date']);
        $first_name = sanitize_text_field($_POST['first-name']);
        $last_name = sanitize_text_field($_POST['last-name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);

        $to = 'targetemail@example.com'; // Replace with your email address
        $subject = 'Job Application Submission';
        $message = "
        <html>
        <head>
            <title>Job Application Submission</title>
        </head>
        <body>
            <h1>Job Application Details</h1>
            <p><strong>Position Applied For:</strong> $position</p>
            <p><strong>Currently Employed:</strong> $employed</p>
            <p><strong>Earliest Available Start Date:</strong> $start_date</p>
            <p><strong>First Name:</strong> $first_name</p>
            <p><strong>Last Name:</strong> $last_name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
        </body>
        </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $email . "\r\n";

        wp_mail($to, $subject, $message, $headers);

        wp_redirect(home_url('/thank-you/')); // Redirect to a thank-you page
        exit;
    }
}
add_action('init', 'handle_job_application_form');
