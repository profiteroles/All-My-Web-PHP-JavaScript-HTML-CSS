$(document).foundation();

// let cartCounterDisplay = document.querySelector('#cart-counter');

// cartCounterDisplay.innerHTML = `&nbsp;${cartCounter} - $ ${cartPrice}`;

$(function() {
  $('.searchbar')
    .bind('click', function(event) {
      $(".search-field").toggleClass("expand-search");
      $('.searchbar').toggleClass("active");
    })
});

//Check Out Section

/* Variables */
var taxRate = 0.10;
var shippingRate = 15.00; 
var fadeTime = 300;
var itemNo = 0;

/* Add Cart */
var addToCartButtons = document.getElementsByClassName('add-to-cart');
for (let i = 0; i < addToCartButtons.length; i++) {
 button = addToCartButtons[i];
button.addEventListener('click',addToCardClicked);
}


function addToCardClicked(event) {
  if(event.target.innerText != "Added"){
    var productItems = event.path[1];
    var thumbnail = productItems.getElementsByClassName('product-card-thumbnail')[0].children[0].src;
    var title = productItems.getElementsByClassName('product-card-title')[0].innerText;
    var classTitle = title.replaceAll('&','').replaceAll('$','').replaceAll(' ', '-');
    var desc = productItems.getElementsByClassName('product-card-desc')[0].innerText
    var price = parseFloat(productItems.getElementsByClassName('product-card-price')[0].innerText.replace('$',''));
    event.target.innerHTML = "Added";
    event.target.className = `button expanded ${classTitle} added add-to-cart`;
    itemNo++;
    document.getElementById('cart-counter').children[0].innerText = itemNo;
    addItemToCart(thumbnail, title, desc, price);
    updateQuantity();
  }
}

function addItemToCart(thumbnail, title, desc, price){
var cartRow = document.createElement('div');
var cartItems = document.getElementsByClassName('shopping-cart')[0];
var cartContent = `
<div class="product">
  <div class="product-image">
    <img src="${thumbnail}">
  </div>
  <div class="product-details">
    <div class="product-title">${title}</div>
    <p class="product-description">${desc}</p>
  </div>
  <div class="product-price">${price}</div>
    <div class="product-quantity">
      <input type="number" value="1" min="1" max="99" size="10">
    </div>
    <div class="product-removal">
      <button class="remove-product">remove</button>
    </div>
  <div class="product-line-price">${price}</div>
</div>`;
cartRow.innerHTML = cartContent;
cartItems.append(cartRow);
$('.product-removal button').click( function() {
  removeItem(this);
});
$('.product-quantity input').change( function() {
  updateQuantity(this);
});
recalculateCart();
}


/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });
}


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    $('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
}


/* Remove item from cart */
function removeItem(removeButton)
{

  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();

  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    itemNo--;
    document.getElementById('cart-counter').children[0].innerText = itemNo;
    recalculateCart();
  });
  
  var addedBtn = $('.added').parent()[1].children[1].innerText;
  var className = productRow[0].innerText.split('\n')[0].replaceAll('$','').replaceAll('&','').replaceAll(' ', '-');
  // var findAddedItem = $(".product-card-title").text();
  $(`.${className}`).text("Add to Cart").removeClass(`${className} added`);
} 