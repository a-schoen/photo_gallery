import {Gallery} from './Gallery';

export class ImageView extends Gallery {
  constructor() {
    super();
    this.mainImageWrapper = document.querySelector('.image-display');
    this.mainImageEl = this.mainImageWrapper.querySelector('.slider-img');
    this.currentGalleryId;
    this.openSliderBtn = document.getElementById('image-click-text');
    this.sliderBtns = document.querySelectorAll('.fullview-btn');
    this.imgClickText = document.getElementById('image-click-text');
    this.closeSliderBtn = document.querySelector('.gallery-back-btn');
    this.nextSlideBtn = document.querySelector('.slide-forward');
    this.prevSlideBtn = document.querySelector('.slide-back');
    this.slideShowBtn = document.getElementById('play');
    this.sliderState = {
      currentNr: null,
      prevImg: null,
      nextImg: null,
      photoData: [],
      startNr: null,
      gallerySize: null,
      play: false,
      fadeTime: null,
      showTime: null,
      interval: null,
    };
    this.slideInterval;
  }

  init() {
    this.currentGalleryId = this.getCurrentGallery();
    this.setSliderEvents();

    this.getGalleryData(this.currentGalleryId).then((response) => {
      this.setSliderState(response.data);
      this.updateSliderState(this.sliderState.startNr);
    }).catch((err) => {
      // eslint-disable-next-line no-console
      console.log('failed to load gallery data:', err.message);
    });
  }

  setSliderEvents() {
    this.openSliderBtn.addEventListener('click', this.openSlider.bind(this));
    this.closeSliderBtn.addEventListener('click', this.closeSlider.bind(this));
    this.nextSlideBtn.addEventListener('click', this.nextSlide.bind(this));
    this.prevSlideBtn.addEventListener('click', this.prevSlide.bind(this));
    this.slideShowBtn.addEventListener('click', this.toggleSlideShow.bind(this));
  }

  getCurrentGallery() {
    const urlQuery = window.location.search;
    const urlParams = new URLSearchParams(urlQuery);
    const id = urlParams.get('in_gallery');
    return id;
  }

  setSliderState(data) {
    this.sliderState.photoData = data['photoData'];
    this.sliderState.gallerySize = parseInt(data['gallerySize']) - 1;
    this.sliderState.fadeTime = parseInt(data['settings']['fadeTime']);
    this.sliderState.showTime = parseInt(data['settings']['showTime']);
    this.sliderState.interval = (parseInt(this.sliderState.fadeTime ) * 2) + parseInt(this.sliderState.showTime) + 1500;
    this.sliderState.startNr = parseInt(this.mainImageEl.getAttribute('data-order-nr'));
  }

  openSlider() {
    this.mainImageWrapper.classList.add('full-screen-display');
  }

  closeSlider() {
    this.sliderState.play = false;
    this.setImage(this.sliderState.startNr).then(() => {
      this.mainImageWrapper.classList.remove('full-screen-display');
    });
  }

  resetSlider() {
    this.setImage(this.sliderState.startNr).then(() => {
      this.mainImageWrapper.classList.remove('full-screen-display');
    });
  }

  setImage(slideNr) {
    return new Promise((resolve) => {
      const index = slideNr - 1;
      const newUrl = this.sliderState.photoData[parseInt(index)]['url'];
      const newImage = new Image();
      newImage.src = newUrl;

      newImage.onload = () => {
        newImage.classList.add('slider-img', 'img-view');
        newImage.setAttribute('data-start-id', this.sliderState.startNr);
        newImage.setAttribute('data-order-nr', slideNr);
        this.mainImageWrapper.querySelector('img').remove();
        this.mainImageWrapper.append(newImage);
        this.mainImageEl = this.mainImageWrapper.querySelector('img');
        resolve();
      };
    });
  }

  nextSlide() {
    this.changeSlide(this.sliderState.nextImg);
  }

  prevSlide() {
    this.changeSlide(this.sliderState.prevImg);
  }

  updateSliderState(imgNr) {
    this.sliderState.currentNr = parseInt(imgNr);

    let newPrevImg = this.sliderState.currentNr - 1;
    if (newPrevImg < 1) {
      newPrevImg = this.sliderState.gallerySize + 1;
    }
    this.sliderState.prevImg = newPrevImg;

    let newNextImg = this.sliderState.currentNr + 1;
    if (newNextImg > this.sliderState.gallerySize) {
      newNextImg = 1;
    }
    this.sliderState.nextImg = newNextImg;
  }

  fadeOutImg(time, mode) {
    return new Promise((resolve) => {
      if (this.sliderState.play === false && mode === 'auto') {
        resolve();
      } else {
        setTimeout(() => {
          resolve();
        }, time);

        this.mainImageEl.animate([
          {opacity: 1},
          {opacity: 0},
        ], {
          duration: time,
          fill: 'forwards',
        });
      };
    });
  }

  fadeInImg(time) {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve();
      }, time);

      this.mainImageEl.animate([
        {opacity: 0},
        {opacity: 1},
      ], {
        duration: time,
        fill: 'forwards',
      });
    });
  }

  keepImage(time) {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve();
      }, time);
    });
  }

  async changeSlide(slideId, mode) {
    if (this.sliderState.play === false) {
      this.setNavButtonsDisabled(true, mode);
    }
    await this.fadeOutImg(this.sliderState.fadeTime, mode);
    if (this.sliderState.play === false && mode === 'auto') {
      return;
    }
    await this.setImage(slideId);
    this.updateSliderState(slideId);
    await this.fadeInImg(this.sliderState.fadeTime);
    if (this.sliderState.play === false) {
      this.setNavButtonsDisabled(false);
    } else {
      await this.keepImage(this.sliderState.showTime);
      this.changeSlide(this.sliderState.nextImg, 'auto');
    }
  }

  playSlideshow() {
    this.nextSlide();
  }

  setNavButtonsDisabled(disable, mode) {
    if (this.sliderState.play === false && mode === 'auto') {
      disable = false;
    }
    this.nextSlideBtn.disabled = disable;
    this.prevSlideBtn.disabled = disable;
    this.closeSliderBtn.disabled = disable;
  }

  toggleSlideShow(event) {
    if (this.sliderState.play === true) {
      this.setNavButtonsDisabled(false);
      event.target.textContent = 'Slideshow';
      this.sliderState.play = false;
    } else {
      this.setNavButtonsDisabled(true);
      this.sliderState.play = true;
      event.target.textContent = 'Stop';
      this.playSlideshow();
    }
  }
}
