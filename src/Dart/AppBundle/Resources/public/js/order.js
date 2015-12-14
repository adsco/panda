$(document).ready(function(){
    var table = $('.order-table'),
        parser = new OrderParser(),
        eventManager = new EventManager(),
        order = new Order(table, parser, eventManager);
    
    
});

function Order(root, parser, eventManager)
{
    /**
     * @type Object
     */
    var _root = null;
    
    /**
     * @type OrderParser
     */
    var _parser = null;
    
    /**
     * @type EventManager
     */
    var _eventManager = null;

    /**
     * @type JSON
     */
    var _els = {};
    
    /**
     * @type Array
     */
    var _rows = [];
    
    var _delivery = {
        min: 500,
        cost: 250
    };
    
    /**
     * Constructor
     * 
     * @param {Object} root - root element
     * @param {OrderParser} parser
     * @param {EventManager} eventManager
     */
    var _construct = function(root, parser, eventManager)
    {
        _root = root;
        _parser = parser;
        _eventManager = eventManager;
        
        _getRows();
        _parseElements();
        _bindHandlers();
    };
    
    /**
     * Get item rows
     */
    var _getRows = function()
    {
        var rows = _extractRows(),
            i;
    
        for (i = 0; i < rows.length; i++) {
            _rows.push(new OrderRow(rows[i], _parser, _eventManager));
        }
    };
    
    /**
     * Extract html rows from root
     * 
     * @return {Array} array of found item rows
     */
    var _extractRows = function()
    {
        return $('.item-row');
    };
    
    /**
     * Initial element parser
     */
    var _parseElements = function()
    {
        var els = _parser.parseTotals(_root);
        
        _els.subTotal = $(els.sub);
        _els.delivery = $(els.delivery);
        _els.total = $(els.total);
    };
    
    /**
     * Bind subscribers
     */
    var _bindHandlers = function()
    {
        _eventManager.subscribe('quantity.change', _update);
        
        _eventManager.subscribe('remove.click', _remove);
    };
    
    /**
     * Get products subtotal
     * 
     * @returns {Integer}
     */
    var _getSubTotal = function()
    {
        var subTotal = 0,
            i;

        for (i = 0; i < _rows.length; i++) {
            subTotal += _rows[i].getPrice();
        }
        
        return subTotal;
    };
    
    /**
     * Get delivery cost
     * 
     * @returns {Integer}
     */
    var _getDelivery = function()
    {
        return _getSubTotal() < _delivery.min ? _delivery.cost : 0;
    };
    
    /**
     * Update totals
     */
    var _update = function()
    {
        _els.subTotal.text(_getSubTotal());
        _els.delivery.text(_getDelivery());
        _els.total.text(_getSubTotal() + _getDelivery());
    };
    
    /**
     * Remove row
     * 
     * @param {OrderRow} row
     */
    var _remove = function(row)
    {
        var index = _rows.indexOf(row);
        
        if (-1 !== index) {
            $(row.getElement()).remove();
            _rows.splice(index, 1);
        }
        
        _update();
    };
    
    _construct.call(this, root, parser, eventManager);
}

function OrderRow(row, parser, eventManager)
{
    /**
     * @type OrderRow
     */
    var _me = this;
    
    /**
     * @type JSON
     */
    var _el = {};
    
    /**
     * @type Object
     */
    var _row = null;
    
    /**
     * @type OrderParser
     */
    var _parser = null;
    
    /**
     * @type EventManager
     */
    var _eventManager = null;
    
    /**
     * @type JSON
     */
    var _handlers = {
        quantity: function()
        {
            _el.total.text(parseInt(_el.quantity.val()) * parseInt(_el.price.text()));
            
            _eventManager.emit('quantity.change');
        },
        remove: function(e)
        {
            e.preventDefault();
            $(_row).remove();
            
            _eventManager.emit('remove.click', _me);
        }
    };
    
    /**
     * Constructor
     * 
     * @param {Object} row
     * @param {OrderParser} parser
     * @param {EventManager} eventManager
     */
    var _construct = function(row, parser, eventManager)
    {
        _row = row;
        _parser = parser;
        _eventManager = eventManager;
        
        _parseElements();
        
        _bindHandlers();
    };
    
    /**
     * @returns {OrderRow._row|Object}
     */
    this.getElement = function()
    {
        return _row;
    };
    
    /**
     * Return item total price
     * 
     * @returns {integer}
     */
    this.getPrice = function()
    {
        return parseInt(_el.total.text());
    };
    
    /**
     * Parse row controls
     */
    var _parseElements = function()
    {
        var item = _parser.parseRow(_row);
        
        _el.remove = $(item.remove);
        _el.price = $(item.price);
        _el.quantity = $(item.quantity);
        _el.total = $(item.total);
        
        _setParent();
    };
    
    /**
     * Attach link to parent element
     */
    var _setParent = function()
    {
        var key;
        
        for (key in _el) {
            _el[key]._parent = _el;
        }
    };
    
    /**
     * Bind control handlers
     */
    var _bindHandlers = function()
    {
        _el.quantity.bind('change', _handlers.quantity);
        
        _el.remove.bind('click', _handlers.remove);
    };
    
    _construct.call(this, row, parser, eventManager);
}

/**
 * Parse product items for specific elements
 */
function OrderParser()
{
    /**
     * List of element class names
     */
    var _class = {
        row: {
            remove: 'item-remove',
            price: 'unit-price',
            quantity: 'quantity',
            total: 'item-total'
        },
        total: {
            sub: 'sub-total',
            delivery: 'delivery',
            total: 'grand-total'
        }
    };
    
    /**
     * Item element parsing
     * 
     * @param {Object} el - item row element
     * @return {JSON} row elements
     */
    this.parseRow = function(el)
    {
        return {
            'remove': _get(el, _class.row.remove),
            'price': _get(el, _class.row.price),
            'quantity': _get(el, _class.row.quantity),
            'total': _get(el, _class.row.total)
        };
    };
    
    /**
     * Total fields parser
     * 
     * @param {Object} el
     * @return {JSON} totals
     */
    this.parseTotals = function(el)
    {
        return {
            'sub': _get(el, _class.total.sub),
            'delivery': _get(el, _class.total.delivery),
            'total': _get(el, _class.total.total)
        };
    };
    
    /**
     * Element searcher by class name
     * 
     * @param {Object} el - parent element
     * @param {String} className - search class name
     * @returns {Object}
     */
    var _get = function(el, className)
    {
        var els = $(el).find('.' + className);
        
        return els[0];
    };
}