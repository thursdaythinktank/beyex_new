#!/bin/bash
# Production setup script for Beyex.com
# Run with: sudo bash scripts/setup-production.sh

set -e

echo "============================================"
echo "  Beyex.com Production Setup"
echo "============================================"
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if running as root
if [ "$EUID" -ne 0 ]; then
    echo -e "${RED}Error: Please run with sudo: sudo bash scripts/setup-production.sh${NC}"
    exit 1
fi

SITE_DIR="/home/beyex/beyex/react_site"
NGINX_CONF="$SITE_DIR/nginx/beyex.com.conf"
DOMAIN="beyex.com"

# ============================================
# Step 1: Install nginx
# ============================================
echo -e "${YELLOW}Step 1: Checking nginx installation...${NC}"
if ! command -v nginx &> /dev/null; then
    echo "   Installing nginx..."
    apt-get update -qq
    apt-get install -y nginx
    echo -e "${GREEN}   ✓ Nginx installed${NC}"
else
    echo -e "${GREEN}   ✓ Nginx already installed ($(nginx -v 2>&1 | cut -d'/' -f2))${NC}"
fi

# ============================================
# Step 2: Install certbot
# ============================================
echo ""
echo -e "${YELLOW}Step 2: Checking certbot installation...${NC}"
if ! command -v certbot &> /dev/null; then
    echo "   Installing certbot..."
    apt-get install -y certbot python3-certbot-nginx
    echo -e "${GREEN}   ✓ Certbot installed${NC}"
else
    echo -e "${GREEN}   ✓ Certbot already installed ($(certbot --version 2>&1 | head -1))${NC}"
fi

# ============================================
# Step 3: Check/configure firewall
# ============================================
echo ""
echo -e "${YELLOW}Step 3: Checking firewall configuration...${NC}"
if command -v ufw &> /dev/null; then
    UFW_STATUS=$(ufw status | head -1)
    if [[ "$UFW_STATUS" == *"active"* ]]; then
        echo "   UFW is active, allowing HTTP and HTTPS..."
        ufw allow 'Nginx Full' 2>/dev/null || ufw allow 80,443/tcp
        echo -e "${GREEN}   ✓ Firewall configured for HTTP/HTTPS${NC}"
    else
        echo -e "${GREEN}   ✓ UFW is inactive, no changes needed${NC}"
    fi
else
    echo -e "${GREEN}   ✓ No UFW firewall detected${NC}"
fi

# ============================================
# Step 4: Verify dist folder exists
# ============================================
echo ""
echo -e "${YELLOW}Step 4: Verifying production build...${NC}"
if [ -d "$SITE_DIR/dist" ] && [ -f "$SITE_DIR/dist/index.html" ]; then
    DIST_SIZE=$(du -sh "$SITE_DIR/dist" | cut -f1)
    echo -e "${GREEN}   ✓ Production build exists ($DIST_SIZE)${NC}"
else
    echo -e "${RED}   ✗ No production build found!${NC}"
    echo "   Run: cd $SITE_DIR && npm run build"
    exit 1
fi

# ============================================
# Step 5: Copy nginx configuration
# ============================================
echo ""
echo -e "${YELLOW}Step 5: Setting up nginx configuration...${NC}"
if [ ! -f "$NGINX_CONF" ]; then
    echo -e "${RED}   ✗ Nginx config not found at $NGINX_CONF${NC}"
    exit 1
fi

cp "$NGINX_CONF" /etc/nginx/sites-available/beyex.com
echo "   ✓ Configuration copied to /etc/nginx/sites-available/"

# Remove default config if it exists and conflicts
if [ -f "/etc/nginx/sites-enabled/default" ]; then
    rm -f /etc/nginx/sites-enabled/default
    echo "   ✓ Removed default nginx config"
fi

# Create symlink
ln -sf /etc/nginx/sites-available/beyex.com /etc/nginx/sites-enabled/
echo -e "${GREEN}   ✓ Configuration enabled${NC}"

# ============================================
# Step 6: Test nginx configuration
# ============================================
echo ""
echo -e "${YELLOW}Step 6: Testing nginx configuration...${NC}"
if nginx -t 2>&1 | grep -q "successful"; then
    echo -e "${GREEN}   ✓ Nginx configuration is valid${NC}"
else
    echo -e "${RED}   ✗ Nginx configuration error:${NC}"
    nginx -t
    exit 1
fi

# ============================================
# Step 7: Start/reload nginx
# ============================================
echo ""
echo -e "${YELLOW}Step 7: Starting nginx...${NC}"
systemctl enable nginx
systemctl reload nginx 2>/dev/null || systemctl start nginx
echo -e "${GREEN}   ✓ Nginx is running${NC}"

# ============================================
# Step 8: Verify HTTP is working
# ============================================
echo ""
echo -e "${YELLOW}Step 8: Verifying HTTP access...${NC}"
sleep 2
if curl -s -o /dev/null -w "%{http_code}" http://localhost | grep -q "200"; then
    echo -e "${GREEN}   ✓ HTTP is working (localhost)${NC}"
else
    echo -e "${YELLOW}   ⚠ Could not verify HTTP locally${NC}"
fi

# ============================================
# Step 9: SSL Certificate Instructions
# ============================================
echo ""
echo "============================================"
echo -e "${GREEN}  Setup Complete!${NC}"
echo "============================================"
echo ""
echo "Next steps to enable HTTPS:"
echo ""
echo "  1. Ensure DNS for beyex.com and www.beyex.com"
echo "     points to this server ($(curl -s ifconfig.me 2>/dev/null || echo 'IP_ADDRESS'))"
echo ""
echo "  2. Get SSL certificates:"
echo -e "     ${YELLOW}sudo certbot --nginx -d beyex.com -d www.beyex.com${NC}"
echo ""
echo "  3. After certbot succeeds, add HSTS header manually:"
echo "     Edit /etc/nginx/sites-available/beyex.com"
echo "     Add to the HTTPS server block:"
echo '     add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;'
echo ""
echo "  4. Reload nginx:"
echo -e "     ${YELLOW}sudo systemctl reload nginx${NC}"
echo ""
echo "  5. Verify:"
echo "     curl -I https://beyex.com"
echo "     curl -I https://www.beyex.com"
echo ""
echo "For future deployments:"
echo "  cd $SITE_DIR && npm run build"
echo "  (Nginx serves directly from dist/, no restart needed)"
echo ""
