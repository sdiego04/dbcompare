<?php

namespace DBCompare\Helpers;

use DBCompare\Infrastructure\DataBase\DataBaseDto;

trait DataBaseHelper
{
    function getSecondDataBaseDsn(): DataBaseDto
    {
        return new DataBaseDto(
            host: getenv('DB_COMPARE_DB_HOST_SECONDARY'),
            database: getenv('DB_COMPARE_DB_NAME_SECONDARY'),
            username: getenv('DB_COMPARE_DB_USER_SECONDARY'),
            password: getenv('DB_COMPARE_DB_PASSWORD_SECONDARY'),
            charset: 'utf8'
        );
    }

    function getFirstDataBaseDsn(): DataBaseDto
    {
        return new DataBaseDto(
            host: getenv('DB_COMPARE_DB_HOST'),
            database: getenv('DB_COMPARE_DB_NAME'),
            username: getenv('DB_COMPARE_DB_USER'),
            password: getenv('DB_COMPARE_DB_PASSWORD'),
            charset: 'utf8'
        );
    }
}