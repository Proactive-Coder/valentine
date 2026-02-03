<?php
// Enable CORS for the form submission
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');


// Get form data
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
$instagram = isset($_POST['instagram']) ? sanitize_input($_POST['instagram']) : '';
$timestamp = isset($_POST['timestamp']) ? sanitize_input($_POST['timestamp']) : date('Y-m-d H:i:s');

// Validate inputs
if (empty($phone) || empty($instagram)) {
  echo json_encode(['success' => false, 'message' => 'All fields are required']);
  exit;
}

// Sanitize input
function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Email subject and body
$subject = "💕 Valentine's Response! - " . $timestamp;

$message = "
<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
    .container { 
      max-width: 600px; 
      margin: 20px auto; 
      background-color: #fff; 
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      border-left: 5px solid #ff1493;
    }
    .header { 
      text-align: center;
      margin-bottom: 30px;
      color: #ff1493;
      font-size: 28px;
      font-weight: bold;
    }
    .emoji { font-size: 40px; margin: 10px 0; }
    .details { 
      background-color: #ffe0ed;
      padding: 20px;
      border-radius: 10px;
      margin: 20px 0;
    }
    .detail-item { 
      margin: 15px 0;
      padding: 10px;
      background-color: white;
      border-radius: 5px;
    }
    .label { 
      font-weight: bold;
      color: #ff1493;
      display: inline-block;
      min-width: 120px;
    }
    .value { 
      color: #333;
      font-size: 16px;
    }
    .timestamp {
      text-align: center;
      color: #666;
      font-size: 12px;
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid #ddd;
    }
    .footer {
      text-align: center;
      color: #ff1493;
      margin-top: 20px;
      font-style: italic;
    }
  </style>
</head>
<body>
  <div class=\"container\">
    <div class=\"header\">
      ❤️ Someone Said YES! ❤️
    </div>
    
    <div class=\"emoji\" style=\"text-align: center;\">🎉 💕 🎉</div>
    
    <p style=\"text-align: center; font-size: 16px; color: #333;\">
      Congratulations! You received a response to your Valentine's question!
    </p>
    
    <div class=\"details\">
      <div class=\"detail-item\">
        <span class=\"label\">📱 Phone:</span>
        <span class=\"value\">$phone</span>
      </div>
      <div class=\"detail-item\">
        <span class=\"label\">📸 Instagram:</span>
        <span class=\"value\">@$instagram</span>
      </div>
    </div>
    
    <div class=\"footer\">
      <p>They said YES to being your Valentine! 💘</p>
      <p>Go reach out and make their day even more special! 🌹</p>
    </div>
    
    <div class=\"timestamp\">
      Received on: $timestamp
    </div>
  </div>
</body>
</html>
";

// Log the data
$log_entry = date('Y-m-d H:i:s') . " - Phone: $phone, Instagram: $instagram\n";
file_put_contents('submissions.log', $log_entry, FILE_APPEND);

// Always succeed - data is logged
echo json_encode(['success' => true, 'message' => 'Response recorded! Check submissions.log for details.']);
?>
