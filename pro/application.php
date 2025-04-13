<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and fetch form inputs
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $pincode = htmlspecialchars($_POST['pincode']);

    $degreeLevel = htmlspecialchars($_POST['degreeLevel']);
    $institution = htmlspecialchars($_POST['institution']);
    $fieldOfStudy = htmlspecialchars($_POST['fieldOfStudy']);
    $graduationYear = htmlspecialchars($_POST['graduationYear']);

    $company = htmlspecialchars($_POST['company']);
    $position = htmlspecialchars($_POST['position']);
    $startDate = htmlspecialchars($_POST['startDate']);
    $endDate = isset($_POST['currentlyWorking']) ? 'Currently Working' : htmlspecialchars($_POST['endDate']);
    $responsibilities = htmlspecialchars($_POST['responsibilities']);

    $additionalInfo = htmlspecialchars($_POST['additionalInfo']);
    $termsAgreement = isset($_POST['termsAgreement']) ? 'Yes' : 'No';

    // File upload handling
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Resume upload
    $resumePath = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === 0) {
        $resumePath = $uploadDir . basename($_FILES['resume']['name']);
        move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath);
    }

    // Certificate upload (optional)
    $certificatePath = '';
    if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] === 0) {
        $certificatePath = $uploadDir . basename($_FILES['certificate']['name']);
        move_uploaded_file($_FILES['certificate']['tmp_name'], $certificatePath);
    }

    // Save to a text file or database (example: save to a text file)
    $data = <<<EOD
--------------------------
New Application:
Name: $firstName $lastName
Email: $email
Phone: $phone
Address: $address, $city - $pincode

Education:
Degree: $degreeLevel
Institution: $institution
Field: $fieldOfStudy
Graduation Year: $graduationYear

Work Experience:
Company: $company
Position: $position
Start Date: $startDate
End Date: $endDate
Responsibilities: $responsibilities

Additional Info: $additionalInfo
Agreed to Terms: $termsAgreement

Files:
Resume: $resumePath
Certificate: $certificatePath
--------------------------

EOD;

    file_put_contents("applications.txt", $data, FILE_APPEND);

    // Redirect to a thank-you page or show message
    echo "<script>alert('Application submitted successfully!'); window.location.href='thankyou.html';</script>";
    exit();
} else {
    echo "Invalid request.";
}
?>
