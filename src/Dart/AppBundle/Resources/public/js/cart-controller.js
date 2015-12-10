function CartController(cartContainer)
{
    /**
     * @type JSON
     */
    var _url = {
        add: '/cart/add/{id}',
        remove: '/cart/remove/{id}',
        removeAll: '/cart/remove-all/{id}',
        clear: '/cart/clear'
    };

    /**
     * @type {Object}
     */
    var _cartContainer = null;

    /**
     * Constructor
     * 
     * @param {Object} cartContainer - DOM element, cart content
     * @param {Object} cartLabel - DOM element, cart label
     */
    var construct = function(cartContainer)
    {
        _cartContainer = cartContainer;
    };

    /**
     * Add product to cart
     * 
     * @param {integer} id - product id
     */
    this.add = function(id){
        _request(_url.add.replace('{id}', id));
    };

    /**
     * Remove product from cart
     * 
     * @param {integer} id - product id
     */
    this.remove = function(id){
        _request(_url.remove.replace('{id}', id));
    };

    /**
     * Remove all instances of product
     * 
     * @param {integer} id - product id
     */
    this.removeAll = function(id){
        _request(_url.removeAll.replace('{id}', id));
    };

    /**
     * Remove all products from cart
     * 
     * @returns {undefined}
     */
    this.clear = function(){
        alert('Not implemented yet');
    };

    /**
     * Update cart
     * 
     * @param {JSON} data - server response data
     * @returns {undefined}
     */
    var _update = function(data)
    {
        if (null === _cartContainer) {
            return;
        }
        
        console.log(_cartContainer);

        _updateCart(data);
    };

    /**
     * Actual update content function
     * 
     * @param {JSON} data
     */
    var _updateCart = function(data)
    {
        $(_cartContainer).html(data.preview);
    };

    /**
     * Make request to server
     * 
     * @param {string} url
     */
    var _request = function(url)
    {
        $.ajax({
            url: '/app_dev.php' + url
        }).done(function(response){
            if (response.success) {
                _update(response.data);
            } else {
                alert('Sorry, something went wrong');
            }
            
            console.log(response);
        }).fail(function(response){
            console.log(response);
        });
    };

    //call constructor
    construct.call(this, cartContainer);
}
