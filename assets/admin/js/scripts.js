"use strict";

// ChartJS
if (window.Chart) {
  Chart.defaults.global.defaultFontFamily = "'Nunito', 'Segoe UI', 'Arial'";
  Chart.defaults.global.defaultFontSize = 11;
  Chart.defaults.global.defaultFontStyle = 500;
  Chart.defaults.global.defaultFontColor = "#999";
  Chart.defaults.global.tooltips.backgroundColor = '#000';
  Chart.defaults.global.tooltips.titleFontFamily = "'Nunito', 'Segoe UI', 'Arial'";
  Chart.defaults.global.tooltips.titleFontColor = '#fff';
  Chart.defaults.global.tooltips.titleFontSize = 20;
  Chart.defaults.global.tooltips.xPadding = 10;
  Chart.defaults.global.tooltips.yPadding = 10;
  Chart.defaults.global.tooltips.cornerRadius = 3;
}

// DropzoneJS
if (window.Dropzone) {
  Dropzone.autoDiscover = false;
}

// Basic confirm box
$('[data-confirm]').each(function () {
  var me = $(this),
    me_data = me.data('confirm');

  me_data = me_data.split("|");
  me.fireModal({
    title: me_data[0],
    body: me_data[1],
    buttons: [
      {
        text: me.data('confirm-text-yes') || 'Yes',
        class: 'btn btn-danger btn-shadow',
        handler: function () {
          eval(me.data('confirm-yes'));
        }
      },
      {
        text: me.data('confirm-text-cancel') || 'Cancel',
        class: 'btn btn-secondary',
        handler: function (modal) {
          $.destroyModal(modal);
          eval(me.data('confirm-no'));
        }
      }
    ]
  })
});

