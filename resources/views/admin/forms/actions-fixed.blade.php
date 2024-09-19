<div id="blockSubmitFixed" class="w-100 position-fixed top-0 end-0 z-3 bg-white text-end p-2 shadow-sm" style="display: none;">
    <div class="d-flex justify-content-end align-items-center h-100 gap-2">
        <x-button.submit :title="__('save')" name="submitter" value="save" />
        <x-button type="submit" name="submitter" value="saveAndExit">
            @lang('save&exit')
        </x-button>
    </div>
</div>
