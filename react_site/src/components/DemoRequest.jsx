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

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission
    console.log('Form submitted:', formData);
    alert('Thank you! We\'ll be in touch shortly.');
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

              <Button type="submit" className="w-full" size="lg">
                Request Demo
              </Button>
            </form>
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
