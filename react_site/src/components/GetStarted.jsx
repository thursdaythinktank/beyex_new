import { useState } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { Input, Textarea } from './ui/Input';
import { Button } from './ui/Button';

/**
 * Get Started - Minimal form, maximum conversion
 * Two paths: schedule a capture OR see more examples
 */
export function GetStarted() {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  const [formData, setFormData] = useState({
    email: '',
    phone: '',
    message: '',
  });

  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission
    console.log('Form submitted:', formData);
    setSubmitted(true);
  };

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  return (
    <section id="get-started" className="py-24 bg-apple-gray-50">
      <div className="max-w-7xl mx-auto px-6">
        <motion.div
          ref={ref}
          className="text-center mb-16"
          initial={{ opacity: 0, y: 20 }}
          animate={inView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 mb-4">
            Ready to capture your space?
          </h2>
          <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto">
            Get in touch and we'll show you what's possible.
          </p>
        </motion.div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-5xl mx-auto">
          {/* Contact Form */}
          <motion.div
            initial={{ opacity: 0, x: -30 }}
            animate={inView ? { opacity: 1, x: 0 } : {}}
            transition={{ duration: 0.6, delay: 0.2 }}
          >
            <div className="bg-white p-8 rounded-2xl shadow-lg border border-apple-gray-100">
              <h3 className="text-xl font-semibold text-apple-gray-900 mb-2">
                Schedule a Capture
              </h3>
              <p className="text-apple-gray-500 mb-6">
                We'll assess your space and provide a free quote.
              </p>

              {!submitted ? (
                <form onSubmit={handleSubmit} className="space-y-5">
                  <Input
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="you@company.com"
                    value={formData.email}
                    onChange={handleChange}
                    required
                  />

                  <Input
                    label="Phone (optional)"
                    name="phone"
                    type="tel"
                    placeholder="+1 (555) 000-0000"
                    value={formData.phone}
                    onChange={handleChange}
                  />

                  <Textarea
                    label="Tell us about your space (optional)"
                    name="message"
                    placeholder="What kind of space do you want to capture?"
                    rows={3}
                    value={formData.message}
                    onChange={handleChange}
                  />

                  <Button type="submit" className="w-full" size="lg">
                    Get Free Quote
                  </Button>
                </form>
              ) : (
                <motion.div
                  className="text-center py-8"
                  initial={{ opacity: 0, scale: 0.9 }}
                  animate={{ opacity: 1, scale: 1 }}
                >
                  <div className="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                    <CheckIcon className="w-8 h-8 text-green-600" />
                  </div>
                  <h4 className="text-xl font-semibold text-apple-gray-900 mb-2">
                    Thanks for reaching out!
                  </h4>
                  <p className="text-apple-gray-500">
                    We'll be in touch within 24 hours.
                  </p>
                </motion.div>
              )}
            </div>
          </motion.div>

          {/* Alternative Path */}
          <motion.div
            initial={{ opacity: 0, x: 30 }}
            animate={inView ? { opacity: 1, x: 0 } : {}}
            transition={{ duration: 0.6, delay: 0.3 }}
          >
            <div className="bg-gradient-to-br from-apple-blue-500 to-apple-blue-600 p-8 rounded-2xl shadow-lg text-white h-full flex flex-col">
              <h3 className="text-xl font-semibold mb-2">
                See More Examples
              </h3>
              <p className="text-white/80 mb-6">
                Explore our portfolio of digital twins across industries.
              </p>

              <div className="flex-1 flex flex-col justify-between">
                <ul className="space-y-4 mb-8">
                  <li className="flex items-start gap-3">
                    <CheckCircleIcon className="w-5 h-5 text-apple-blue-200 mt-0.5 flex-shrink-0" />
                    <span className="text-white/90">Residential & commercial properties</span>
                  </li>
                  <li className="flex items-start gap-3">
                    <CheckCircleIcon className="w-5 h-5 text-apple-blue-200 mt-0.5 flex-shrink-0" />
                    <span className="text-white/90">Hotels, venues & event spaces</span>
                  </li>
                  <li className="flex items-start gap-3">
                    <CheckCircleIcon className="w-5 h-5 text-apple-blue-200 mt-0.5 flex-shrink-0" />
                    <span className="text-white/90">Restaurants, retail & showrooms</span>
                  </li>
                </ul>

                <Button
                  variant="secondary"
                  size="lg"
                  className="w-full bg-white text-apple-blue-600 hover:bg-apple-gray-50"
                  onClick={() => document.getElementById('experiences')?.scrollIntoView({ behavior: 'smooth' })}
                >
                  View Portfolio
                </Button>
              </div>
            </div>
          </motion.div>
        </div>

        {/* Trust indicators */}
        <motion.div
          className="mt-12 text-center"
          initial={{ opacity: 0 }}
          animate={inView ? { opacity: 1 } : {}}
          transition={{ duration: 0.6, delay: 0.5 }}
        >
          <p className="text-apple-gray-400 text-sm">
            No commitment required · Free consultation included · Same-day response
          </p>
        </motion.div>
      </div>
    </section>
  );
}

function CheckIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
    </svg>
  );
}

function CheckCircleIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24">
      <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
    </svg>
  );
}