// Global
$(function () {
  let sidebar_nicescroll_opts = {
    cursoropacitymin: 0,
    cursoropacitymax: .8,
    zindex: 892
  }, now_layout_class = null;

  var sidebar_sticky = function () {
    if ($("body").hasClass('layout-2')) {
      $("body.layout-2 #sidebar-wrapper").stick_in_parent({
        parent: $('body')
      });
      $("body.layout-2 #sidebar-wrapper").stick_in_parent({ recalc_every: 1 });
    }
  }
  sidebar_sticky();

  var sidebar_nicescroll;
  var update_sidebar_nicescroll = function () {
    let a = setInterval(function () {
      if (sidebar_nicescroll != null)
        sidebar_nicescroll.resize();
    }, 10);

    setTimeout(function () {
      clearInterval(a);
    }, 600);
  }

  var sidebar_dropdown = function () {
    if ($(".main-sidebar").length) {
      $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
      sidebar_nicescroll = $(".main-sidebar").getNiceScroll();

      $(".main-sidebar .sidebar-menu li a.has-dropdown").off('click').on('click', function () {
        var me = $(this);

        me.parent().find('> .dropdown-menu').slideToggle(500, function () {
          update_sidebar_nicescroll();
          return false;
        });
        return false;
      });
    }
  }
  sidebar_dropdown();

  if ($("#top-5-scroll").length) {
    $("#top-5-scroll").css({
      height: 315
    }).niceScroll();
  }

  $(".main-content").css({
    minHeight: $(window).outerHeight() - 95
  })

  $(".nav-collapse-toggle").click(function () {
    $(this).parent().find('.navbar-nav').toggleClass('show');
    return false;
  });

  $(document).on('click', function (e) {
    $(".nav-collapse .navbar-nav").removeClass('show');
  });

  var toggle_sidebar_mini = function (mini) {
    let body = $('body');

    if (!mini) {
      body.removeClass('sidebar-mini');
      $(".main-sidebar").css({
        overflow: 'hidden'
      });
      setTimeout(function () {
        $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
        sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
      }, 500);
      $(".main-sidebar .sidebar-menu > li > ul .dropdown-title").remove();
      $(".main-sidebar .sidebar-menu > li > a").removeAttr('data-toggle');
      $(".main-sidebar .sidebar-menu > li > a").removeAttr('data-original-title');
      $(".main-sidebar .sidebar-menu > li > a").removeAttr('title');
    } else {
      body.addClass('sidebar-mini');
      body.removeClass('sidebar-show');
      sidebar_nicescroll.remove();
      sidebar_nicescroll = null;
      $(".main-sidebar .sidebar-menu > li").each(function () {
        let me = $(this);

        if (me.find('> .dropdown-menu').length) {
          me.find('> .dropdown-menu').hide();
          me.find('> .dropdown-menu').prepend('<li class="dropdown-title pt-3">' + me.find('> a').text() + '</li>');
        } else {
          me.find('> a').attr('data-toggle', 'tooltip');
          me.find('> a').attr('data-original-title', me.find('> a').text());
          $("[data-toggle='tooltip']").tooltip({
            placement: 'right'
          });
        }
      });
    }
  }

  $("[data-toggle='sidebar']").click(function () {
    var body = $("body"),
      w = $(window);

    if (w.outerWidth() <= 1024) {
      body.removeClass('search-show search-gone');
      if (body.hasClass('sidebar-gone')) {
        body.removeClass('sidebar-gone');
        body.addClass('sidebar-show');
      } else {
        body.addClass('sidebar-gone');
        body.removeClass('sidebar-show');
      }

      update_sidebar_nicescroll();
    } else {
      body.removeClass('search-show search-gone');
      if (body.hasClass('sidebar-mini')) {
        toggle_sidebar_mini(false);
      } else {
        toggle_sidebar_mini(true);
      }
    }

    return false;
  });

  var toggleLayout = function () {
    var w = $(window),
      layout_class = $('body').attr('class') || '',
      layout_classes = (layout_class.trim().length > 0 ? layout_class.split(' ') : '');

    if (layout_classes.length > 0) {
      layout_classes.forEach(function (item) {
        if (item.indexOf('layout-') != -1) {
          now_layout_class = item;
        }
      });
    }

    if (w.outerWidth() <= 1024) {
      if ($('body').hasClass('sidebar-mini')) {
        toggle_sidebar_mini(false);
        $('.main-sidebar').niceScroll(sidebar_nicescroll_opts);
        sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
      }

      $("body").addClass("sidebar-gone");
      $("body").removeClass("layout-2 layout-3 sidebar-mini sidebar-show");
      $("body").off('click').on('click', function (e) {
        if ($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
          $("body").removeClass("sidebar-show");
          $("body").addClass("sidebar-gone");
          $("body").removeClass("search-show");

          update_sidebar_nicescroll();
        }
      });

      update_sidebar_nicescroll();

      if (now_layout_class == 'layout-3') {
        let nav_second_classes = $(".navbar-secondary").attr('class'),
          nav_second = $(".navbar-secondary");

        nav_second.attr('data-nav-classes', nav_second_classes);
        nav_second.removeAttr('class');
        nav_second.addClass('main-sidebar');

        let main_sidebar = $(".main-sidebar");
        main_sidebar.find('.container').addClass('sidebar-wrapper').removeClass('container');
        main_sidebar.find('.navbar-nav').addClass('sidebar-menu').removeClass('navbar-nav');
        main_sidebar.find('.sidebar-menu .nav-item.dropdown.show a').click();
        main_sidebar.find('.sidebar-brand').remove();
        main_sidebar.find('.sidebar-menu').before($('<div>', {
          class: 'sidebar-brand'
        }).append(
          $('<a>', {
            href: $('.navbar-brand').attr('href'),
          }).html($('.navbar-brand').html())
        ));
        setTimeout(function () {
          sidebar_nicescroll = main_sidebar.niceScroll(sidebar_nicescroll_opts);
          sidebar_nicescroll = main_sidebar.getNiceScroll();
        }, 700);

        sidebar_dropdown();
        $(".main-wrapper").removeClass("container");
      }
    } else {
      $("body").removeClass("sidebar-gone sidebar-show");
      if (now_layout_class)
        $("body").addClass(now_layout_class);

      let nav_second_classes = $(".main-sidebar").attr('data-nav-classes'),
        nav_second = $(".main-sidebar");

      if (now_layout_class == 'layout-3' && nav_second.hasClass('main-sidebar')) {
        nav_second.find(".sidebar-menu li a.has-dropdown").off('click');
        nav_second.find('.sidebar-brand').remove();
        nav_second.removeAttr('class');
        nav_second.addClass(nav_second_classes);

        let main_sidebar = $(".navbar-secondary");
        main_sidebar.find('.sidebar-wrapper').addClass('container').removeClass('sidebar-wrapper');
        main_sidebar.find('.sidebar-menu').addClass('navbar-nav').removeClass('sidebar-menu');
        main_sidebar.find('.dropdown-menu').hide();
        main_sidebar.removeAttr('style');
        main_sidebar.removeAttr('tabindex');
        main_sidebar.removeAttr('data-nav-classes');
        $(".main-wrapper").addClass("container");
        // if(sidebar_nicescroll != null)
        //   sidebar_nicescroll.remove();
      } else if (now_layout_class == 'layout-2') {
        $("body").addClass("layout-2");
      } else {
        update_sidebar_nicescroll();
      }
    }
  }
  toggleLayout();
  $(window).resize(toggleLayout);

  $("[data-toggle='search']").click(function () {
    var body = $("body");

    if (body.hasClass('search-gone')) {
      body.addClass('search-gone');
      body.removeClass('search-show');
    } else {
      body.removeClass('search-gone');
      body.addClass('search-show');
    }
  });

  // tooltip
  $("[data-toggle='tooltip']").tooltip();

  // popover
  $('[data-toggle="popover"]').popover({
    container: 'body'
  });

  // Select2
  if (jQuery().select2) {
    $(".select2").select2();
  }

  // Selectric
  if (jQuery().selectric) {
    $(".selectric").selectric({
      disableOnMobile: false,
      nativeOnMobile: false
    });
  }

  $(".notification-toggle").dropdown();
  $(".notification-toggle").parent().on('shown.bs.dropdown', function () {
    $(".dropdown-list-icons").niceScroll({
      cursoropacitymin: .3,
      cursoropacitymax: .8,
      cursorwidth: 7
    });
  });

  $(".message-toggle").dropdown();
  $(".message-toggle").parent().on('shown.bs.dropdown', function () {
    $(".dropdown-list-message").niceScroll({
      cursoropacitymin: .3,
      cursoropacitymax: .8,
      cursorwidth: 7
    });
  });

  if ($(".chat-content").length) {
    $(".chat-content").niceScroll({
      cursoropacitymin: .3,
      cursoropacitymax: .8,
    });
    $('.chat-content').getNiceScroll(0).doScrollTop($('.chat-content').height());
  }

  if (jQuery().summernote) {
    $(".summernote").summernote({
      dialogsInBody: true,
      minHeight: 250,
    });
    $(".summernote-simple").summernote({
      dialogsInBody: true,
      minHeight: 150,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]
      ]
    });
  }

  if (window.CodeMirror) {
    $(".codeeditor").each(function () {
      let editor = CodeMirror.fromTextArea(this, {
        lineNumbers: true,
        theme: "duotone-dark",
        mode: 'javascript',
        height: 200
      });
      editor.setSize("100%", 200);
    });
  }

  // Follow function
  $('.follow-btn, .following-btn').each(function () {
    var me = $(this),
      follow_text = 'Follow',
      unfollow_text = 'Following';

    me.click(function () {
      if (me.hasClass('following-btn')) {
        me.removeClass('btn-danger');
        me.removeClass('following-btn');
        me.addClass('btn-primary');
        me.html(follow_text);

        eval(me.data('unfollow-action'));
      } else {
        me.removeClass('btn-primary');
        me.addClass('btn-danger');
        me.addClass('following-btn');
        me.html(unfollow_text);

        eval(me.data('follow-action'));
      }
      return false;
    });
  });

  // Dismiss function
  $("[data-dismiss]").each(function () {
    var me = $(this),
      target = me.data('dismiss');

    me.click(function () {
      $(target).fadeOut(function () {
        $(target).remove();
      });
      return false;
    });
  });

  // Collapsable
  $("[data-collapse]").each(function () {
    var me = $(this),
      target = me.data('collapse');

    me.click(function () {
      $(target).collapse('toggle');
      $(target).on('shown.bs.collapse', function () {
        me.html('<i class="fas fa-minus"></i>');
      });
      $(target).on('hidden.bs.collapse', function () {
        me.html('<i class="fas fa-plus"></i>');
      });
      return false;
    });
  });

  // Gallery
  $(".gallery .gallery-item").each(function () {
    var me = $(this);

    me.attr('href', me.data('image'));
    me.attr('title', me.data('title'));
    if (me.parent().hasClass('gallery-fw')) {
      me.css({
        height: me.parent().data('item-height'),
      });
      me.find('div').css({
        lineHeight: me.parent().data('item-height') + 'px'
      });
    }
    me.css({
      backgroundImage: 'url("' + me.data('image') + '")'
    });
  });
  if (jQuery().Chocolat) {
    $(".gallery").Chocolat({
      className: 'gallery',
      imageSelector: '.gallery-item',
    });
  }

  // Background
  $("[data-background]").each(function () {
    var me = $(this);
    me.css({
      backgroundImage: 'url(' + me.data('background') + ')'
    });
  });

  // Custom Tab
  $("[data-tab]").each(function () {
    var me = $(this);

    me.click(function () {
      if (!me.hasClass('active')) {
        var tab_group = $('[data-tab-group="' + me.data('tab') + '"]'),
          tab_group_active = $('[data-tab-group="' + me.data('tab') + '"].active'),
          target = $(me.attr('href')),
          links = $('[data-tab="' + me.data('tab') + '"]');

        links.removeClass('active');
        me.addClass('active');
        target.addClass('active');
        tab_group_active.removeClass('active');
      }
      return false;
    });
  });

  // Bootstrap 4 Validation
  $(".needs-validation").submit(function () {
    var form = $(this);
    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.addClass('was-validated');
  });

  // alert dismissible
  $(".alert-dismissible").each(function () {
    var me = $(this);

    me.find('.close').click(function () {
      me.alert('close');
    });
  });

  if ($('.main-navbar').length) {
  }

  // Image cropper
  $('[data-crop-image]').each(function (e) {
    $(this).css({
      overflow: 'hidden',
      position: 'relative',
      height: $(this).data('crop-image')
    });
  });

  // Slide Toggle
  $('[data-toggle-slide]').click(function () {
    let target = $(this).data('toggle-slide');

    $(target).slideToggle();
    return false;
  });

  // Dismiss modal
  $("[data-dismiss=modal]").click(function () {
    $(this).closest('.modal').modal('hide');

    return false;
  });

  // Width attribute
  $('[data-width]').each(function () {
    $(this).css({
      width: $(this).data('width')
    });
  });

  // Height attribute
  $('[data-height]').each(function () {
    $(this).css({
      height: $(this).data('height')
    });
  });

  // Chocolat
  if ($('.chocolat-parent').length && jQuery().Chocolat) {
    $('.chocolat-parent').Chocolat();
  }

  // Sortable card
  if ($('.sortable-card').length && jQuery().sortable) {
    $('.sortable-card').sortable({
      handle: '.card-header',
      opacity: .8,
      tolerance: 'pointer'
    });
  }

  // Daterangepicker
  if (jQuery().daterangepicker) {
    if ($(".datepicker").length) {
      $('.datepicker').daterangepicker({
        locale: { format: 'YYYY-MM-DD' },
        singleDatePicker: true,
      });
    }
    if ($(".datetimepicker").length) {
      $('.datetimepicker').daterangepicker({
        locale: { format: 'YYYY-MM-DD hh:mm' },
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
      });
    }
    if ($(".daterange").length) {
      $('.daterange').daterangepicker({
        locale: { format: 'YYYY-MM-DD' },
        drops: 'down',
        opens: 'right'
      });
    }
  }

  // Timepicker
  if (jQuery().timepicker && $(".timepicker").length) {
    $(".timepicker").timepicker({
      icons: {
        up: 'fas fa-chevron-up',
        down: 'fas fa-chevron-down'
      }
    });
  }
});

