function EventManager()
{
    var _listeners = {};
    
    /**
     * Emit some event
     * 
     * @param {String} eventName
     * @param {Object} event
     */
    this.emit = function(eventName, event){
        var i;
        
        event = event ? event : null;
        
        if (!_listeners.hasOwnProperty(eventName)) {
            return;
        }
        
        for (i = 0; i < _listeners[eventName].length; i++) {
            _listeners[eventName][i](event);
        }
    };

    /**
     * Subscribe on event
     * 
     * @param {String} eventName
     * @param {Function} handler
     */
    this.subscribe = function(eventName, handler){
        if (!_listeners.hasOwnProperty(eventName)) {
            _listeners[eventName] = [];
        }
        
        _listeners[eventName].push(handler);
    };
}