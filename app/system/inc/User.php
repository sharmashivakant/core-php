<?php
/**
 * REQUEST
 *
 */

class User
{
    static public $role; // user role

    static public $properties = array(); // user fields

    // todo add method: isAuth

    /**
     * @param string $value  ex: guest,user,moder,admin
     */
    static public function setRole($value)
    {
        self::$role = $value;
    }

    /**
     * @return string  guest,user,moder,admin
     */
    static public function getRole()
    {
        return self::$role;
    }

    /**
     * @param string|array $role
     * @return bool
     */
    static public function checkRole($role)
    {
        if (is_array($role))
            return in_array(self::$role, $role);
        else
            return self::$role === $role;
    }

    /**
     * @param object $value
     */
    static public function setUser($value)
	{
//	    if (is_object($value) || is_null($value))
        self::$properties = $value; // object or null
	}

    /**
     * @param $name
     * @return mixed
     */
    static public function get($name = false)
    {
        if ($name === false)
            return self::$properties;

        return self::$properties=$name;
    }


    /**
     * @param $userID
     * @return int
     */
    static public function setUserSession($userID)
    {
        return setSession('user', $userID, 'int'); // save user ID in session
    }

    /**
     * @return int
     */
    static public function getUserSession()
    {
        return getSession('user', 'int'); // get user ID from session
    }
}
/* End of file */