// digunakan agar modal selalu aktif tanpa harus ditekan terlebih dahulu
// window.onload = function() {
//     var myModal = new bootstrap.Modal(document.getElementById('editSocialMediaModal'));
//     myModal.show();
// };

const domain_name = $("#domain-url").val();

let imageUploadInput = $("#image-upload")[0];
let imageContainer = $("#image-preview")[0];

function previewImage() {
  imageContainer.innerHTML = "";
  for (let file of imageUploadInput.files) {
    let reader = new FileReader();
    let figure = document.createElement("div");

    reader.onload = function () {
      let img = document.createElement("img");
      let label = $("#image-preview label");
      label.remove();
      img.setAttribute("src", reader.result);
      figure.insertBefore(img, figure.firstChild);
    }
    imageContainer.appendChild(figure);
    reader.readAsDataURL(file);
  }
}

// passing data edit category modal
$("#editCategoryModal").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id")
  let name = button.data("name")
  let desc = button.data("desc")
  let img = button.data("img")
  // update modal content
  let modal = $(this);
  modal.find("#category_name_edit").val(name)
  modal.find("#category_description_edit").val(desc)
  let srcImg = `${domain_name}assets/img/categories/${img}`;
  modal.find("#img").attr("src", srcImg)
  modal.find("form")[0].action = domain_name + "admin/categories/" + id
  // console.log(modal.find("#img")[0]);
});

