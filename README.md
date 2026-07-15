# PixelPress Pro Image Compressor

A premium PHP SaaS-style image compression website with 500+ generated tool pages, reusable header/footer, SEO metadata, legal pages, and working GD-based upload compression.

## Run locally

```bash
php -S 127.0.0.1:8000
```

Open `http://127.0.0.1:8000`.

## Add or edit tools manually

Edit `tools-data.php`:

- Add use cases in `$PRESETS`.
- Add file formats in `$FORMATS`.
- Add target sizes in `$TARGETS`.

Every combination creates a dedicated URL such as `/tools/compress-passport-photo-jpg-to-20kb`.
