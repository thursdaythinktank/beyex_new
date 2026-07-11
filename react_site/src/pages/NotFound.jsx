import { Link } from 'react-router-dom';
import { SEOHead } from '../components/SEOHead';
import { Button } from '../components/ui/Button';

export default function NotFound() {
  return (
    <>
      <SEOHead
        title="Page Not Found — Beyex"
        description="The page you're looking for doesn't exist. Return to Beyex for immersive 3D virtual tours and digital twins across the UK."
        noindex={true}
      />
      <main className="min-h-screen flex items-center justify-center bg-white px-6">
        <div className="text-center max-w-md">
          <p className="text-8xl font-bold text-apple-blue-500 leading-none">404</p>
          <h1 className="mt-4 text-2xl font-semibold text-apple-gray-900">
            This page doesn't exist
          </h1>
          <p className="mt-3 text-base text-apple-gray-500">
            The URL may have changed or the page has been removed.
          </p>
          <div className="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
            <Button onClick={() => window.location.href = '/'} variant="primary">
              Go to Home
            </Button>
            <Link
              to="/pricing"
              className="inline-flex items-center justify-center px-6 py-3 text-base font-medium rounded-lg border border-apple-gray-300 text-apple-gray-900 hover:border-apple-gray-400 hover:bg-apple-gray-50 transition-all"
            >
              View Pricing
            </Link>
            <Link
              to="/contact"
              className="inline-flex items-center justify-center px-6 py-3 text-base font-medium rounded-lg border border-apple-gray-300 text-apple-gray-900 hover:border-apple-gray-400 hover:bg-apple-gray-50 transition-all"
            >
              Contact Us
            </Link>
          </div>
        </div>
      </main>
    </>
  );
}