// passing data delete single category modal
$("#deleteConfirmSingle").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id")
  // update modal content
  let modal = $(this);
  let srcImg = `${domain_name}categories/${id}`;
  modal.find("#deleteButtonSingle").attr("href", srcImg)
  // console.log(modal.find("#img")[0]);
});

let MyEditor;
document.addEventListener("DOMContentLoaded", function() {
  if (typeof ClassicEditor !== 'undefined') {
    ClassicEditor
      .create(document.querySelector('#ckeditor-edit'), {
        // Configuration options
      })
      .then(editor => {
        MyEditor = editor;
        MyEditor.model.document.on('change:data', () => {
          let body_content = editor.getData();
          $("#ckeditor-input-edit").val(body_content);
        });
      })
      .catch(error => {
        console.error(error);
      });
  } else {
    console.error('ClassicEditor is not defined');
  }
});


// passing data edit produk modal
$("#editProductModal").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id");
  let name = button.data("name");
  let category_id = button.data("category-id");
  let desc = button.data("desc");
  let img = button.data("img");
  let color = button.data("color");
  let sizes = button.data("sizes");

  // update modal content
  let modal = $(this);
  modal.find("#product_name_edit").val(name);
  modal.find("#product_color_edit").val(color);
  modal.find("#product_desc_edit").val(desc);
  modal.find(`#product_category_edit option[value=${category_id}]`).attr('selected', 'selected');

  let srcImg = `${domain_name}assets/img/products/${img}`;
  modal.find("#img").attr("src", srcImg);
  modal.find("form")[0].action = domain_name + "admin/products/" + id;
  // console.log(domain_name)
  // Ensure MyEditor is defined before calling setData
  if (MyEditor) {
    MyEditor.setData(sizes);
  } else {
    console.error('MyEditor is not initialized');
  }
});




