<span class="close-popup" onclick="closePopup();"><span class="icon-close" onclick="closePopup();"></span></span>

<h4 class="title-popup">Request Interview</h4>
<form id="apply_form" class="popup-form">
    <div class="pf-flex">
        <div class="pf-column">
           <!-- <div class="pf-row">
                <label class="pf-label">Date</label>
                <input class="pf-text-field" type="text" name="date">
            </div>-->
            <div class="pf-row">
                <label class="pf-label">Name</label>
                <input class="pf-text-field" type="text" name="name">
            </div>
            <div class="pf-row">
                <label class="pf-label">Company</label>
                <input class="pf-text-field" type="text" name="company_name">
            </div>
        </div>
        <div class="pf-column">
            <div class="pf-row">
                <label class="pf-label">Email</label>
                <input class="pf-text-field" type="text" name="email">
            </div>
            <div class="pf-row">
                <label class="pf-label">Direct Telephone Number</label>
                <input class="pf-text-field" type="text" name="tel">
            </div>
        </div>
    </div>

    <label class="checkBox">
        <input type="checkbox" name="check" value="yes">
        <span class="check-title">I consent for The <?= SITE_NAME; ?> to contact me with further information regarding this candidate</span>
    </label>

    <button class="outline-grey-btn" type="submit" onclick="load('open-request-interview/<?= $this->profile->id; ?>', 'form:#apply_form'); return false;">SUBMIT</button>
</form>

<script>
    $("body").addClass('popup-open');
</script>