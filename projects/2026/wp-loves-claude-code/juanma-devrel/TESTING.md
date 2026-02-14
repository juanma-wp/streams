# Testing Guide for JuanMa DevRel Theme

## What Could Break

### 1. **Theme.json Syntax Errors**
- **Risk**: Invalid JSON will prevent the theme from loading styles
- **Test**: Validate theme.json with `jsonlint` or WordPress theme checker
- **Symptoms**: Missing colors in Site Editor, typography not applying

### 2. **Template Part References**
- **Risk**: If header/footer slugs don't match filenames, parts won't load
- **Test**: Activate theme and check frontend for header/footer
- **Symptoms**: Missing navigation or footer on pages

### 3. **Pattern Registration**
- **Risk**: PHP syntax errors in pattern files prevent pattern loading
- **Test**: Check Site Editor → Patterns for all 5 patterns
- **Symptoms**: Patterns missing from inserter

### 4. **Responsive Layout**
- **Risk**: Bento grid may break on mobile devices
- **Test**: Test on mobile viewport (< 768px)
- **Symptoms**: Overlapping cards, horizontal scroll

### 5. **Font Loading**
- **Risk**: Google Fonts may fail to load (GDPR, network issues)
- **Test**: Check DevTools Network tab for font requests
- **Symptoms**: Fallback to system fonts

### 6. **Custom CSS Conflicts**
- **Risk**: Inline styles in functions.php may conflict with plugins
- **Test**: Install common plugins (Yoast, WooCommerce) and check for conflicts
- **Symptoms**: Broken layouts, style overrides

### 7. **Block Markup Changes**
- **Risk**: WordPress core block HTML changes in future versions
- **Test**: Test with WP beta releases
- **Symptoms**: Blocks not rendering correctly

### 8. **Navigation Menu**
- **Risk**: No menu created by default, navigation will be empty
- **Test**: Create a navigation menu in Appearance → Menus
- **Symptoms**: Empty header navigation area

## Testing Checklist

### Pre-Activation Tests
- [ ] Run `wp theme check juanma-devrel` (if using WP-CLI)
- [ ] Validate `theme.json` syntax
- [ ] Check PHP syntax: `php -l functions.php`

### Post-Activation Tests

#### Site Editor (Appearance → Editor)
- [ ] All patterns visible in inserter (5 total)
- [ ] Templates load without errors (index.html)
- [ ] Template parts load (header, footer)
- [ ] Style variations folder detected
- [ ] Color palette shows 13 colors
- [ ] Typography presets show Inter font
- [ ] Spacing scale has 6 options

#### Frontend Tests
- [ ] **Homepage loads correctly**
  - [ ] Header with logo and navigation
  - [ ] Hero section with animated status badge
  - [ ] Bento grid with 2-column featured card
  - [ ] Dark stack card displays properly
  - [ ] 3 article cards in row
  - [ ] Newsletter section with form
  - [ ] Footer with copyright

- [ ] **Responsive Design**
  - [ ] Desktop (> 1024px): 3-column grid
  - [ ] Tablet (768px-1024px): 2-column layout
  - [ ] Mobile (< 768px): Single column stack
  - [ ] No horizontal scrolling
  - [ ] Touch targets > 44px on mobile

- [ ] **Typography**
  - [ ] Inter font loads (check DevTools)
  - [ ] Font sizes are responsive
  - [ ] Line heights are readable
  - [ ] Text doesn't overflow containers

- [ ] **Colors & Styling**
  - [ ] Zinc color palette applies correctly
  - [ ] Border colors visible (#e4e4e7)
  - [ ] Hover states work on links
  - [ ] Button hover changes color
  - [ ] Status badge animation runs (ping effect)

- [ ] **Navigation**
  - [ ] Sticky header stays at top on scroll
  - [ ] Backdrop blur effect visible (if browser supports)
  - [ ] Navigation links work
  - [ ] Mobile menu toggles (if set up)

- [ ] **Forms**
  - [ ] Newsletter email input accepts text
  - [ ] Subscribe button is clickable
  - [ ] Form validation works (if connected to service)

### Browser Testing
Test in these browsers:
- [ ] Chrome/Edge (Chromium)
- [ ] Firefox
- [ ] Safari (macOS/iOS)
- [ ] Mobile browsers (iOS Safari, Chrome Android)

### Accessibility Tests
- [ ] Run Lighthouse audit (aim for 90+ accessibility score)
- [ ] Test keyboard navigation (Tab through all links)
- [ ] Check color contrast (WCAG AA minimum)
- [ ] Screen reader test (NVDA/JAWS/VoiceOver)
- [ ] Heading hierarchy is logical (H1 → H2 → H3)

### Performance Tests
- [ ] Run Lighthouse performance audit (aim for 90+)
- [ ] Check Core Web Vitals
  - [ ] LCP < 2.5s
  - [ ] FID < 100ms
  - [ ] CLS < 0.1
- [ ] Test on slow 3G network
- [ ] Ensure no layout shifts on load

## Common Issues & Fixes

### Issue: Patterns don't appear in inserter
**Fix**: Check pattern PHP files for syntax errors. Patterns must be in `patterns/` folder with `.php` extension.

### Issue: Colors not showing in Site Editor
**Fix**: Validate `theme.json` syntax. Check that color slugs match usage in templates.

### Issue: Sticky header not working
**Fix**: Ensure browser supports `position: sticky`. Check that parent containers don't have `overflow: hidden`.

### Issue: Google Fonts not loading
**Fix**: Check browser console for CORS errors. Consider self-hosting fonts for GDPR compliance.

### Issue: Backdrop blur not visible
**Fix**: Backdrop blur requires browser support. Fallback will use solid background color.

### Issue: Mobile layout broken
**Fix**: Test breakpoint CSS. WordPress may need custom CSS media queries for column stacking.

### Issue: Newsletter form doesn't submit
**Fix**: Form is HTML only. Connect to Mailchimp, ConvertKit, or use WordPress form plugin.

## Suggested Test Coverage

### Manual Testing (Priority)
1. **Smoke test**: Activate theme, view homepage ✅
2. **Navigation test**: Click all nav links, check they work
3. **Pattern test**: Insert each pattern in post editor
4. **Mobile test**: Resize browser to 375px width
5. **Edit test**: Modify a pattern in Site Editor and save

### Automated Testing (Optional)
- **E2E Tests**: Use Playwright to test critical user paths
- **Visual Regression**: Use Percy or Chromatic for screenshot diffs
- **Theme Check**: Run WordPress.org theme review checks

## Monitoring in Production

After deployment, monitor for:
- **404 errors**: Broken pattern/template references
- **Console errors**: JS/CSS loading failures
- **Font loading**: Check if Google Fonts loads successfully
- **Performance**: Track Core Web Vitals in Search Console
- **User reports**: Gather feedback on mobile experience

## Rollback Plan

If theme breaks production:
1. Switch to Twenty Twenty-Four (default FSE theme)
2. Check error logs for PHP/JS errors
3. Restore from backup
4. Test in staging before re-deploying

---

**Last Updated**: 2025-02-13
**Theme Version**: 1.0.0
**Tested With**: WordPress 6.7+
