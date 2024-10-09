import './bootstrap';
import { 
  HSOverlay,
  HSStaticMethods,
  HSDropdown,
  HSCollapse,
  HSAccordion,
  HSTabs
} from 'flyonui/flyonui';

// Import Alpine.js
import Alpine from 'alpinejs';


// Mengatur komponen FlyonUI sebagai variabel global
window.HSOverlay = HSOverlay;
window.HSStaticMethods = HSStaticMethods;
window.HSDropdown = HSDropdown;
window.HSCollapse = HSCollapse;
window.HSAccordion = HSAccordion;
window.HSTabs = HSTabs;
window.Alpine = Alpine;
Alpine.start();
