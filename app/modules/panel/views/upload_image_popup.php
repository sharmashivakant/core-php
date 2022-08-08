<span class="close-popup" onclick="closePopup();"><span class="icon-close">X</span></span>

<div style="width: 400px; height: 300px;" id="crop_image">
    <img id="target" src="<?= _SITEDIR_ ?>data/tmp/<?= $this->imagename . '?t=' . randomHash() ?>" alt="" width="400px" height="300px">
</div>

<form id="image_form" class="pop_form" style="margin-top: 24px;">
    <div class="flex-start">
        <div style="margin-right: 16px;">
            <div class="pf_row">
                <label>Left corner X:</label>
                <input type="text" name="x1" id="x1" value="0" /></br>
            </div>
            <div class="pf_row">
                <label>Left corner Y:</label>
                <input type="text" name="y1" id="y1" value="0" /><br/>
            </div>
        </div>

        <div class="flex-start">
            <!--            <div class="flex-vc" style="margin-right: 12px;">-->
            <!--                <input type="checkbox" id="con"> <i class="fas fa-lock" title=""></i><br/>-->
            <!--            </div>-->
            <div>
                <div class="pf_row">
                    <label>Width:</label>
                    <input type="text" name="w"  id="w" value="0" /><br/>
                </div>
                <div class="pf_row">
                    <label>Height:</label>
                    <input type="text" name="h" id="h" value="0" /><br/>
                </div>
            </div>
        </div>
    </div>

    <a class="btn__" onclick="load('panel/crop', 'name=<?=  $this->imagename; ?>', 'form:#image_form', 'preview=<?= $this->preview ?>', 'field=<?= $this->field ?>'); return false;">Crop</a>
</form>

<div class="solo_test"></div>

<script>
    $(document).ready(function () {
        $("#site").addClass('popup-open');

        var jcrop;
        let x1 = document.querySelector('input[name=x1]');
        let y1 = document.querySelector('input[name=y1]');
        let w = document.querySelector('input[name=w]');
        let h = document.querySelector('input[name=h]');


        x1.addEventListener('change', function () {
            jQuery(function($) {
                jcrop = $('#target').Jcrop({
                    // onSelect: showCoords,
                    setSelect: [Number(x1.value), Number(y1.value), Number(x1.value) + Number(w.value), Number(y1.value) + Number(h.value)]
                });
            });
        })

        y1.addEventListener('change', function () {
            jQuery(function($) {
                jcrop = $('#target').Jcrop({
                    // onSelect: showCoords,
                    setSelect: [Number(x1.value), Number(y1.value), Number(x1.value) + Number(w.value), Number(y1.value) + Number(h.value)]
                });
            });
        })


        w.addEventListener('change', function () {
            let checkCon = document.querySelector('#con:checked');

            if (checkCon !== null) {
                let h = document.querySelector('input[name=h]').value;
                document.querySelector('input[name=h]').value = Number(h) - (Number(wOld) -  Number(w.value));
                wOld = document.querySelector('input[name=w]').value;
            }

            jQuery(function($) {
                jcrop = $('#target').Jcrop({
                    // onSelect: showCoords,
                    setSelect: [Number(x1.value), Number(y1.value), Number(x1.value) + Number(w.value), Number(y1.value) + Number(h.value)]
                });
            });
        })

        h.addEventListener('change', function () {
            let checkCon = document.querySelector('#con:checked');

            if (checkCon !== null) {
                let w = document.querySelector('input[name=w]').value;
                document.querySelector('input[name=w]').value = Number(w) - (Number(hOld) -  Number(h.value));
                hOld = document.querySelector('input[name=h]').value;
            }

            jQuery(function($) {
                jcrop = $('#target').Jcrop({
                    // onSelect: showCoords,
                    setSelect: [Number(x1.value), Number(y1.value), Number(x1.value) + Number(w.value), Number(y1.value) + Number(h.value)]
                });
            });
        })


        let wOld = document.querySelector('input[name=w]').value;
        let hOld = document.querySelector('input[name=h]').value;


        // //change crop window on click button
        // button = document.querySelector('#change');
        // button.addEventListener('click', event => {
        //
        //     let x1 = document.querySelector('input[name=x1]');
        //     let y1 = document.querySelector('input[name=y1]');
        //     let w = document.querySelector('input[name=w]');
        //     let h = document.querySelector('input[name=h]');
        //
        //     jQuery(function($) {
        //         jcrop =  $('#target').Jcrop({
        //             // onSelect: showCoords,
        //             setSelect: [Number(x1.value), Number(y1.value), Number(x1.value) + Number(w.value), Number(y1.value) + Number(h.value)]
        //         });
        //
        //
        //     });
        //
        // })

        //-------------------------------------------//


        function showCoords(c) {
            // variables can be accessed here as
            // c.x, c.y, c.x2, c.y2, c.w, c.h
            $('input[name=x1]').val(c.x);
            $('input[name=y1]').val(c.y);
            $('input[name=w]').val(c.w);
            $('input[name=h]').val(c.h);

            wOld = document.querySelector('input[name=w]').value;
            hOld = document.querySelector('input[name=h]').value;
        }

        jQuery(function($) {
            let x = Number('<?= $this->default_x ?>');
            let y = Number('<?= $this->default_y ?>');
            let w = x + Number('<?= $this->width ?>');
            let h = y + Number('<?= $this->height ?>');

            console.log(x);
            console.log(y);
            console.log(w);
            console.log(h);

            jcrop = $('#target').Jcrop({
                setSelect: [x, y, w, h],// you have set proper x and y coordinates here
                onSelect: showCoords,
            });
        });

    })
</script>