// passing data delete single product modal
$("#deleteProductConfirmSingle").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id")
  // update modal content
  let modal = $(this);
  let srcDelete = `${domain_name}admin/products/${id}`;
  modal.find("#deleteProductButtonSingle").attr("href", srcDelete)
  // console.log(modal.find("#img")[0]);
});


// passing data edit app modal
$("#editAppModal").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id")
  let title = button.data("title")
  let desc = button.data("desc")
  let img = button.data("img")
  // console.log("img")

  // update modal content
  let modal = $(this);
  // modal.find("#imgg").html(img[0].filename)
  modal.find("#app_title_edit").val(title)
  modal.find("#app_desc_edit").val(desc)
  for(let i = 0; i < img.length; i++) {
    let srcImg = `${domain_name}assets/img/apps/${img[i].filename}`;
    let newElement = $("<img>", {
      src: srcImg,
      class: "my-1",
    });
    modal.find("figure").append(newElement);
  }
  modal.find("form")[0].action = domain_name + "admin/applications/" + id;
  // console.log(modal.find("#img")[0]);
});

// passing data delete single app modal
$("#deleteAppConfirmSingle").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id")
  // update modal content
  let modal = $(this);
  let srcDelete = `${domain_name}applications/${id}`;
  modal.find("#deleteButtonSingle").attr("href", srcDelete)
  // console.log(modal.find("#img")[0]);
});


