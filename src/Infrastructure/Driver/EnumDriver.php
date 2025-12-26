<?php

namespace DBCompare\Infrastructure\Driver;

enum EnumDriver: string
{
    case MYSQL = 'mysql';
    case POSTGRESQL = 'pgsql';
    case SQLITE = 'sqlite';
}