// PM2 Ecosystem Configuration for Beyex.com
//
// QUICK REFERENCE:
//   npm run pm2:start      - Start production (nginx serves static files)
//   npm run pm2:dev        - Start dev server on port 3000
//   npm run pm2:stop       - Stop all PM2 processes
//   npm run pm2:restart    - Restart all PM2 processes
//   npm run pm2:logs       - View logs
//   npm run pm2:status     - Show status
//
// DIRECT PM2 COMMANDS:
//   pm2 start ecosystem.config.cjs --only beyex-dev
//   pm2 start ecosystem.config.cjs --only beyex-preview
//   pm2 stop beyex-dev
//   pm2 restart beyex-preview
//   pm2 monit              - Interactive monitoring dashboard

module.exports = {
  apps: [
    // Development server - use for local development
    {
      name: 'beyex-dev',
      script: 'npm',
      args: 'run dev',
      cwd: '/home/beyex/beyex/react_site',
      env: {
        NODE_ENV: 'development',
      },
      watch: ['src'],
      ignore_watch: ['node_modules', 'dist', 'logs'],
      autorestart: true,
      max_restarts: 5,
      restart_delay: 1000,
    },

    // Preview server - serves built files (alternative to nginx)
    {
      name: 'beyex-preview',
      script: 'npm',
      args: 'run preview -- --host 0.0.0.0 --port 4173',
      cwd: '/home/beyex/beyex/react_site',
      env: {
        NODE_ENV: 'production',
      },
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '500M',
      max_restarts: 10,
      restart_delay: 1000,
    },

    // API server - handles contact form emails via Resend
    {
      name: 'beyex-api',
      script: 'server/index.js',
      cwd: '/home/beyex/beyex/react_site',
      env: {
        NODE_ENV: 'production',
        PORT: 3002,
      },
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '200M',
      max_restarts: 10,
      restart_delay: 1000,
    },
  ],
};
