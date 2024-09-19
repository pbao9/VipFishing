<script>
$(document).ready(function(){
    // Xử lý sự kiện khi checkbox checkAllPermissions được thay đổi
    $("#checkAllPermissions").change(function(){
        // Nếu checkbox checkAllPermissions được chọn, đánh dấu tất cả các checkboxPermission khác
        if($(this).prop("checked")){
            $(".checkboxPermission").prop("checked", true);
        } else {
            // Nếu checkbox checkAll không được chọn, hủy đánh dấu tất cả các checkboxPermission khác
            $(".checkboxPermission").prop("checked", false);
        }
    });
});
</script>


<script>
$(document).ready(function(){
    // Xử lý sự kiện khi checkbox checkAllPermissions được thay đổi
    $(".clickSelectAllPermissionInModule").change(function(){
        $moduleID = $(this).attr('id');
		if($(this).prop("checked")){
            $(".checkboxFromModule_" + $moduleID).prop("checked", true);
        } else {
            // Nếu checkbox checkAll không được chọn, hủy đánh dấu tất cả các checkboxPermission khác
            $(".checkboxFromModule_" + $moduleID).prop("checked", false);
        }
    });
});
</script>