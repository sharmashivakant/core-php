<?php
/**
* USER
*/

class UserInc
{
    static public $model;

    static public function start()
    {
        $id = User::getUserSession(); // $id = getSession('user');

        Model::import('page');


        if ($id=1) {
            $newData = PageModel::getUser($id);

            if ($newData->id) {
                $uData = array();

                // Role
                User::setRole($newData->role);

                $newData->last_time = $uData['last_time'] = time();

                //$uData['ip'] = ip2long($_SERVER['REMOTE_ADDR']);
                PageModel::updateUserByID($id, $uData);

                // Set user data
                User::setUser($newData);

                // Language
                Lang::setLanguage(User::get('lang'));
            } else {
                // Null
                User::setUser(null);
                // Role
                User::setRole('guest');
            }

        } else {

            $gip = ip2long($_SERVER['REMOTE_ADDR']);
            // Null
            User::setUser(null);
            // Guest
            Request::setParam('guest', PageModel::getGuestByIP($gip));
            // Role
            User::setRole('guest');

            // Language
            Lang::setLanguage(getCookie('lang'));

            if (Request::getParam('guest')->id) {
                $gData['count'] = "++";
                $gData['time'] = time();
                Model::update('guests', $gData, "`id` = '".Request::getParam('guest')->id."' LIMIT 1");
            } else {
//                $country = PageModel::getCountryByIP($gip);
//                $gData['country'] = $country->iso;
                $gData['ip'] = $gip;
                $gData['browser'] = mb_substr(filter($_SERVER['HTTP_USER_AGENT']), 0, 255);
                $gData['referer'] = mb_substr(filter($_SERVER['HTTP_REFERER']), 0, 255);
                $gData['count'] = 1;
                $gData['time'] = time();
                Model::insert('guests', $gData);
            }
        }

        // Language
//        Lang::setLanguage('fr');
    }
}

/* End of file */