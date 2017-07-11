<?php

class Constants {

    const CREATE_NEWS = 1;
    const UPDATE_NEWS = 2;
    const CHANGE_NEWS_STATE = 3;
    const VIEW_NEWS_LOG = 4;
    const DISTRIBUTION_USER_RIGHTS = 5;
    const CREATE_USER = 6;
    const UPDATE_USER_INFO = 7;
    const CHANGE_USER_STATE = 8;
    const ONLINE_SUPPORT = 9;
    const CHANGE_USER_PWD = 10;
    const MANAGER_ADV = 11;

    /* === USER SUPER ADMIN === */
    const SUPER_ADMIN = 1;

    /* === NEWS LOG TYPE === */
    const LOG_CREATING  = 1;
    const LOG_UPDATING = 2;
    const LOG_CHANGE_STATE = 3;
    const LOG_APPROVAL = 4;
    const LOG_RECOVER = 5;
    const LOG_DELETE = 6;


    /* === NEWS STATE ===*/
    const PENDDING = 0;
    const ENABLE = 1;
    const DISABLE = 2;
    const DETELED = 3;
    
    /* === DIRECTION === */
    public static $DIRECTION = array('Liên hệ', "Đông", "Tây", "Nam", "Bắc", "Đông-Bắc", "Tây-Bắc", "Đông-Nam", "Tây-Nam");
}

?>