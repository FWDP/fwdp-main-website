/**
 * FWDP Theme - Main JS
 * ---------------------------------------
 * Handles interactivity, customizer live preview, and responsive UI.
 * Uses TailwindCSS and simple DOM utilities.
 */

class FWDPTheme {
  constructor() {
    this.init();
  }

  init() {
    document.addEventListener('DOMContentLoaded', () => {
      console.log('%cFWDP Theme Loaded', 'color: #1e40af; font-weight: bold;');

      this.handleMenuToggle();
      this.observeThemeColor();
    });
  }

  handleMenuToggle() {
    const toggle = document.querySelector('[data-menu-toggle]');
    const menu = document.querySelector('[data-menu]');

    if (!toggle || !menu) return;

    toggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
      menu.classList.toggle('flex');
    });
  }

  observeThemeColor() {
    // Example: dynamic update if Customizer changes the primary color (AJAX / wp.customize)
    if (typeof wp !== 'undefined' && wp.customize) {
      wp.customize('primary_color', (value) => {
        value.bind((newColor) => {
          document.documentElement.style.setProperty('--primary-color', newColor);
        });
      });
    }
  }
}

// Instantiate FWDPTheme globally
window.FWDP = new FWDPTheme();
