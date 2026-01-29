import { useState, useMemo } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { Input, Textarea } from './ui/Input';
import { Button } from './ui/Button';
import { CalendlyModal } from './calendly/CalendlyModal';

/**
 * Calculate price range based on square footage
 * Pricing tiers (USD):
 * - <3,000 sq. ft.: $0.15–$0.25 per sq. ft.
 * - 3,000–10,000 sq. ft.: $0.10–$0.15 per sq. ft.
 * - 10,000+ sq. ft.: $0.05–$0.10 per sq. ft.
 */
function calculatePriceRange(sqft) {
  if (!sqft || sqft <= 0) return null;

  let minRate, maxRate;

  if (sqft < 3000) {
    minRate = 0.15;
    maxRate = 0.25;
  } else if (sqft <= 10000) {
    minRate = 0.10;
    maxRate = 0.15;
  } else {
    minRate = 0.05;
    maxRate = 0.10;
  }

  const minPrice = Math.round(sqft * minRate);
  const maxPrice = Math.round(sqft * maxRate);

  // Convert to GBP ($1.35 = £1)
  const usdToGbp = 1 / 1.35;
  const minPriceGBP = Math.round(minPrice * usdToGbp);
  const maxPriceGBP = Math.round(maxPrice * usdToGbp);

  return { minPriceGBP, maxPriceGBP, minPrice, maxPrice };
}

/**
 * Validate UK postcode format
 */
function isValidUKPostcode(postcode) {
  if (!postcode) return true; // Optional field
  const regex = /^[A-Z]{1,2}[0-9][A-Z0-9]? ?[0-9][A-Z]{2}$/i;
  return regex.test(postcode.trim());
}

/**
 * Get Started - Quote form with instant pricing
 */
