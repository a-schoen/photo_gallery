import axios from 'axios';

export class AdminPage {
  constructor() {
    this.goToEditBtn = document.querySelector('.edit-btn');
    this.goToSortBtn = document.querySelector('.sort-this');
    this.saveSortBtn = document.getElementById('sort-btn');
    this.sortableGallery = document.getElementById('sortable-list');
    if (this.sortableGallery) {
      this.sortableGalleryItems = this.sortableGallery.querySelectorAll('.img-list-display');
    }
  }

  init() {
    this.setAdminEvents();
  }

  setAdminEvents() {
    if (this.goToEditBtn) {
      this.goToEditBtn.addEventListener('click', this.goToEditPage.bind(this));
    }

    if (this.goToSortBtn) {
      this.goToSortBtn.addEventListener('click', this.goToSortPage.bind(this));
    }

    if (this.saveSortBtn) {
      this.saveSortBtn.addEventListener('click', this.saveGalleryOrder.bind(this));
    }

    if (this.sortableGallery) {
      this.sortableGallery.addEventListener('dragover', (event) => {
        event.preventDefault();
      });
      this.sortableGalleryItems.forEach((item) => {
        item.addEventListener('dragover', (event) => {
          item.style.paddingTop = '50px';
        });
        item.addEventListener('dragleave', (event) => {
          item.style.paddingTop = '0';
        }, false);
        item.addEventListener('dragstart', (event) => {
          event.dataTransfer.setData('text', event.target.getAttribute('id'));
        });
        item.addEventListener('drop', this.sortListDropHandler.bind(this), false);
      });
    }
  }

  goToEditPage() {
    window.location.replace(document.URL + '&edit');
  }

  goToSortPage() {
    const currentUrl = window.location.href;
    window.location.href = currentUrl.replace('&edit', '&sort');
  }

  sortListDropHandler(event) {
    event.preventDefault();
    const draggedEl = document.getElementById(event.dataTransfer.getData('text'));
    const targetEl = event.target.closest('li');
    targetEl.style.paddingTop = 0;
    const parentNode = targetEl.parentNode;
    parentNode.insertBefore(draggedEl, targetEl);
  }

  saveGalleryOrder() {
    const galleryId = this.sortableGallery.getAttribute('data-gallery');
    const itemsOrder = [];
    const currentItems = this.sortableGallery.querySelectorAll('li');
    currentItems.forEach((item) => {
      itemsOrder.push(item.id);
    });

    // local server
    const url = './api/api_sort.php';

    // production server
    // const url = '/api/api_sort.php'

    axios({
      method: 'post',
      url: url,
      data: {
        list: itemsOrder,
        gallery: galleryId,
      },
    }).then((response) => {
      // console.log(response);
      location.reload();
    }).catch((err) => {
      // eslint-disable-next-line no-console
      console.log('could not send gallery order data: ', err.message);
    });
  }
}
