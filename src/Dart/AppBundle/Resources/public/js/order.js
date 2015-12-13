function Order()
{
    this.addWatcher = function()
    {
        var items = $('.item-row'),
            i;
    
        //handle items
    };
}

/**
 * Parse product items for specific elements
 */
function ItemParser()
{
    /**
     * List of element class names
     */
    var _class = {
        unit: 'unit-price',
        quantity: 'quantity',
        total: 'item-total'
    };
    
    /**
     * Item element parsing
     * 
     * @param {Object} el - item row element
     */
    this.parse = function(el)
    {
        return {
            'unit': get(el, _class.unit),
            'quantity': get(el, _class.quantity),
            'total': get(el, _class.total)
        };
    };
    
    /**
     * Element searcher by class name
     * 
     * @param {Object} el - parent element
     * @param {string} className - search class name
     * @returns {Object}
     */
    var get = function(el, className)
    {
        var els = $(el).find('.' + className);
        
        return els[0];
    };
}