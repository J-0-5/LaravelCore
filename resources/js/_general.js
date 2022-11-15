export default class General {
  initialize() {
    this.general();
    // this.onLoadImage();
  }

  general() {

    $('.btn-filter').click(() => $('.form-filter').toggle('slow'));
    // document.getElementById('alerta').onclick = function() {
    //     alert("button was clicked");
    //  };
    $(function () {
      $('[data-toggle="popover"]').popover()
    });

    $('.popover-dismiss').popover({
      trigger: 'focus'
    });
  }

  onLoadImage(files){
    console.log(files)
    if (files && files[0]) {
      document
        .getElementById('imgName')
        .innerHTML = files[0].name
    }
  }
}
