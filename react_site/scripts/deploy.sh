#!/bin/bash
# Deploy script for Beyex.com
# Run with: bash scripts/deploy.sh

set -e

SITE_DIR="/home/beyex/beyex/react_site"

echo "=== Deploying Beyex.com ==="
echo ""

cd "$SITE_DIR"

# Pull latest changes (if using git)
echo "1. Pulling latest changes..."
git pull origin main 2>/dev/null || echo "   (Skipping git pull - not a git repo or no remote)"

# Install dependencies
echo ""
echo "2. Installing dependencies..."
npm ci

# Build production
echo ""
echo "3. Building production version..."
npm run build

# The nginx config serves directly from dist/, so no restart needed
echo ""
echo "=== Deployment Complete! ==="
echo "Site is now live at https://beyex.com"
echo ""
