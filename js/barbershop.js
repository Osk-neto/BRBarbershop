if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeCartItem = document.getElementsByClassName("btn-danger")
    for (var i = 0; i < removeCartItem.length; i++) {
        var button = removeCartItem[i]
        button.addEventListener('click', removeProduct)

    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addProductToCart = document.getElementsByClassName('product-button')
    for (var i = 0; i < addProductToCart.length; i++) {
        var button = addProductToCart[i]
        button.addEventListener('click', addToCartClicked)

    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purschaseClicked)
    document.getElementsByClassName('fas fa-shopping-cart')[0].addEventListener('click', showCart)
    document.getElementsByClassName('far fa-window-close')[0].addEventListener('click', hiddenCart)
}

function showCart() {

    document.getElementById('cart').style.visibility = "visible";
    updateCartTotal()


}

function hiddenCart() {

    document.getElementById('cart').style.visibility = "hidden";

}

function removeProduct(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}

function addToCartClicked(event) {
    var button = event.target
    var productItem = button.parentElement
    var title = productItem.getElementsByClassName('product-title')[0].innerText
    var price = productItem.getElementsByClassName('product-price')[0].innerText
    var imageSrc = productItem.getElementsByClassName('img-fluid')[0].src
    
    addItemToCart(title, price, imageSrc)
    updateCartTotal()

}

function addItemToCart(title, price, imageSrc) {

    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartProducts = document.getElementsByClassName('items')[0]
    var cartProductsNames = cartProducts.getElementsByClassName('cart-item-title')

        for (var i = 0; i < cartProductsNames.length; i++) {
                
            if (cartProductsNames[i].innerHTML == title) {
                alert('This product is already added to the cart')
                return
            }

        }
    
    var cartRowContent =`
    <div class="cart-item cart-column">
        <img class="cart-item-image" src="${imageSrc}" width="100" height="100">
        <span class="cart-item-title">${title}</span>
    </div>
    <span class="cart-price cart-column">${price}</span>
    <div class="cart-quantity cart-column">
        <input class="cart-quantity-input" type="number" value="1">
        <button class="btn btn-danger" type="button">REMOVE</button>
    </div>`
    
    cartRow.innerHTML = cartRowContent
    cartProducts.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeProduct)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
    
}


function updateCartTotal() {
    var cartItem = document.getElementsByClassName('items')[0]
    var cartRows = cartItem.getElementsByClassName('cart-row')
    var total = 0
    var totalquantity = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceProduct = cartRow.getElementsByClassName('cart-price')[0]
        var quantityProduct = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = priceProduct.innerText.replace('$', '')
        var quantity = quantityProduct.value
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = '$' + total
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        
        var quantityProduct = cartRow.getElementsByClassName('cart-quantity-input')[0]
        
        var quantity = quantityProduct.value
        totalquantity =  totalquantity + parseFloat(quantity)
    }
    
    document.getElementsByClassName('cart-items')[0].innerText = totalquantity

    
}

function purschaseClicked() {
    
    
    var cartProducts = document.getElementsByClassName('items')[0]
    var title = cartProducts.getElementsByClassName('cart-item-title')
    var cartRows = cartProducts.getElementsByClassName('cart-row')

    //titles
    //PRONTO
    for(var i=0;i<title.length;i++){
        var inputDiv = document.createElement('div')
        var input = document.getElementsByClassName('input')[0]
        var inputTitle = `<input type="hidden" name="title[]" value="${title[i].innerText}"></input>`
        inputDiv.innerHTML = inputTitle
        input.append(inputDiv)
        
    }

    //quantity
    //PRONTO
    for(var i=0;i<cartRows.length;i++){
        var cartRow = cartRows[i]
        var quantityProduct = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var quantity = quantityProduct.value
        var inputDiv = document.createElement('div')
        var input = document.getElementsByClassName('input')[0]
        var inputQuantity = `<input type="hidden" name="quantity[]" value="${quantity}"></input>`
        inputDiv.innerHTML = inputQuantity
        input.append(inputDiv)
    }
    //totalprice
    //PRONTO
    var inputDiv = document.createElement('div')
    var input = document.getElementsByClassName('input')[0]
    var total_price = document.getElementsByClassName('cart-total-price')[0]
    var price = total_price.innerText.replace('$', '')
    var inputTotalPrice = `<input type="hidden" name="total_price" value="${price}"></input>`
    inputDiv.innerHTML = inputTotalPrice
    input.append(inputDiv)
    
    



    
    

    

   

    alert('Thank you for your purchase')
    var cartProducts = document.getElementsByClassName('items')[0]
    while (cartProducts.hasChildNodes()) {
        cartProducts.removeChild(cartProducts.firstChild)
    }
    
    updateCartTotal()
}