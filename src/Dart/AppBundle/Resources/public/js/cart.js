$(document).ready(function(){
    var controller = cart.getController();
    
    //initial handlers bind
    $('.btn-product').bind('click', handleCartButton);
    bindRemoveHandler();
    
    //since cart content will be constantly updated, handlers must be rebinded
    controller.subscribe('REQUEST_FINISHED', bindRemoveHandler);
});

var cart = {
    //@type Object
    cart: null,
    
    /**
     * @type CartController
     */
    controller: null,
    
    /**
     * @type ProductParser
     */
    parser: null,
    
    /**
     * Get cart container
     * 
     * @returns {Object}
     */
    getContainer: function()
    {
        if (!this.cart) {
            this.cart = document.getElementById('cart-preview-container');
        }
        
        return this.cart;
    },
    
    /**
     * Get cart controller
     * 
     * @returns {CartController}
     */
    getController: function()
    {
        if (!this.controller) {
            this.controller = new CartController(this.getContainer());
        }
        
        return this.controller;
    },
    
    /**
     * Get product parser
     * 
     * @returns {ProductParser}
     */
    getParser: function()
    {
        if (!this.parser) {
            this.parser = new ProductParser();
        }
        
        return this.parser;
    }
};

function bindRemoveHandler()
{
    $('.btn-product-remove').bind('click', handleCartItemRemove);
}

function handleCartButton(e)
{
    e.preventDefault();
  
    var productId = cart.getParser().getId(this);
  
    cart.getController().add(productId);
}

function handleCartItemRemove(e)
{
    e.preventDefault();
  
    var productId = cart.getParser().getId(this);
  
    cart.getController().removeAll(productId);
}