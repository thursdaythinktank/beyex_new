import { EffectComposer, Bloom, ChromaticAberration, Vignette } from '@react-three/postprocessing';
import { BlendFunction } from 'postprocessing';

/**
 * Post-processing effects for cinematic look
 * - Bloom: Makes particles and lights glow
 * - Chromatic Aberration: Subtle color fringing on edges
 * - Vignette: Darkens edges for cinematic framing
 */
export function PostProcessing({ intensity = 1 }) {
  return (
    <EffectComposer>
      {/* Bloom - makes lights and particles glow */}
      <Bloom
        intensity={0.6 * intensity}
        luminanceThreshold={0.3}
        luminanceSmoothing={0.9}
        mipmapBlur
      />

      {/* Chromatic Aberration - subtle color separation on edges */}
      <ChromaticAberration
        blendFunction={BlendFunction.NORMAL}
        offset={[0.0015 * intensity, 0.0015 * intensity]}
        radialModulation={true}
        modulationOffset={0.5}
      />

      {/* Vignette - darkens edges for cinematic focus */}
      <Vignette
        offset={0.4}
        darkness={0.5 * intensity}
        blendFunction={BlendFunction.NORMAL}
      />
    </EffectComposer>
  );
}
