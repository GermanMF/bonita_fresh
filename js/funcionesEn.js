   function load_estado (id_pais){
    $('#estado').html("<option></option>").attr({style: "background: url('img/AjaxLoader.gif') no repeat center center",disabled: "disabled"});
    $('#ciudad').html('<option></option>');
    $('#ciudad').attr("disabled","disabled");
    $('select').material_select();
    var url = '../php/oper.php?case=1';                                                                                            
    $.ajax({
      type:'POST',
      url:url,
      data: 'id='+ id_pais,
      success: function(datos){
        $('#estado').attr({disabled: false, style:"background: none"});
        $('#estado').html('');
        $('#estado').append(datos);
        $('select').material_select();
      },
      error: function(){
        alert('error_estado');
      }
    });
  }

  function load_ciudad (id_estado,id_pais){
    $('#ciudad').html("<option></option>").attr({style: "background: url('img/AjaxLoader.gif') no repeat center center",disabled: "disabled"});
    var url = '../php/oper.php?case=2';
    $.ajax({
      type:'POST',
      url:url,
      data: 'id='+id_estado+'&pais='+id_pais,
      success: function(datos){
        $('#ciudad').attr({disabled:false, style:"background: none"});
        $('#ciudad').html('');
        $('#ciudad').append(datos);
        $('select').material_select();
      },
      error: function(){
        alert('error_ciudad');
      }
    });
  }

  $('input[name=pais]').on('change', function() {
    if($('input[name=pais]:checked', '#form1').val()==="no"){
     $('#estado').html("<option></option>").attr({disabled: "disabled"});
     $('#ciudad').html("<option></option>").attr({disabled: "disabled"});
     $('#zip').attr("disabled","disabled");
     $('#zip').val('');
     $('select').material_select('destroy');
   }
   else if($('input[name=pais]:checked', '#form1').val() === "mexico" || $('input[name=pais]:checked', '#form1').val()==="us"){
    $('#zip').attr("disabled",false);
    load_estado($('input[name=pais]:checked', '#form1').val()); 
  }
});

  $('#estado').change(function(){
    load_ciudad($('#estado').val(),$('input[name=pais]:checked', '#form1').val());
  });

  $("#form1").submit(function(){
    $.ajax({
      url: '../php/mail.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(){
        Materialize.toast("Message sent, we are glad to read your comments.", 3000, "rounded");
        $("#form1")[0].reset();
      },
      error: function(){
        alert("perro");
        alert('error_submit');
      }
    });
    return false;
  });

  $(document).ready(function () {
    $(".button-collapse").sideNav({
      menuWidth: 220,
      closeOnClick: true
    });
    $('.slider').slider({indicators:false});
    $('.modal-trigger').leanModal();
    $('#language').pushpin();
    $('select').material_select();
    $(".carrusel1").owlCarousel({
      items : 1,
      itemsCustom : false,
      itemsDesktop : [1199,1],
      itemsDesktopSmall : [980,1],
      itemsTablet: [768,1],
      itemsTabletSmall: [641,1],
      itemsMobile : [320,1],
      singleItem : true,
      itemsScaleUp : true,


      slideSpeed : 200,
      paginationSpeed : 800,
      rewindSpeed : 1000,
      autoPlay : true,
      pagination : true,
      autoHeight : true,
      lazyLoad: true
    });
  });
  
  $('#bShowDiv').click(function(){
    $('#bShowDiv').addClass('hid');
    $('#showDiv').addClass('noHid');
    $('.menuShow').addClass('opMas');
    $('.menuShow').removeClass('opMenos');
    Materialize.showStaggeredList('#acc');
  });

  $("#js-rotating").Morphext({
    animation: "fadeIn",
    separator: ",",
    speed: 3000
  });

  var lastId,
  topMenu = $("#top-menu"),
  topMenuHeight = topMenu.outerHeight()+15,
  menuItems = topMenu.find("a"),
  scrollItems = menuItems.map(function(){
    var item = $($(this).attr("href"));
    if (item.length) { return item; }
  });

  menuItems.click(function(e){
    var href = $(this).attr("href"),
    offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
    $('html, body').stop().animate({ 
      scrollTop: offsetTop
    }, 300);
    e.preventDefault();
  });

  $(window).scroll(function(){
    var fromTop = $(this).scrollTop()+topMenuHeight;
    var cur = scrollItems.map(function(){
      if ($(this).offset().top < fromTop)
        return this;
    });
    cur = cur[cur.length-1];
    var id = cur && cur.length ? cur[0].id : "";

    if (lastId !== id) {
      lastId = id;
      menuItems
      .parent().removeClass("active")
      .end().filter("[href='#"+id+"']").parent().addClass("active");
    }                   
  });

  var options = [{selector: '#acc', offset: 200}];
  Materialize.scrollFire(options);

  document.addEventListener("DOMContentLoaded", function(){
    $('.preloader-background').delay(700).fadeOut('slow');
    $('.preloader-wrapper').delay(700).fadeOut();
  });

