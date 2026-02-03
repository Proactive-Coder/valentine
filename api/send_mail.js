export default function handler(req, res) {
  // Set CORS headers
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'POST');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

  if (req.method === 'POST') {
    let body;
    try {
      body = typeof req.body === 'string' ? JSON.parse(req.body) : req.body;
    } catch (e) {
      console.error('JSON parse error:', e);
      return res.status(400).json({ success: false, message: 'Invalid JSON' });
    }

    const { phone, instagram } = body;
    
    if (!phone || !instagram) {
      return res.status(400).json({ success: false, message: 'All fields are required' });
    }
    
    // Log to console (check Vercel function logs)
    console.log(`New submission: Phone: ${phone}, Instagram: ${instagram}`);
    
    // For persistence, you could integrate with a database or external service here
    
    res.status(200).json({ success: true, message: 'Response recorded!' });
  } else {
    res.status(405).json({ success: false, message: 'Method not allowed' });
  }
}