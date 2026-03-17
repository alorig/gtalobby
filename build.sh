#!/bin/bash
# GtaLobby — CSS/JS Minification Build Script
#
# Requires: npm install -g clean-css-cli uglify-js
# Or run: npm install (uses local devDependencies from package.json)
#
# Usage: bash build.sh

set -e

echo "=== GtaLobby Build ==="

# Directories
CSS_DIR="css"
JS_DIR="js"
DIST_CSS="dist/css"
DIST_JS="dist/js"

# Create dist directories
mkdir -p "$DIST_CSS" "$DIST_JS"

# Minify CSS files
echo "Minifying CSS..."
for file in "$CSS_DIR"/*.css; do
    filename=$(basename "$file")
    if command -v cleancss &> /dev/null; then
        cleancss -o "$DIST_CSS/$filename" "$file"
    elif command -v npx &> /dev/null; then
        npx clean-css-cli -o "$DIST_CSS/$filename" "$file"
    else
        cp "$file" "$DIST_CSS/$filename"
        echo "  [copy] $filename (no minifier found)"
        continue
    fi
    original=$(wc -c < "$file")
    minified=$(wc -c < "$DIST_CSS/$filename")
    echo "  $filename: ${original}B -> ${minified}B"
done

# Minify JS files
echo "Minifying JS..."
for file in "$JS_DIR"/*.js; do
    filename=$(basename "$file")
    # Skip admin-only files in production
    if command -v uglifyjs &> /dev/null; then
        uglifyjs "$file" -o "$DIST_JS/$filename" -c -m
    elif command -v npx &> /dev/null; then
        npx uglify-js "$file" -o "$DIST_JS/$filename" -c -m
    else
        cp "$file" "$DIST_JS/$filename"
        echo "  [copy] $filename (no minifier found)"
        continue
    fi
    original=$(wc -c < "$file")
    minified=$(wc -c < "$DIST_JS/$filename")
    echo "  $filename: ${original}B -> ${minified}B"
done

echo "=== Build Complete ==="
echo "Minified files are in dist/css and dist/js"
echo ""
echo "To use minified files in production, update inc/enqueue.php:"
echo "  Change '/css/' to '/dist/css/' and '/js/' to '/dist/js/'"
