export class Page {
  static closeSubmenuHandler(event) {
    if (!event.target.closest('.has-submenu')) {
      event.preventDefault();
      Page.closeSubmenu();
    }
  }

  static closeSubmenu(event) {
    document.querySelector('.has-submenu').classList.remove('open');
    document.body.removeEventListener('click', Page.closeSubmenuHandler);
  }

  constructor() {
    this.hasSubmenu = document.querySelector('.has-submenu');
    this.hasSubmenuLink = document.getElementById('has-submenu-link');
    this.adminLoginOpenBtn = document.querySelector('.admin-login-btn');
    this.adminLoginCloseBtn = document.querySelector('.admin-login-close');
  }

  init() {
    this.setPageEvents();
  }

  setPageEvents() {
    this.hasSubmenuLink.addEventListener('click', this.openSubmenu.bind(this));
    this.adminLoginForm = document.querySelector('.admin-login-form');
    this.adminLoginOpenBtn.addEventListener('click', this.openAdminLogin.bind(this));
    this.adminLoginCloseBtn.addEventListener('click', this.closeAdminLogin.bind(this));
  }

  openSubmenu(event) {
    event.stopPropagation();
    event.preventDefault();
    this.hasSubmenu.classList.add('open');
    document.body.addEventListener('click', Page.closeSubmenuHandler);
  }

  openAdminLogin() {
    this.adminLoginForm.classList.add('showing');
  }

  closeAdminLogin() {
    this.adminLoginForm.classList.remove('showing');
  }
}
