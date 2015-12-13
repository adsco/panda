/**
 * Bridge between server side cart and frontend cart
 * 
 * @package panda
 * @subpackage cart
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
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
     * Alien component, should be moved
     * 
     * @type Object
     */
    var _eventHandler = {
        /**
         * List of supported events
         */
        _events: [
            'REQUEST_STARTED',
            'REQUEST_FINISHED'
        ],
        /**
         * List of subscribers
         */
        _subscribers: {
            
        },
        /**
         * Event trigger
         * 
         * @param {string} eventName
         */
        trigger: function(eventName)
        {
            var handlers = this._subscribers[eventName],
                i;
            
            if (!handlers || 0 === handlers.length) {
                return;
            }
            
            for (i = 0; i < handlers.length; i++) {
                handlers[i]();
            }
        },
        /**
         * Subscribers registration point
         * 
         * @param {string} eventName
         * @param {function} handler
         */
        subscribe: function(eventName, handler)
        {
            if (-1 === this._events.indexOf(eventName)) {
                throw new Error('Event "' + eventName + '" is not supported');
            }
            
            if (!this._subscribers.hasOwnProperty(eventName)) {
                this._subscribers[eventName] = [];
            }
            
            this._subscribers[eventName].push(handler);
        }
    };

    /**
     * @type {Object}
     */
    var _cartContainer = null;

    /**
     * Constructor
     * 
     * @param {Object} cartContainer - DOM element, cart content
     */
    var construct = function(cartContainer)
    {
        _cartContainer = cartContainer;
    };
    
    /**
     * _eventHandler.subscribe method proxy
     * 
     * @param {string} eventName
     * @param {function} handler
     */
    this.subscribe = function(eventName, handler)
    {
        _eventHandler.subscribe(eventName, handler);
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
        _eventHandler.trigger('REQUEST_STARTED');
        
        $.ajax({
            url: '/app_dev.php' + url
        }).done(function(response){
            if (response.success) {
                _update(response.data);
            } else {
                alert('Sorry, something went wrong');
            }
        }).fail(function(response){
            
        }).always(function(){
            _eventHandler.trigger('REQUEST_FINISHED');
        });
    };

    //call constructor
    construct.call(this, cartContainer);
}
