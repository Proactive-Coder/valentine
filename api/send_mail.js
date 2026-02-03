export default function handler(req, res) {
  if (req.method === 'POST') {
    const { phone, instagram } = req.body;
    
    if (!phone || !instagram) {
      return res.status(400).json({ success: false, message: 'All fields are required' });
    }
    
    // Log to console (check Vercel function logs)
    console.log(`New submission: Phone: ${phone}, Instagram: ${instagram}`);
    
    // For persistence, you could integrate with a database or external service here
    
    res.status(200).json({ success: true, message: 'Response recorded!' });
  } else {
    res.status(405).json({ message: 'Method not allowed' });
  }
}