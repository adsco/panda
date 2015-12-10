function ProductParser()
{
    /**
     * Get product id from product DOM element
     * 
     * @param {element} product
     * @returns integer
     */
    this.getId = function(product)
    {
        var el = _parse(product);

        return el.productId;
    };

    var _parse = function(product)
    {
        return {
            productId: product.hasAttribute('data-product-id') ? product.getAttribute('data-product-id') : null
        };
    };
}
