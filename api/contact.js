
const nodemailer = require('nodemailer');

export default async function handler(req, res) {
    if (req.method === 'POST') {
        const { name, email, subject, message } = req.body;

        // Set up nodemailer transporter
        const transporter = nodemailer.createTransport({ 
          host: 'smtp.gmail.com', // SMTP server for Gmail
          port: 587, // SMTP port
          secure: false, // Use TLS
          auth: {
              user: 'tekaligngetachew114@gmail.com', // Your Gmail address
              pass: '#@ta7ke5500A', // Your Gmail password (consider using app password if 2FA is enabled)
          },
      });
      

        // Setup email data
        const mailOptions = {
            from: `${name} <${email}>`,
            to: 'tekaligngetachew114@gmail.com',
            subject: subject,
            text: message,
        };

        // Send mail
        try {
            await transporter.sendMail(mailOptions);
            res.status(200).json({ message: 'Message sent successfully!' });
        } catch (error) {
            console.error(error);
            res.status(500).json({ error: 'Failed to send message' });
        }
    } else {
        // Handle any other HTTP method
        res.setHeader('Allow', ['POST']);
        res.status(405).end(`Method ${req.method} Not Allowed`);
    }
}