export function GetStarted() {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  const [formData, setFormData] = useState({
    email: '',
    phone: '',
    squareFootage: '',
    floors: '',
    postcode: '',
    message: '',
  });

  const [submitted, setSubmitted] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);
  const [isCalendlyOpen, setIsCalendlyOpen] = useState(false);

  // Calculate price range whenever square footage changes
  const priceRange = useMemo(() => {
    const sqft = parseInt(formData.squareFootage, 10);
    return calculatePriceRange(sqft);
  }, [formData.squareFootage]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError(null);

    // Validate postcode if provided
    if (formData.postcode && !isValidUKPostcode(formData.postcode)) {
      setError('Please enter a valid UK postcode (e.g., SW1A 1AA)');
      setIsLoading(false);
      return;
    }

    try {
      // Build message with property details
      const propertyDetails = [
        `Square Footage: ${formData.squareFootage || 'Not specified'} sq. ft.`,
        `Number of Floors: ${formData.floors || 'Not specified'}`,
        `Postcode: ${formData.postcode || 'Not provided'}`,
        priceRange ? `Estimated Price Range: £${priceRange.minPriceGBP} - £${priceRange.maxPriceGBP}` : '',
        '',
        formData.message ? `Additional Notes:\n${formData.message}` : '',
      ].filter(Boolean).join('\n');

      const apiData = {
        email: formData.email,
        phone: formData.phone,
        squareFootage: formData.squareFootage,
        floors: formData.floors,
        postcode: formData.postcode,
        priceRange: priceRange ? `£${priceRange.minPriceGBP} - £${priceRange.maxPriceGBP}` : null,
        message: propertyDetails,
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
      console.error('Form submission error:', err);
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
            Get an instant quote and we'll be in touch within 24 hours.
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
                Get Your Quote
              </h3>
              <p className="text-apple-gray-500 mb-6">
                Tell us about your space for an instant estimate.
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
                    placeholder="+44 7XXX XXXXXX"
                    value={formData.phone}
                    onChange={handleChange}
                  />

                  <div className="grid grid-cols-2 gap-4">
                    <Input
                      label="Square Footage"
                      name="squareFootage"
                      type="number"
                      placeholder="e.g., 2500"
                      value={formData.squareFootage}
                      onChange={handleChange}
                      min="100"
                      required
                    />

                    <div>
                      <label className="block text-sm font-medium text-apple-gray-700 mb-2">
                        Number of Floors
                      </label>
                      <select
                        name="floors"
                        value={formData.floors}
                        onChange={handleChange}
                        required
                        className="w-full px-4 py-3 rounded-xl border border-apple-gray-200 bg-white text-apple-gray-900 focus:outline-none focus:ring-2 focus:ring-apple-blue-500 focus:border-transparent transition-all"
                      >
                        <option value="">Select...</option>
                        <option value="1">1 Floor</option>
                        <option value="2">2 Floors</option>
                        <option value="3">3 Floors</option>
                        <option value="4">4 Floors</option>
                        <option value="5+">5+ Floors</option>
                      </select>
                    </div>
                  </div>

                  <Input
                    label="Postcode (optional)"
                    name="postcode"
                    type="text"
                    placeholder="e.g., SW1A 1AA"
                    value={formData.postcode}
                    onChange={handleChange}
                  />

                  {/* Instant Price Estimate */}
                  <AnimatePresence>
                    {priceRange && (
                      <motion.div
                        initial={{ opacity: 0, height: 0 }}
                        animate={{ opacity: 1, height: 'auto' }}
                        exit={{ opacity: 0, height: 0 }}
                        className="p-4 rounded-xl bg-gradient-to-r from-apple-blue-50 to-apple-blue-100 border border-apple-blue-200"
                      >
                        <div className="flex items-center gap-2 mb-1">
                          <PriceTagIcon className="w-5 h-5 text-apple-blue-600" />
                          <span className="text-sm font-medium text-apple-blue-800">Estimated Price Range</span>
                        </div>
                        <p className="text-2xl font-semibold text-apple-blue-600">
                          £{priceRange.minPriceGBP.toLocaleString()} – £{priceRange.maxPriceGBP.toLocaleString()}
                        </p>
                        <p className="text-xs text-apple-blue-600/70 mt-1">
                          Based on {parseInt(formData.squareFootage).toLocaleString()} sq. ft. · Final quote may vary
                        </p>
                      </motion.div>
                    )}
                  </AnimatePresence>

                  <Textarea
                    label="Additional details (optional)"
                    name="message"
                    placeholder="Any specific requirements or questions?"
                    rows={2}
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
                      'Get Free Quote'
                    )}
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
                  {priceRange && (
                    <p className="text-apple-gray-700 mb-2">
                      Your estimated quote: <span className="font-semibold text-apple-blue-600">£{priceRange.minPriceGBP.toLocaleString()} – £{priceRange.maxPriceGBP.toLocaleString()}</span>
                    </p>
                  )}
                  <p className="text-apple-gray-500">
                    We'll be in touch within 24 hours.
                  </p>
                </motion.div>
              )}
            </div>
          </motion.div>

          {/* Book a Call Card */}
          <motion.div
            initial={{ opacity: 0, x: 30 }}
            animate={inView ? { opacity: 1, x: 0 } : {}}
            transition={{ duration: 0.6, delay: 0.3 }}
          >
            <div className="bg-gradient-to-br from-apple-blue-500 to-apple-blue-600 p-8 rounded-2xl shadow-lg text-white h-full flex flex-col">
              <h3 className="text-xl font-semibold mb-2">
                Prefer to Talk?
              </h3>
              <p className="text-white/80 mb-6">
                Book a free 30-minute consultation with our digital twin experts.
              </p>

              <div className="flex-1 flex flex-col justify-between">
                <ul className="space-y-4 mb-8">
                  <li className="flex items-start gap-3">
                    <CheckCircleIcon className="w-5 h-5 text-apple-blue-200 mt-0.5 flex-shrink-0" />
                    <span className="text-white/90">No obligation</span>
                  </li>
                  <li className="flex items-start gap-3">
                    <CheckCircleIcon className="w-5 h-5 text-apple-blue-200 mt-0.5 flex-shrink-0" />
                    <span className="text-white/90">Expert guidance</span>
                  </li>
                  <li className="flex items-start gap-3">
                    <CheckCircleIcon className="w-5 h-5 text-apple-blue-200 mt-0.5 flex-shrink-0" />
                    <span className="text-white/90">Video call via Google Meet</span>
                  </li>
                </ul>

                <Button
                  variant="secondary"
                  size="lg"
                  className="w-full bg-white text-apple-blue-600 hover:bg-apple-gray-50"
                  onClick={() => setIsCalendlyOpen(true)}
                >
                  Book a Free Call
                </Button>
              </div>
            </div>
          </motion.div>
        </div>

        {/* Calendly Modal */}
        <CalendlyModal
          isOpen={isCalendlyOpen}
          onClose={() => setIsCalendlyOpen(false)}
        />

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

function PriceTagIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
    </svg>
  );
}
