import 'dotenv/config';
import express from 'express';
import { Resend } from 'resend';
import cors from 'cors';

const app = express();
const PORT = process.env.PORT || 3001;

// Initialize Resend
const resend = new Resend(process.env.RESEND_API_KEY);

// Middleware
app.use(cors({
  origin: ['https://beyex.com', 'https://www.beyex.com', 'http://localhost:5173'],
  methods: ['POST'],
  credentials: true
}));
app.use(express.json());

// Rate limiting - simple in-memory store
const rateLimitStore = new Map();
const RATE_LIMIT_WINDOW = 60 * 1000; // 1 minute
const MAX_REQUESTS = 5; // 5 requests per minute

function rateLimit(req, res, next) {
  const ip = req.ip || req.connection.remoteAddress;
  const now = Date.now();

  if (!rateLimitStore.has(ip)) {
    rateLimitStore.set(ip, { count: 1, startTime: now });
    return next();
  }

  const record = rateLimitStore.get(ip);
  if (now - record.startTime > RATE_LIMIT_WINDOW) {
    rateLimitStore.set(ip, { count: 1, startTime: now });
    return next();
  }

  if (record.count >= MAX_REQUESTS) {
    return res.status(429).json({ error: 'Too many requests. Please try again later.' });
  }

  record.count++;
  next();
}

// Health check endpoint
app.get('/api/health', (req, res) => {
  res.json({ status: 'ok', timestamp: new Date().toISOString() });
});

// Contact form endpoint
app.post('/api/contact', rateLimit, async (req, res) => {
  try {
    const { email, phone, message, squareFootage, floors, postcode, priceRange } = req.body;

    // Validate required fields
    if (!email || !email.includes('@')) {
      return res.status(400).json({ error: 'Valid email is required' });
    }

    // Sanitize inputs
    const sanitizedEmail = email.trim().slice(0, 254);
    const sanitizedPhone = phone ? phone.trim().slice(0, 20) : 'Not provided';
    const sanitizedMessage = message ? message.trim().slice(0, 2000) : 'Not provided';
    const sanitizedSqft = squareFootage ? String(squareFootage).trim() : null;
    const sanitizedFloors = floors ? String(floors).trim() : null;
    const sanitizedPostcode = postcode ? postcode.trim().toUpperCase().slice(0, 10) : null;
    const sanitizedPriceRange = priceRange ? String(priceRange).trim() : null;

    // Build subject line
    const subjectLine = sanitizedSqft
      ? `New Quote Request: ${sanitizedSqft} sq. ft. property`
      : `New Quote Request from ${sanitizedEmail}`;

    // Send single email to customer with CC to contact@ and BCC to tamil@
    const { data, error } = await resend.emails.send({
      from: 'Beyex <noreply@beyex.com>',
      to: [sanitizedEmail],
      cc: ['contact@beyex.com'],
      bcc: ['tamil@beyex.com'],
      replyTo: 'contact@beyex.com',
      subject: 'Your Beyex Quote Request',
      html: `
        <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
          <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #1d1d1f; font-size: 28px; margin: 0;">Thank You!</h1>
            <p style="color: #86868b; font-size: 16px; margin-top: 10px;">We've received your quote request</p>
          </div>

          ${sanitizedPriceRange ? `
          <div style="background: linear-gradient(135deg, #007AFF 0%, #0056b3 100%); color: white; padding: 25px; border-radius: 16px; margin: 25px 0; text-align: center;">
            <p style="margin: 0 0 8px 0; font-size: 14px; opacity: 0.9;">Your Estimated Quote</p>
            <p style="margin: 0; font-size: 32px; font-weight: 700;">${sanitizedPriceRange}</p>
            <p style="margin: 10px 0 0 0; font-size: 12px; opacity: 0.8;">Final price may vary based on property complexity</p>
          </div>
          ` : ''}

          ${sanitizedSqft || sanitizedFloors || sanitizedPostcode ? `
          <div style="background: #f5f5f7; padding: 20px; border-radius: 12px; margin: 20px 0;">
            <h3 style="margin: 0 0 15px 0; color: #1d1d1f; font-size: 16px;">Your Property Details</h3>
            ${sanitizedSqft ? `<p style="margin: 8px 0; color: #1d1d1f;"><strong>Square Footage:</strong> ${parseInt(sanitizedSqft).toLocaleString()} sq. ft.</p>` : ''}
            ${sanitizedFloors ? `<p style="margin: 8px 0; color: #1d1d1f;"><strong>Number of Floors:</strong> ${sanitizedFloors}</p>` : ''}
            ${sanitizedPostcode ? `<p style="margin: 8px 0; color: #1d1d1f;"><strong>Location:</strong> ${sanitizedPostcode}</p>` : ''}
          </div>
          ` : ''}

          ${sanitizedMessage && sanitizedMessage !== 'Not provided' ? `
          <div style="background: #f5f5f7; padding: 20px; border-radius: 12px; margin: 20px 0;">
            <h3 style="margin: 0 0 15px 0; color: #1d1d1f; font-size: 16px;">Your Message</h3>
            <p style="margin: 0; color: #1d1d1f; white-space: pre-wrap;">${sanitizedMessage}</p>
          </div>
          ` : ''}

          <div style="background: #f5f5f7; padding: 20px; border-radius: 12px; margin: 20px 0;">
            <h3 style="margin: 0 0 15px 0; color: #1d1d1f; font-size: 16px;">What Happens Next?</h3>
            <p style="margin: 0; color: #1d1d1f; line-height: 1.6;">
              Our team will review your request and get back to you within <strong>24 hours</strong> to discuss your project and provide a detailed quote.
            </p>
          </div>

          <div style="background: #e8f4fd; padding: 20px; border-radius: 12px; margin: 20px 0; border-left: 4px solid #007AFF;">
            <h3 style="margin: 0 0 15px 0; color: #1d1d1f; font-size: 16px;">Get in Touch</h3>
            <p style="margin: 8px 0; color: #1d1d1f;">
              <strong>Phone:</strong> <a href="tel:+447459177457" style="color: #007AFF; text-decoration: none;">+44 7459 177457</a>
            </p>
            <p style="margin: 8px 0; color: #1d1d1f;">
              <strong>Email:</strong> <a href="mailto:contact@beyex.com" style="color: #007AFF; text-decoration: none;">contact@beyex.com</a>
            </p>
          </div>

          <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e5e5;">
            <p style="color: #86868b; font-size: 12px; margin: 0;">
              © ${new Date().getFullYear()} Beyex. All rights reserved.
            </p>
            <p style="color: #86868b; font-size: 12px; margin: 5px 0 0 0;">
              <a href="https://beyex.com" style="color: #007AFF; text-decoration: none;">beyex.com</a>
            </p>
          </div>
        </div>
      `
    });

    if (error) {
      console.error('Resend error:', error);
      return res.status(500).json({ error: 'Failed to send email. Please try again.' });
    }

    console.log('Quote email sent:', data?.id);
    res.json({ success: true, messageId: data?.id });

  } catch (err) {
    console.error('Server error:', err);
    res.status(500).json({ error: 'Server error. Please try again later.' });
  }
});

