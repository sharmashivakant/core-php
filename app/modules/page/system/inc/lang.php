<div class="language <?= Request::getParam('color_dropdown') ?>">
    <?php
    $redirect = str_replace('/antal/', '/', $_SERVER['REQUEST_URI']);
    ?>

    <div class="language__item"><span> <?= checkLocation((User::get('lang') ?: getCookie('lang')) ?: 'en') ?> </span></div>
    <ul class="language_list">
        <li onclick="load('page/change_lang/en', 'url=<?= $redirect ?>');"
            class="<?php if (((User::get('lang') ?: getCookie('lang')) ?: 'en') == 'en') echo 'active'; ?>">UK
        </li>
        <li onclick="load('page/change_lang/us', 'url=<?= $redirect ?>');"
            class="<?php if (((User::get('lang') ?: getCookie('lang')) ?: 'en') == 'us') echo 'active'; ?>">

            US
        </li>
        
        
    </ul>   
</div>