// passing data edit social media modal
$("#editSocialMediaModal").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id")
  let type = button.data("type")
  let link = button.data("link")
  // update modal content
  let modal = $(this);
  modal.find("#link").val(link);
  modal.find("#type").val(type);
  let action = `${domain_name}admin/settings/social-media/${id}`;
  modal.find("form").attr("action", action)
});

// passing data edit social media modal
$("#deleteSocialMediaConfirmSingle").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let id = button.data("id")
  // update modal content
  let modal = $(this);
  let srcDelete = `${domain_name}admin/settings/social-media/${id}`;
  modal.find("#deleteSocialMediaButtonSingle").attr("href", srcDelete)
});


let checkedValues = [];
let allState = false;
Boolean(allState);
let singleState = false;
Boolean(singleState);
let selectedCheckboxs = [];
let selectedCheckbox = 0;
let checkboxes = $("input[data-checkboxes='mygroup']").click(function () {
  // console.log(checkbox)
  // let checkboxValue = $(this).val();
  if ($(this).val() == "all") {
    allState = !allState;
    console.log(allState);
  }
  if ($(this).val() != "all") {
    singleState = !singleState;
    if (singleState && $(this).val() != selectedCheckbox) {
      // console.log(selectedCheckboxs.indexOf($(this).val()))
      if (selectedCheckboxs.indexOf(Number($(this).val())) === -1) {
        selectedCheckboxs.push(Number($(this).val()));
        selectedCheckbox = Number($(this).val());
        console.log(selectedCheckboxs)
        console.log(selectedCheckbox)
      }
    }
  }
  // passing data delete selected category modal
  $("#deleteConfirmSelected").on("show.bs.modal", function (event) {
    let button = $(event.relatedTarget);
    let id = button.data("id")
    // update modal content
    let modal = $(this);
    let srcImg = `${domain_name}admin/categories/${id}`;
    modal.find("#deleteButtonSingle").attr("href", srcImg)
    // console.log(modal.find("#img")[0]);
  });
});

// Image Upload & Preview
let imageUploadInputEdit = $("#image-upload-edit")[0];
let imageContainerEdit = $("#image-preview-edit")[0];

function previewImageEdit() {
  imageContainerEdit.innerHTML = "";
  let figure = $("figure");
  let img = $("#img");
  if (img && figure) {
    figure.remove();
    img.remove();
  }
  for (let file of imageUploadInputEdit.files) {
    let reader = new FileReader();
    let figure = document.createElement("figure");

    reader.onload = function () {
      let img = document.createElement("img");
      img.setAttribute("src", reader.result);
      figure.insertBefore(img, figure.firstChild);
    }
    imageContainerEdit.appendChild(figure);
    reader.readAsDataURL(file);
  }
}


// CATEGORY Validation
$(function () {
  let editButton = $("#edit-button");
  let addButton = $("#add-button");
  let categoryNameAlert = $("#category-name-alert");
  let categoryDescAlert = $("#category-description-alert");
  let categoryImgAlert = $("#category-image-alert");
  // EDIT
  $('#category_name_edit').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryNameAlert.removeClass("d-none");
      categoryNameAlert.addClass("d-block");
      categoryNameAlert.html("Kolom nama tidak boleh kosong");
      editButton.prop('disabled', true);
    } else {
      categoryNameAlert.removeClass("d-block");
      categoryNameAlert.addClass("d-none");
      editButton.prop('disabled', false);
    }
  });
  $('#category_description_edit').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryDescAlert.removeClass("d-none");
      categoryDescAlert.addClass("d-block");
      categoryDescAlert.html("Kolom deskripsi tidak boleh kosong");
      editButton.prop('disabled', true);
    } else {
      categoryDescAlert.removeClass("d-block");
      categoryDescAlert.addClass("d-none");
      editButton.prop('disabled', false);
    }
  });

  // ADD
  $('#category_name').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryNameAlert.removeClass("d-none");
      categoryNameAlert.addClass("d-block");
      categoryNameAlert.html("Kolom nama tidak boleh kosong");
      addButton.prop('disabled', true);
    } else {
      categoryNameAlert.removeClass("d-block");
      categoryNameAlert.addClass("d-none");
      addButton.prop('disabled', false);
    }
  });
  $('#category_description').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryDescAlert.removeClass("d-none");
      categoryDescAlert.addClass("d-block");
      categoryDescAlert.html("Kolom deskripsi tidak boleh kosong");
      addButton.prop('disabled', true);
    } else {
      categoryDescAlert.removeClass("d-block");
      categoryDescAlert.addClass("d-none");
      addButton.prop('disabled', false);
    }
  });
  $('#category_image').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryImgAlert.removeClass("d-none");
      categoryImgAlert.addClass("d-block");
      categoryImgAlert.html("Gambar harus diupload dan tidak boleh kosong");
      addButton.prop('disabled', true);
    } else {
      categoryImgAlert.removeClass("d-block");
      categoryImgAlert.addClass("d-none");
      addButton.prop('disabled', false);
    }
  });
});

