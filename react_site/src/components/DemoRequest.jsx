import { useState } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { Input, Textarea, Select } from './ui/Input';
import { Button } from './ui/Button';

/**
 * Demo request form with Apple-style inputs
 */
export function DemoRequest() {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  const [formData, setFormData] = useState({
    name: '',
    email: '',
    sector: '',
    message: '',
  });

  const [submitted, setSubmitted] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError(null);

    try {
      // Combine name, sector and message for the API
      const apiData = {
        email: formData.email,
        phone: '', // DemoRequest doesn't have phone field
        message: `Name: ${formData.name}\nSector: ${formData.sector}\n\n${formData.message}`,
      };

      const response = await fetch('/api/contact', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(apiData),
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.error || 'Failed to send message');
      }

      setSubmitted(true);
    } catch (err) {
      setError(err.message || 'Something went wrong. Please try again.');
    } finally {
      setIsLoading(false);
    }
  };

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const sectorOptions = [
    { value: '', label: 'Select your sector' },
    { value: 'real-estate', label: 'Real Estate' },
    { value: 'venues', label: 'Venues & Hospitality' },
    { value: 'restaurants', label: 'Restaurants & Retail' },
    { value: 'other', label: 'Other' },
  ];

  return (
    <section id="demo" className="py-24 bg-apple-gray-50">
      <div className="max-w-7xl mx-auto px-6">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          {/* Text content */}
          <motion.div
            ref={ref}
            className="space-y-6"
            initial={{ opacity: 0, x: -50 }}
            animate={inView ? { opacity: 1, x: 0 } : {}}
            transition={{ duration: 0.8 }}
          >
            <h2 className="text-5xl font-semibold text-apple-gray-900">
              Ready to transform your space?
            </h2>
            <p className="text-xl text-apple-gray-600">
              Request a demo and discover how 3D virtual tours can elevate your business.
            </p>
            <div className="space-y-4 text-base text-apple-gray-700">
              <div className="flex items-center gap-3">
                <CheckIcon />
                <span>No commitment required</span>
              </div>
              <div className="flex items-center gap-3">
                <CheckIcon />
                <span>Free consultation included</span>
              </div>
              <div className="flex items-center gap-3">
                <CheckIcon />
                <span>Same-day response</span>
              </div>
            </div>
          </motion.div>

          {/* Form */}
          <motion.div
            initial={{ opacity: 0, x: 50 }}
            animate={inView ? { opacity: 1, x: 0 } : {}}
            transition={{ duration: 0.8, delay: 0.2 }}
          >
            {!submitted ? (
              <form onSubmit={handleSubmit} className="space-y-6 bg-white p-8 rounded-2xl shadow-apple">
                <Input
                  label="Name"
                  name="name"
                  placeholder="John Smith"
                  value={formData.name}
                  onChange={handleChange}
                  required
                />

                <Input
                  label="Email"
                  name="email"
                  type="email"
                  placeholder="john@company.com"
                  value={formData.email}
                  onChange={handleChange}
                  required
                />

                <Select
                  label="Sector"
                  name="sector"
                  options={sectorOptions}
                  value={formData.sector}
                  onChange={handleChange}
                  required
                />

                <Textarea
                  label="Message"
                  name="message"
                  placeholder="Tell us about your project..."
                  rows={4}
                  value={formData.message}
                  onChange={handleChange}
                />

                {error && (
                  <div className="p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    {error}
                  </div>
                )}

                <Button type="submit" className="w-full" size="lg" disabled={isLoading}>
                  {isLoading ? (
                    <span className="flex items-center justify-center gap-2">
                      <svg className="animate-spin h-5 w-5" viewBox="0 0 24 24">
                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                      </svg>
                      Sending...
                    </span>
                  ) : (
                    'Request Demo'
                  )}
                </Button>
              </form>
            ) : (
              <motion.div
                className="bg-white p-8 rounded-2xl shadow-apple text-center"
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{ opacity: 1, scale: 1 }}
              >
                <div className="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                  <svg className="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                  </svg>
                </div>
                <h4 className="text-xl font-semibold text-apple-gray-900 mb-2">
                  Thanks for reaching out!
                </h4>
                <p className="text-apple-gray-500">
                  We'll be in touch within 24 hours.
                </p>
              </motion.div>
            )}
          </motion.div>
        </div>
      </div>
    </section>
  );
}

function CheckIcon() {
  return (
    <svg className="w-5 h-5 text-apple-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
    </svg>
  );
}
