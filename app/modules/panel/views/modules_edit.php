<span class="close-popup" onclick="closePopup();"><span class="icon-close">X</span></span>

<form id="popup_form" class="pop_form" style="margin-top: 24px;">
    <div class="flex-start">
        <div style="margin-right: 16px;">
            <div class="pf_row">
                <label>Version</label>
                <input type="text" name="version" id="version" value="<?= $this->edit->version ?>" /></br>
            </div>
        </div>
    </div>

    <a class="btn__" onclick="load('panel/modules_edit/<?= $this->edit->id ?>', 'form:#popup_form'); return false;" style="cursor: pointer;">Save</a>
</form>

<script>
    $(document).ready(function () {
        $("#site").addClass('popup-open');
    });
</script>