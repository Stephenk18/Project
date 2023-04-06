<?php
// Replace YOUR_SPREADSHEET_ID with the ID of your Google Spreadsheet
$spreadsheet_id = 'https://docs.google.com/spreadsheets/d/1CGIzPPbEQGZdD6qdqXBM_qnDGuwWFVWuPQy2XBJCeVA/edit#gid=0';

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Send data to Google Sheets using the Sheets API
$url = "https://sheets.googleapis.com/v4/spreadsheets/$spreadsheet_id/values/Sheet1:append?valueInputOption=USER_ENTERED";
$data = array(
  'range' => 'Sheet1',
  'majorDimension' => 'ROWS',
  'values' => array(
    array($name, $email, $message)
  )
);
$options = array(
  'http' => array(
    'header'  => "Content-type: application/json",
    'method'  => 'POST',
    'content' => json_encode($data),
  ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Redirect to a thank-you page
header("Location: thankyou.html");
?>
