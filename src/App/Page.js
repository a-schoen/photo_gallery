export class Page {
  constructor() {
    this.adminLoginOpenBtn = document.querySelector('.admin-login-btn');
    this.adminLoginCloseBtn = document.querySelector('.admin-login-close');
  }

  init() {
    this.setPageEvents();
  }

  setPageEvents() {
    this.adminLoginForm = document.querySelector('.admin-login-form');
    this.adminLoginOpenBtn.addEventListener('click', this.openAdminLogin.bind(this));
    this.adminLoginCloseBtn.addEventListener('click', this.closeAdminLogin.bind(this));
  }

  openAdminLogin() {
    this.adminLoginForm.classList.add('showing');
  }

  closeAdminLogin() {
    this.adminLoginForm.classList.remove('showing');
  }
}
