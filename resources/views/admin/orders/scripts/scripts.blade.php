<x-form id="formCreateVariation" class="d-none" action="#" />
<x-input type="hidden" name="route_search_select_user" :value="route('admin.search.select.user')" />
<x-input type="hidden" name="route_render_info_shipping" :value="route('admin.order.render_info_shipping')" />
<x-input type="hidden" name="route_search_render_product_and_variation" :value="route('admin.search.render_product_and_variation')" />
<x-input type="hidden" name="route_calculate_total_before_save_order" :value="route('admin.order.calculate_total_before_save_order')" />
<x-input type="hidden" name="route_delete_item_order_detail" :value="route('admin.order_detail.delete')" />

<x-input type="hidden" name="route_add_product" :value="route('admin.order.add_product')" />
<script>
    
    function searchProduct(keyword, elmRender){
        $.ajax({
            type: "GET",
            url: $('input[name="route_search_render_product_and_variation"]').val(),
            data: { key: keyword },
            success: function(response){
                $(elmRender).html(response);
            },
            error: function(response){
                handleAjaxError(response);
            }
        })
    }
    function addProduct(payload){
        var url = $('input[name="route_add_product"]').val(),
        user_id = $('select[name="order[user_id]"]').val();
        payload.user_id = user_id ? user_id : 0;

        closeModal('#modalAddProduct');
        $.ajax({
            type: "GET",
            url: url,
            data: payload,
            success: function(response){
                $('#tableProduct tbody').prepend(response.data);
                $('#tableProduct tbody tr.no-product').hide();
            },
            error: function(response){
                handleAjaxError(response);
            }
        })
    }
    function closeModal(modal){
        $(modal).find('.btn-close').trigger('click');
    }
    function checkAddProduct(productId, productVariationId = null){
        var elm = '#tableProduct tbody tr.item-product' + '.product-' + productId;
        if(productVariationId){
            elm += '.product-variation-' + productVariationId;
        }
        if($(elm).length > 0){
            return true;
        }
        return false;
    }

    function deleteItemOrderDetail(id, elm){
        var url = $('input[name="route_delete_item_order_detail"]').val();
        $.ajax({
            type: "DELETE",
            url: url + '/' + id,
            data: { _token: token },
            success: function(response){
                removeElmItemOrderDetail(elm);
            },
            error: function(response){
                handleAjaxError(response);
            }
        })
    }
    function removeElmItemOrderDetail(elm){
        $(elm).parents('.item-product').remove();
        if($('#tableProduct tbody tr.item-product').length == 0){
            $('#tableProduct tbody tr.no-product').show();
        }
    }
    $(document).on('click', '.remove-item-product', function(e){
        var id = $(this).data('id'), that = this;
        if(!confirm('Bạn có chắc là muốn thực hiện?')){
            return;
        }
        if(id){
            deleteItemOrderDetail(id, that);
        }else{
            removeElmItemOrderDetail(that)
        }
    })
    $(document).ready(function(e){
        select2LoadData($('input[name="route_search_select_user"]').val());
        searchProduct('', '#showSearchResultProduct');
        $("#inputSearchProduct").keyup($.debounce(500, function(e) {
            searchProduct($(this).val(), '#showSearchResultProduct');
        }));
    });
    $(document).on('click', '.add-product', function (e) {
        var that = $(this), 
        productId = that.data('product-id');
        if(checkAddProduct(productId)){
            msgWarning('Sản phẩm này đã được thêm');
            return;
        }
        addProduct({
            product_id: productId
        });
    })
    $(document).on('click', '.add-product-variation', function (e) {
        var that = $(this), 
        productId = that.data('product-id'),
        productVariationId = that.data('product-variation-id');
        if(checkAddProduct(productId, productVariationId)){
            msgWarning('Sản phẩm này đã được thêm');
            return;
        }
        addProduct({
            product_id: productId,
            product_variation_id: productVariationId,
        });
    })
    $(document).on('change', 'select[name="order[user_id]"]', function(e){
        var url = $('input[name="route_render_info_shipping"]').val(),
        userId = $(this).val();
        if(userId){
            $.ajax({
                type: "GET",
                url: url,
                data: { user_id: userId },
                success: function(response){
                    $("#infoShipping").html(response);
                },
                error: function(response){
                    handleAjaxError(response);
                }
            })
        }
    });
    $(document).on('DOMSubtreeModified change', '#tableProduct tbody', $.debounce(1000, function (e) {
        var url = $('input[name="route_calculate_total_before_save_order"]').val();

        $.ajax({
                type: "GET",
                url: url,
                data: $('#formOrder').serialize(),
                success: function(response){
                    $("#tableTotalOrder").replaceWith(response.data);
                },
                error: function(response){
                    handleAjaxError(response);
                }
            })
    }))
    $(document).on('change', 'input[name="order_detail[product_qty][]"]', $.debounce(1000, function (e) {
        var unitPrice = $(this).parents('.item-product').find('td.unit-price').text();
        unitPrice = parseInt(unitPrice.replace(new RegExp(currency + "|,", "g"), "")) * $(this).val();
        $(this).parents('.item-product').find('td.total-price').text(formatPrice(unitPrice));
    }))
</script>
