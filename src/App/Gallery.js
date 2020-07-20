import axios from 'axios';
import {Page} from './Page';

export class Gallery extends Page {
  constructor() {
    super();

    // localhost
    this.requestPath = './api/api_slider.php';
    // production server
    // this.requestPath = "/api/api_slider.php"
    this.imageData = {};
  }

  getGalleryData(galleryId) {
    const galleryData = axios({
      method: 'get',
      url: this.requestPath,
      params: {'gallery_id': galleryId},
    });
    return galleryData;
  }
}
