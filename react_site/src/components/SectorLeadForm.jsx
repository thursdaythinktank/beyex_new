import { useState } from 'react';
import { Button } from './ui/Button';

/**
 * Compact on-page lead form for sector landing pages.
 * Posts to the same /api/contact endpoint as the home quote form, with the
 * sector pre-filled so the team knows which page the enquiry came from.
 */
export function SectorLeadForm({ sector, heading = 'Get a free quote', id = 'lead-form' }) {
  const [form, setForm] = useState({ email: '', phone: '', message: '' });
  const [status, setStatus] = useState('idle'); // idle | sending | success | error

  const handleChange = (e) => {
    setForm((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (status === 'sending') return;
    setStatus('sending');
    try {
      const res = await fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          email: form.email,
          phone: form.phone,
          message: `[${sector} enquiry] ${form.message}`.trim(),
        }),
      });
      if (!res.ok) throw new Error('Request failed');
      setStatus('success');
    } catch {
      setStatus('error');
    }
  };

  if (status === 'success') {
    return (
      <section id={id} className="mt-16 p-8 bg-apple-gray-50 rounded-2xl text-center">
        <h3 className="text-2xl font-semibold text-apple-gray-900 mb-2">Thank you</h3>
        <p className="text-apple-gray-600">
          We&apos;ve received your enquiry and will be in touch within one business day.
        </p>
      </section>
    );
  }

  return (
    <section id={id} className="mt-16 p-8 bg-apple-gray-50 rounded-2xl">
      <h3 className="text-2xl font-semibold text-apple-gray-900 mb-2">{heading}</h3>
      <p className="text-apple-gray-600 mb-6 text-sm">
        Tell us about your space and we&apos;ll send a no-obligation quote — typically within one
        business day.
      </p>
      <form onSubmit={handleSubmit} className="space-y-4">
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <input
            type="email"
            name="email"
            required
            value={form.email}
            onChange={handleChange}
            placeholder="Email address"
            className="w-full px-4 py-3 rounded-lg border border-apple-gray-200 focus:border-apple-blue-500 focus:outline-none focus:ring-2 focus:ring-apple-blue-500/20 text-apple-gray-900"
          />
          <input
            type="tel"
            name="phone"
            value={form.phone}
            onChange={handleChange}
            placeholder="Phone (optional)"
            className="w-full px-4 py-3 rounded-lg border border-apple-gray-200 focus:border-apple-blue-500 focus:outline-none focus:ring-2 focus:ring-apple-blue-500/20 text-apple-gray-900"
          />
        </div>
        <textarea
          name="message"
          rows={3}
          value={form.message}
          onChange={handleChange}
          placeholder={`Tell us about your ${sector.toLowerCase()} space...`}
          className="w-full px-4 py-3 rounded-lg border border-apple-gray-200 focus:border-apple-blue-500 focus:outline-none focus:ring-2 focus:ring-apple-blue-500/20 text-apple-gray-900"
        />
        {status === 'error' && (
          <p className="text-sm text-red-600">
            Something went wrong. Please try again or email contact@beyex.com.
          </p>
        )}
        <Button type="submit" size="lg" disabled={status === 'sending'}>
          {status === 'sending' ? 'Sending…' : 'Request my quote'}
        </Button>
      </form>
    </section>
  );
}
