<?php
/**
* POPUP
*/

class Popup
{

    public static function head($title, $classHelper = false) {
        echo '
            <div class="popup">
                <div class="popup_fon"></div>
                    <div class="popup_wrap">
                        <div class="popup_box '.($classHelper ? $classHelper : '').'">
                            <div class="head">
                                <div class="title">'.$title.'</div>
                                <div class="close_popup"></div>
                            </div>
                            <div class="popup_body">
            ';
    }


    public static function foot() {
        echo '
                        </div>
                    </div>
                </div>
            </div>
            ';
    }


    public static function closeListener() {
        echo '
            <script>
                closePopupListener();
                $(\'.popup_body\').addClass(\'scrollbarHide\').scrollbar();
            </script>
            ';
    }
}

/* End of file */