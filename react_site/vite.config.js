import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  plugins: [react()],
  server: {
    host: '0.0.0.0',
    port: 3000,
    allowedHosts: ['srv1182897.hstgr.cloud', 'beyex.com', 'www.beyex.com', 'localhost'],
    proxy: {
      '/api': {
        target: 'http://localhost:3002',
        changeOrigin: true,
      },
    },
  },
  build: {
    modulePreload: {
      resolveDependencies: (filename, deps) => {
        // Don't preload Three.js/WebGL chunks - they're lazy-loaded
        return deps.filter(dep => !dep.includes('three') && !dep.includes('WebGL') && !dep.includes('webgl') && !dep.includes('drei') && !dep.includes('fiber') && !dep.includes('postprocessing'));
      },
    },
    rollupOptions: {
      output: {
        manualChunks: {
          'react-vendor': ['react', 'react-dom'],
          'motion-vendor': ['framer-motion'],
          'router-vendor': ['react-router-dom'],
        },
      },
    },
  },
})
