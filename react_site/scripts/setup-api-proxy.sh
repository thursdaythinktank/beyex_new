#!/bin/bash
# Setup nginx API proxy for Beyex contact form

NGINX_CONF="/etc/nginx/sites-available/beyex.com"

# Check if api location already exists
if grep -q "location /api" "$NGINX_CONF" 2>/dev/null; then
    echo "API proxy already configured in nginx"
    exit 0
fi

# Create backup
sudo cp "$NGINX_CONF" "${NGINX_CONF}.backup.$(date +%Y%m%d%H%M%S)"

# Add API proxy location before the first location block
# This inserts the API proxy config after the ssl_certificate lines
sudo sed -i '/location \/ {/i \
    # API proxy for contact form\
    location /api {\
        proxy_pass http://127.0.0.1:3001;\
        proxy_http_version 1.1;\
        proxy_set_header Host $host;\
        proxy_set_header X-Real-IP $remote_addr;\
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;\
        proxy_set_header X-Forwarded-Proto $scheme;\
    }\
' "$NGINX_CONF"

# Test nginx config
sudo nginx -t

if [ $? -eq 0 ]; then
    echo "Nginx config is valid. Reloading..."
    sudo systemctl reload nginx
    echo "Done! API proxy is now active."
else
    echo "Nginx config test failed. Restoring backup..."
    sudo cp "${NGINX_CONF}.backup."* "$NGINX_CONF"
    exit 1
fi
