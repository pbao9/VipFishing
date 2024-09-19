<x-form id="formCreateVariation" class="d-none" action="#" />
<script>
    var productTypeSimple = ".type-simple";
        productTypeVariable = ".type-variable";
        firstForProductTypeSimple = "#tabPrice";
        firstForProductTypeVariable = "#tabInventory";
        selectAttribute = '#selectAttribute';
        selectProductType = "#selectProductType",
        formCreateVariation = "#formCreateVariation",
        flagDelete = false;


    function deleteAjaxProductData(urlDelete){
        $.ajax({
            type: "DELETE",
            url: urlDelete,
            data: { _token: token },
            async: false,
        }).done(function(response){
            flagDelete = true;
            console.log(flagDelete);

        }).fail(function(response){
            handleAjaxError(response);
        })
        console.log(flagDelete);
        return flagDelete;
    }

    //clone form de render ra các biển thể của sp
    function cloneInputAttribute(form) {
        $(form).html('');
        $('input.input-product-attribute-id').each(function(i, obj) {
            $(obj).clone(true).appendTo(form);
        });
        $('select.select-product-attribute-variation-id').each(function(i, obj) {
            var value = $(obj).val();
            value.forEach(function(value) {
                var x = document.createElement("INPUT");
                x.setAttribute("type", "hidden");
                x.setAttribute("name", "product_attribute[attribute_variation_id][" + i + "][]");
                x.setAttribute("value", value);
                $(form).append(x);
            });
        });
    }
    //sắp xếp thuộc tính và biến thể
    function reorderElement(elm = 'div.reorder-list') {
        $(elm).mousedown(function() {
            // set fixed height to prevent scroll jump
            // when dragging from bottom
            $(this).height($(this).height());
        }).mouseup(function() {
            // set height back to auto 
            // when user just clicked on item
            $(this).height('auto');
        }).sortable({
            connectWith: elm,
            placeholder: "portlet-placeholder",
            tolerance: 'pointer',
            start: function() {
                // dragging is happening
                // and scroll jump was prevented,
                // we can set it back to auto
                $(this).height('auto');
            }
        });
    }
    
    $(document).ready(function() {
        checkProductType();
        addSelect2();
        reorderElement();
    });
    function checkProductType(){
        if($(selectProductType).val() == 2){
            $(productTypeSimple).hide();
            $(productTypeVariable).show();
            $(firstForProductTypeVariable).trigger("click");
            cloneInputAttribute(formCreateVariation);
        }
    }

    // kiểm tra loại sp để check tab data
    $(selectProductType).change(function(e) {
        if ($(this).val() == 1) {
            $(productTypeSimple).show();
            $(productTypeVariable).hide();
            $(firstForProductTypeSimple).trigger("click");
        } else if ($(this).val() == 2) {
            $(productTypeSimple).hide();
            $(productTypeVariable).show();
            $(firstForProductTypeVariable).trigger("click");
        }
    });
</script>
