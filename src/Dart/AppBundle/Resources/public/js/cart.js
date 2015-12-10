$(document).ready(function(){
    $('.btn-product').bind('click', handleCartButton);
});

function handleCartButton(e)
{
    var cartContainer = document.getElementById('cart-preview-container'),
        cartController = new CartController(cartContainer),
        parser = new ProductParser(),
        product;
  
    e.preventDefault();
  
    product = parser.getId(this);
  
    cartController.add(product);
}