$( document ).ready(function() {

$('.next-register-2').on('click',function(e){
  e.preventDefault();
  var prenom = $("#prenom");
  var nom = $("#nom");
  var telephone = $("#telephone");
  var email = $("#email");

  if (prenom.val() != "" && nom.val() != "" && telephone.val() != "" && email.val() != "") {
    $('.register-1').hide();
    $('.register-2').fadeIn(1000);
  }
  
});

$('.next-register-3').on('click',function(e){
  e.preventDefault();
  var mdp1 = $("#password1");
  var mdp2 = $("#password2");

  if (mdp1.val() != "" && mdp2.val() != "") {
    if (mdp1.val().length >= 8) {
      if (mdp1.val() == mdp2.val()) {
        $('.register-2').hide();
        $('.register-3').fadeIn(1000);
      }
      else{
        alert("les mots de passe ne correspondent pas !");
      }
    }
    else{
      alert("mot de passe trop court doit être au moins supérieur ou égale à 8 caractères");
    }
  }
  
});

$('.prev-register-1').on('click',function(e){
  e.preventDefault();
  $('.register-2').hide();
  $('.register-1').fadeIn(1000);
});

$('.prev-register-2').on('click',function(e){
  e.preventDefault();
  $('.register-3').hide();
  $('.register-2').fadeIn(1000);
});

$('.panel-confirm').hide(); 

if ($('.panel-confirm').length != 0) {

  $('.loader').show();

  $('.loader').animate({
    opacity: 0.2,
    'background-color':'#000'
  }, 3000, function() {
    $('.panel-confirm').fadeIn(1000);
    $(this).hide();

  });
}

$('.home-content').hide();

if ($('.home-content').length != 0) {
  $('.loader').fadeIn(1000);

  $('.loader').animate({
    opacity: 0.2,
    'background-color':'#000'
  }, 1000, function() {
    $('.home-content').fadeIn(1000);
    $(this).hide();

  });
}

setInterval(function(){

    $.ajax({
      type:"POST",
      url:"index.php?url=ajaxorder",
      data:{},
      success:function(data){
        $('#notif_counter').text(data);
      },
      error:function(err){
        
      }
    });
},1000);

$('#product_category').on('change', function() {
  var selectedOption = $(this).find('option:selected').val();
  $.ajax({
    type:"POST",
    url:"index.php?url=ajax",
    data:{idOption: selectedOption},
    success:function(data){

      var arr1 = data.split("/");

      if (arr1.length == 0) {

        alert("PAS DE SOUS CATEGORIE !");

      }else{

        $('#sub_category').empty();
        for (var i = 0; i < arr1.length ; i++) {
          if (arr1[i].split(',')[1] == undefined) {

            alert("Pas de sous catégorie pour l'instant. Veuillez ajouter une nouvelle sous catégorie avant de poursuivre !");

          }else{
            $('#sub_category').append('<option value='+arr1[i].split(',')[0]+'>'+arr1[i].split(',')[1]+'</option>');
          }
          
        }
      }
      
    },
    error:function(err){
      alert("erreur :"+err);
    }
  });
  
});

$('.add-sub-category').on('click',function(e){
  e.preventDefault();
  $('.confirm_dialog').show();
  $('.container').css({'opacity':'0.4'});

});

$('.add-category').on('click',function(e){
  e.preventDefault();
  var category = $('#product_category').val();
  var sub_category = $('#sub_category').val();

  if (category == null || category === undefined) {
      alert('Veuillez choisir une catégorie !');
  }else if (sub_category == null || sub_category == undefined) {
      alert('Veuillez choisir une sous-catégorie !');
  }
   else {
    $('.insert-product').fadeIn(1000);
    $('.insert-category').hide();
  }

});


if ($(window).width() >= 925) {

  $(window).scroll(function() {
     if($(window).scrollTop() > 130) {
         $('.categories').hide();
         $('.btn-up').show();
         $('header').css({'position':'fixed','top':'0'});
     }
     else{
        $('.categories').show();
        $('.btn-up').hide();
        $('header').css({'position':'relative'});
     }
  });

}else{

  //$('.nav-shopping').show('fast');

  $(window).scroll(function() {
     if($(window).scrollTop() > 0) {
         $('.btn-up').show();
     }
     else{
        $('.btn-up').hide();
     }
  });

}


$('.show-categories').on('click',function(){

  if ($('.categories').width() <= '50' && $(this).find("i").hasClass("fa-chevron-right")) {
    $('.categories').css({'width':'250px'});
    $('.categories-name,.all-categories').fadeIn(500);
    $(this).find("i").removeClass("fa-chevron-right").addClass("fa-chevron-left");

  }
  else{
    $('.categories').css({'width':'50px','overflow-y':'hidden'});
    $('.categories-name,.all-categories').hide();
    $(this).find("i").removeClass("fa-chevron-left").addClass("fa-chevron-right");
  }
});

setInterval(function() {
  var color = $('header').css('border-bottom-color');
  if (color === 'rgb(16, 214, 196)') {
    $('header').css({'border-bottom':'1px solid red'});
  } else {
    $('header').css({'border-bottom':'1px solid #10D6C4'});
  }
}, 2000);

// Récupérer toutes les cases à cocher dans un tableau
const radios = document.querySelectorAll('input[type="radio"]');

// Ajouter un écouteur d'événements à chaque case à cocher
radios.forEach((radio) => {
  radio.addEventListener('click', () => {
    // Si la case à cocher est cochée
    if (radio.checked) {
      // Décocher toutes les autres cases à cocher
      radios.forEach((otherradio) => {
        if (otherradio !== radio) {
          otherradio.checked = false;
        }
      });
    }
  });
});

/*$('#clothes,#kg').change(function(){
  const showClothes = $('#clothes').is(':checked');
    const kg = $('#kg').is(':checked');

    if (showClothes) {
       alert("clothes");
    }
 
    
    if (kg) {
      alert("kg");
    }
});*/


//$('.clothes-option, .hectogramme, .decagramme, .gramme, .metre, .centimetre, .decimetre, .milimetre, .pointure').hide();
$('#clothes,#kg,#hg,#dag, #g,#metre,#centimetre,#decimetre,#milimetre,#shoe_size').change(function() {
    // Afficher/masquer les options du menu déroulant en fonction des cases à cocher
    const showClothes = $('#clothes').is(':checked');
    const kg = $('#kg').is(':checked');
    const hg = $('#hg').is(':checked');
    const dag = $('#dag').is(':checked');
    const g = $('#g').is(':checked');
    const metre = $('#metre').is(':checked');
    const centimetre = $('#centimetre').is(':checked');
    const decimetre = $('#decimetre').is(':checked');
    const milimetre = $('#milimetre').is(':checked');
    const pointure = $('#shoe_size').is(':checked');

    if (showClothes) {
      $('#product_size option:not(.clothes-option)').hide();
    }
    else if (kg) {
      $('#product_size option:not(.kilogramme)').hide();

    }else if (hg) {

      $('#product_size option:not(.hectogramme)').hide();

    }else if (dag) {

      $('#product_size option:not(.decagramme)').hide();

    }else if (g) {

      $('#product_size option:not(.gramme)').hide();

    }else if(metre){
      $('#product_size option:not(.metre)').hide();
    }
    else if(centimetre){
      $('#product_size option:not(.centimetre)').hide();
    }
    else if(decimetre){
      $('#product_size option:not(.decimetre)').hide();
    }
    else if(milimetre){
      $('#product_size option:not(.milimetre)').hide();
    }
    else if(pointure){
      $('#product_size option:not(.pointure)').hide();
    }
    else{
      $('#product_size option').show();
    }
});


var mesure1 = $("#mesure1");
var mesure2 = $("#mesure2");

mesure1.on('click',function(){
  if ($(this).is(':checked')) {
    $('.size-product').show();
  }else{
    $('.size-product').hide();
    $('#product_size option:selected').prop('selected', false);
  }
});

mesure2.on('click',function(){

    $('.size-product').hide();
    $('#product_size option:selected').prop('selected', false);

});

var dispo = $("#dispo");
var indispo = $("#indispo");

dispo.on('click',function(){
  if ($(this).is(':checked')) {
    $(".available").show();
  }else{
    $(".available").hide();
    $("#product_qty").val(0);
  }
});

indispo.on('click',function(){
  $(".available").hide();
  $("#product_qty").val(0);
});


// Vérifiez si la boîte de dialogue est déjà ouverte
if(localStorage.getItem('dialogOpen') === 'true') {
  $('.dialog').show();
}

$('.client').each(function(index){
  
  $(this).on('click',function(e){
  
    $('.dialog').show();
    localStorage.setItem('dialogOpen', 'true');
  });
});


$('.exit').on('click',function(){
  $('.dialog').hide();
  localStorage.setItem('dialogOpen', 'false');
});

$('.input-c').on('focus',function(){

  $(this).css({
              'border-bottom':'2px solid #F83C3C'
            });

});

$('.input-c').on('blur',function(){
  $(this).css({'border-bottom':'2px solid #10D6C4'});
});

$('.main').on('click',function(){
  $('.rs-search').slideUp(100,function(){
    $('.fa-magnifying-glass').css({'color':'#102447'});
    $('.main').css({'opacity':'1'});
  });
  
});

$('.search-look').on('click', function() {

    $('.rs-search').slideToggle(100,function(){
      if($(this).is(':hidden')){
        $('.fa-magnifying-glass').css({'color':'#102447'});
      }else{
        $('.fa-magnifying-glass').css({'color':'#10D6C4'});
        $('.main').css({'opacity':'0.4'});
      }
    });

});

$('.btn-search').on('click',function(e){
  var input = $('.input-search').val();
  if (input.length <= 0) {
    e.preventDefault();
    $('.alert-warning').fadeIn(1000).delay(5000).fadeOut(1000);
    //alert("Veuillez saisir quelque chose !");
  }
});

$('.show-my-modal').on('click',function(){
  $('.my-modal').show();
});

$('.cross-btn-close').on('click',function(){
  $('.my-modal').hide();
});

$('.close-btn').on('click',function(){
  $('.my-modal').hide();
});

$('.alert-error').fadeIn(1000).delay(5000).fadeOut(1000);
$('.alert-success').fadeIn(1000).delay(5000).fadeOut(1000);

var totalSum = document.getElementById('sumTotal');
var countTotal = document.querySelector('#countTotal');

function notif(){
  var arrCookie = parseJSON(getCookie('pln'));
  $('.notif').html(arrCookie.length);
}

$('.btn-add-cart').on('click',function(){

  $(this).css({'background-color':'#10D6C4','color':'#fff','font-size':'16px'});

  $('.alert-added').fadeIn(1000).delay(5000).fadeOut(1000);

  var id = $(this).attr('data-id');
  var price = parseInt($(this).attr('data-price'));
  var size = $('#mySelect').val();
  var signal = $(this).attr('data-sig');

  var obj = {};

  if (size == null) {
    
    obj["id"] = id;
    obj["price"] = price;
    addCookieValue('pln',JSON.stringify(obj));
  }
  else
  {

    if (signal != null && signal == '1') {
      obj["id"] = id;
      obj["price"] = price;
      obj["size"] = size;
      addCookieValue('pln',JSON.stringify(obj));
    }
    else
    {
      obj["id"] = id;
      obj["price"] = price;
      addCookieValue('pln',JSON.stringify(obj));
    }
  }

  notif();
  
});

var id;
var price;
var size;
// Récupération de tous les boutons "increment" ou "decrement"
const buttons = document.querySelectorAll("button.increment, button.decrement");

// Fonction pour incrémenter la valeur dans le span correspondant
function incrementValue(event) {
  const pQtySpan = event.currentTarget.previousElementSibling;
  let currentValue = parseInt(pQtySpan.textContent);
  pQtySpan.textContent = currentValue + 1;

  var obj = {};

  if (size == "") {
    
    obj["id"] = id;
    obj["price"] = price;
    addCookieValue('pln',JSON.stringify(obj));
  }
  else
  {

    obj["id"] = id;
    obj["price"] = price;
    obj["size"] = size;
    addCookieValue('pln',JSON.stringify(obj));
    

  }
  location.reload();
  //updateProductProperty(id, "price", price*(currentValue + 1));
}

// Fonction pour décrémenter la valeur dans le span correspondant
function decrementValue(event) {
  const pQtySpan = event.currentTarget.nextElementSibling;
  let currentValue = parseInt(pQtySpan.textContent);
  let cookies = parseJSON(getCookie('pln'));

  if (currentValue > 1) {
    pQtySpan.textContent = currentValue - 1;

    var obj = {};
    var newArray = [];

    try {
      if (size == "") {
      
        obj["id"] = id;
        obj["price"] = price;
        console.log(obj);

        const index = getFirstIndex(cookies,obj);
        console.log(index);
        if (index !== -1) {
          var newCookie = stringifyArrayWithoutBrackets(cookies.filter((item, i) => i !== index));
          addCookieOneValue('pln',newCookie);
        }

      }
      else
      {

        obj["id"] = id;
        obj["price"] = price;
        obj["size"] = size;
        console.log(obj);

        const index = getFirstIndex(cookies,obj);
        console.log(index);
        if (index !== -1) {
          var newCookie = stringifyArrayWithoutBrackets(cookies.filter((item, i) => i !== index));
          addCookieOneValue('pln',newCookie);
        }  

      }
    } catch (error) {
      console.error(error);
    }

  }
  location.reload();
}

// Boucle pour ajouter des gestionnaires d'événements à tous les boutons
buttons.forEach((button) => {
  button.addEventListener("click", (event) => {
    id = button.getAttribute('data-id');
    price = parseInt(button.getAttribute('data-price'));
    if (typeof button.getAttribute('data-size') != 'undefined') {
      size = button.getAttribute('data-size');
    }
    

    if (button.classList.contains("increment")) {
      incrementValue(event);
    } else {
      decrementValue(event);
    }
  });
});


$('.btn-delete').on('click',function(){

  $('.confirm_dialog').show();
  $('.container').css({'opacity':'0.4'});

});

$('#cancel').on('click',function(){
  $('.confirm_dialog').hide();
  $('.container').css({'opacity':'1'});
});

$('#confirm').on('click',function(){
  var id = $(".btn-delete").attr('data-id');
  var price = parseInt($(".btn-delete").attr('data-price'));
  var size = $(".btn-delete").attr('data-size');

  var obj = {};

  if (size == "") {
    
    obj["id"] = id;
    obj["price"] = price;
    var newCookie = parseJSON(getCookie('pln')).filter(function(elem){
        return JSON.stringify(elem) != JSON.stringify(obj);
    });
    if (newCookie.length == 0) {
      deleteEntireCookie('pln');
    }else{
      addCookieOneValue('pln',stringifyArrayWithoutBrackets(newCookie));
    }

  }
  else
  {

    obj["id"] = id;
    obj["price"] = price;
    obj["size"] = size;
    var newCookie = parseJSON(getCookie('pln')).filter(function(elem){
        return JSON.stringify(elem) != JSON.stringify(obj);
    });
    if (newCookie.length == 0) {
      deleteEntireCookie('pln');
    }else{
      addCookieOneValue('pln',stringifyArrayWithoutBrackets(newCookie));
    }
    

  }

  
  location.reload();
});



});




