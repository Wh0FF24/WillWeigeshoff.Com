<?php
require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . 'Resources\project-ideas-405619-13b84b6b0cfa.json'); // Path to your credentials file

$service = new Google_Service_Sheets($client);
$spreadsheetId = 'project-ideas-405619'; // Replace with your Spreadsheet ID

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$project = $_POST['project'] ?? '';

// Data to be added
$values = [
    [$name, $email, $project, date('Y-m-d H:i:s')] // Date and time of submission
];

$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

$params = [
    'valueInputOption' => 'RAW'
];

$insert = [
    'insertDataOption' => 'INSERT_ROWS'
];

$range = 'A1'; // Assuming you start writing at row 1 in the first column

$result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params, $insert);

// Redirect or display a message after successful submission
header('Location: thank_you.html'); // Redirect to a thank you page
exit;
?>
