import { useState } from 'react';

/**
 * Footer newsletter signup → POST /api/subscribe (Mailchimp).
 * Not mounted until Mailchimp credentials are configured on the server.
 */
export function Newsletter() {
  const [email, setEmail] = useState('');
  const [status, setStatus] = useState('idle'); // idle | sending | success | error

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (status === 'sending') return;
    setStatus('sending');
    try {
      const res = await fetch('/api/subscribe', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email }),
      });
      if (!res.ok) throw new Error('failed');
      setStatus('success');
      setEmail('');
    } catch {
      setStatus('error');
    }
  };

  return (
    <div className="space-y-4">
      <h4 className="text-sm font-semibold text-apple-gray-900">Newsletter</h4>
      {status === 'success' ? (
        <p className="text-sm text-apple-gray-600">Thanks — you&apos;re subscribed.</p>
      ) : (
        <form onSubmit={handleSubmit} className="space-y-2">
          <p className="text-sm text-apple-gray-600">Occasional updates on 3D tours and digital twins.</p>
          <div className="flex gap-2">
            <input
              type="email"
              required
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              aria-label="Email address"
              placeholder="Email address"
              className="min-w-0 flex-1 px-3 py-2 text-sm rounded-lg border border-apple-gray-200 focus:border-apple-blue-500 focus:outline-none"
            />
            <button
              type="submit"
              disabled={status === 'sending'}
              className="px-4 py-2 rounded-lg bg-apple-blue-600 text-white text-sm font-medium hover:bg-apple-blue-500 transition-colors whitespace-nowrap"
            >
              {status === 'sending' ? '…' : 'Subscribe'}
            </button>
          </div>
          {status === 'error' && (
            <p className="text-xs text-red-600">Could not subscribe right now. Please try again.</p>
          )}
        </form>
      )}
    </div>
  );
}
