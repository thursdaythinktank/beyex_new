import { WebGLExperience } from './components/WebGLExperience';
import { Navigation } from './components/Navigation';
import { Hero } from './components/Hero';
import { FeaturedExperiences } from './components/FeaturedExperiences';
import { ProcessFlow } from './components/ProcessFlow';
import { UseCases } from './components/UseCases';
import { GetStarted } from './components/GetStarted';
import { Footer } from './components/Footer';

/**
 * Main App component with WebGL volumetric experience
 * Experience First approach - the tour IS the proof of capability
 */
function App() {
  return (
    <WebGLExperience>
      <div className="relative">
        {/* Fixed navigation */}
        <Navigation />

        {/* Main content sections */}
        <main>
          <Hero />
          <FeaturedExperiences />
          <ProcessFlow />
          <UseCases />
          <GetStarted />
        </main>

        {/* Footer */}
        <Footer />
      </div>
    </WebGLExperience>
  );
}

export default App;