// Calendly webhook endpoint
app.post('/api/calendly-webhook', async (req, res) => {
  try {
    const { event, payload } = req.body;

    // Only process invitee.created events (new bookings)
    if (event !== 'invitee.created') {
      return res.json({ received: true, processed: false });
    }

    const invitee = payload?.invitee || {};
    const scheduledEvent = payload?.scheduled_event || {};
    const questionsAndAnswers = payload?.questions_and_answers || [];

    const inviteeName = invitee.name || 'Unknown';
    const inviteeEmail = invitee.email || null;
    const hasValidEmail = inviteeEmail && inviteeEmail.includes('@');
    const eventName = scheduledEvent.name || '30 Minute Meeting';
    const startTime = scheduledEvent.start_time
      ? new Date(scheduledEvent.start_time).toLocaleString('en-GB', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric',
          hour: '2-digit',
          minute: '2-digit',
          timeZone: 'Europe/London'
        })
      : 'Unknown';

    // Format Q&A if any
    const qaHtml = questionsAndAnswers.length > 0
      ? questionsAndAnswers.map(qa =>
          `<p style="margin: 8px 0;"><strong>${qa.question}:</strong> ${qa.answer}</p>`
        ).join('')
      : '';

    // Send notification email to team
    const emailOptions = {
      from: 'Beyex <noreply@beyex.com>',
      to: ['contact@beyex.com', 'tamil@beyex.com'],
      subject: `New Call Booked: ${inviteeName}`,
    };

    // Only add replyTo if we have a valid email
    if (hasValidEmail) {
      emailOptions.replyTo = inviteeEmail;
    }

    const { data, error } = await resend.emails.send({
      ...emailOptions,
      html: `
        <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
          <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #1d1d1f; font-size: 28px; margin: 0;">New Call Scheduled</h1>
            <p style="color: #86868b; font-size: 16px; margin-top: 10px;">via Calendly</p>
          </div>

          <div style="background: linear-gradient(135deg, #007AFF 0%, #0056b3 100%); color: white; padding: 25px; border-radius: 16px; margin: 25px 0;">
            <p style="margin: 0 0 5px 0; font-size: 14px; opacity: 0.9;">Meeting With</p>
            <p style="margin: 0; font-size: 24px; font-weight: 700;">${inviteeName}</p>
            ${hasValidEmail ? `<p style="margin: 10px 0 0 0; font-size: 14px; opacity: 0.9;">
              <a href="mailto:${inviteeEmail}" style="color: white;">${inviteeEmail}</a>
            </p>` : ''}
          </div>

          <div style="background: #f5f5f7; padding: 20px; border-radius: 12px; margin: 20px 0;">
            <h3 style="margin: 0 0 15px 0; color: #1d1d1f; font-size: 16px;">Meeting Details</h3>
            <p style="margin: 8px 0; color: #1d1d1f;"><strong>Event:</strong> ${eventName}</p>
            <p style="margin: 8px 0; color: #1d1d1f;"><strong>When:</strong> ${startTime}</p>
            ${qaHtml ? `<div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e5e5;">${qaHtml}</div>` : ''}
          </div>

          <div style="text-align: center; margin-top: 30px;">
            <p style="color: #86868b; font-size: 12px;">
              Check your calendar for the Google Meet link.
            </p>
          </div>
        </div>
      `
    });

    if (error) {
      console.error('Calendly webhook email error:', error);
      return res.status(500).json({ error: 'Failed to send notification' });
    }

    console.log('Calendly booking notification sent:', data?.id);
    res.json({ received: true, processed: true, messageId: data?.id });

  } catch (err) {
    console.error('Calendly webhook error:', err);
    res.status(500).json({ error: 'Webhook processing failed' });
  }
});

// 404 handler
app.use((req, res) => {
  res.status(404).json({ error: 'Not found' });
});

// Error handler
app.use((err, req, res, next) => {
  console.error('Unhandled error:', err);
  res.status(500).json({ error: 'Internal server error' });
});

app.listen(PORT, () => {
  console.log(`API server running on port ${PORT}`);
});