// PRODUCT
$(function () {
  let editButton = $("#edit-button");
  let addButton = $("#add-button");
  let productNameAlert = $("#product-name-alert");
  let productColorAlert = $("#product-color-alert");
  let productCategoryAlert = $("#product-category-alert");
  let productDescAlert = $("#product-desc-alert");
  let productImgAlert = $("#product-img-alert");

  // EDIT
  $('#product_name_edit').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      productNameAlert.removeClass("d-none");
      productNameAlert.addClass("d-block");
      productNameAlert.html("Kolom nama tidak boleh kosong");
      editButton.prop('disabled', true);
    } else {
      categoryNameAlert.removeClass("d-block");
      categoryNameAlert.addClass("d-none");
      editButton.prop('disabled', false);
    }
  });
  $('#product_desc_edit').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryDescAlert.removeClass("d-none");
      categoryDescAlert.addClass("d-block");
      categoryDescAlert.html("Kolom deskripsi tidak boleh kosong");
      editButton.prop('disabled', true);
    } else {
      categoryDescAlert.removeClass("d-block");
      categoryDescAlert.addClass("d-none");
      editButton.prop('disabled', false);
    }
  });

  // ADD
  $('#product_name').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      productNameAlert.removeClass("d-none");
      productNameAlert.addClass("d-block");
      productNameAlert.html("Kolom nama tidak boleh kosong");
      addButton.prop('disabled', true);
    } else {
      productNameAlert.removeClass("d-block");
      productNameAlert.addClass("d-none");
      addButton.prop('disabled', false);
    }
  });
  $('#product_color').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      productColorAlert.removeClass("d-none");
      productColorAlert.addClass("d-block");
      productColorAlert.html("Kolom warna tidak boleh kosong");
      addButton.prop('disabled', true);
    } else {
      productColorAlert.removeClass("d-block");
      productColorAlert.addClass("d-none");
      addButton.prop('disabled', false);
    }
  });
  // $('#product_category').change(function () {
  //   this.value = $.trim(this.value);
  //   if (this.value === "") {
  //     categoryNameAlert.removeClass("d-none");
  //     categoryNameAlert.addClass("d-block");
  //     categoryNameAlert.html("Pilihan kategori tidak boleh kosong");
  //     addButton.prop('disabled', true);
  //   } else {
  //     categoryNameAlert.removeClass("d-block");
  //     categoryNameAlert.addClass("d-none");
  //     addButton.prop('disabled', false);
  //   }
  // });
  $('#product_desc').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryDescAlert.removeClass("d-none");
      categoryDescAlert.addClass("d-block");
      categoryDescAlert.html("Kolom deskripsi tidak boleh kosong");
      addButton.prop('disabled', true);
    } else {
      categoryDescAlert.removeClass("d-block");
      categoryDescAlert.addClass("d-none");
      addButton.prop('disabled', false);
    }
  });
  $('#category_image').change(function () {
    this.value = $.trim(this.value);
    if (this.value === "") {
      categoryImgAlert.removeClass("d-none");
      categoryImgAlert.addClass("d-block");
      categoryImgAlert.html("Gambar harus diupload dan tidak boleh kosong");
      addButton.prop('disabled', true);
    } else {
      categoryImgAlert.removeClass("d-block");
      categoryImgAlert.addClass("d-none");
      addButton.prop('disabled', false);
    }
  });
});
