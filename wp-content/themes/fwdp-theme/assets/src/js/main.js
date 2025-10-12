/**
 * FWDP Theme - Main JS
 * ---------------------------------------
 * Handles interactivity, Customizer live preview, and responsive UI.
 * Built for TailwindCSS and OOP-based WordPress theme structure.
 */

class FWDPTheme {
  constructor() {
    this.toggle = null;
    this.menu = null;
    this.darkModeMedia = window.matchMedia('(prefers-color-scheme: dark)');
    this.init();
  }

  init() {
    document.addEventListener('DOMContentLoaded', () => {
      console.log('%cFWDP Theme Loaded', 'color: #2563eb; font-weight: bold;');

      this.toggle = document.querySelector('[data-menu-toggle]');
      this.menu = document.querySelector('[data-menu]');
      
      this.handleMenuToggle();
      this.observeThemeColor();
      this.handleDarkModePreference();
      this.handleTabs();
    });
  }

  /**
   * Handles responsive mobile menu toggle
   */
  handleMenuToggle() {
    if (!this.toggle || !this.menu) return;

    this.toggle.addEventListener('click', () => {
      const isHidden = this.menu.classList.contains('hidden');
      this.menu.classList.toggle('hidden', !isHidden);
      this.menu.classList.toggle('flex', isHidden);

      // Add Tailwind transition animation
      this.menu.classList.add('transition-all', 'duration-300');
    });
  }

  /**
   * Observes Customizer live changes to primary color
   */
  observeThemeColor() {
    if (typeof wp !== 'undefined' && wp.customize) {
      wp.customize('primary_color', (value) => {
        value.bind((newColor) => {
          document.documentElement.style.setProperty('--primary-color', newColor);
          document.querySelectorAll('[data-primary-bg]').forEach((el) => {
            el.style.backgroundColor = newColor;
          });
        });
      });
    }
  }

  /**
   * Handles automatic dark mode detection + sync
   */
  handleDarkModePreference() {
    const applyDarkMode = (isDark) => {
      document.documentElement.classList.toggle('dark', isDark);
    };

    // Initial check
    applyDarkMode(this.darkModeMedia.matches);

    // React to changes
    this.darkModeMedia.addEventListener('change', (e) => {
      applyDarkMode(e.matches);
    });
  }
}

// Instantiate FWDPTheme globally
window.FWDP = new FWDPTheme();
