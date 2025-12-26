<?php

namespace DBCompare\Infrastructure\Output;

enum EnumsOutPut: string
{
    case TERMINAL = 'terminal';
    case JSON = 'json';
    case HTML = 'html';
    case CSV = 'csv';
    case SEPARATOR = ' | ';
    case NEW_LINE = PHP_EOL;
    case SPACE = ' ';
    case BORDER_CHAR = '-';
    case CORNER_CHAR = '+';
    case LINE_CHAR = '|';
    case PADDING = '1';
}