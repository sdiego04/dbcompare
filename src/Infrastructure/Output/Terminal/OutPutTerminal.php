<?php

namespace DBCompare\Infrastructure\Output\Terminal;

use DBCompare\Infrastructure\Output\EnumsOutPut;

class OutPutTerminal
{
    private array $headers = [];
    private array $rows = [];
    private array $columnWidths = [];
    public function print(): void
    {
        $data = \DBCompare\Service\GetJsonFile::execute();
        echo PHP_EOL . "======= Database Compare tables result =======" . PHP_EOL . PHP_EOL;
        $headers = ['Column', 'Table Database One :Homolog', 'Table Database Two: Production'];
        foreach ($data['tables']['only_in_db_one'] as $table) {
             $rows[] = [$table, 'Exists', 'Does not exist'];
        }
        foreach ($data['tables']['only_in_db_two'] as $table) {
             $rows[] = [$table, 'Does not exist', 'Exists'];
        }
        
        $this->setHeaders($headers);
        $this->setRows($rows);
        $this->calculateColumnWidths();
        $this->renderTopBorder();
        $this->renderHeader();
        $this->renderSeparator();
        $this->renderRows();
        $this->renderBottomBorder(); 

        echo PHP_EOL . "======= Database Compare columns result =======" . PHP_EOL . PHP_EOL;
        $headers = ['Column Name', 'Only in Database One : Homolog', 'Only in Database Two : Production'];
        $rows = [];
        foreach ($data['columns']['only_in_db_one'] as $tableName => $columns) {
            foreach ($columns as $column) {
                $rows[] = [$tableName, $column, 'Does not exist'];
            }
        }
        foreach ($data['columns']['only_in_db_two'] as $tableName => $columns) {
            foreach ($columns as $column) {
                $rows[] = [$tableName, 'Does not exist', $column];
            }
        }
        $this->setHeaders($headers);
        $this->setRows($rows);
        $this->calculateColumnWidths();
        $this->renderTopBorder();
        $this->renderHeader();
        $this->renderSeparator();
        $this->renderRows();
        $this->renderBottomBorder();
    }

    private function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    private function setRows(array $rows): void
    {
        $this->rows = $rows;
    }

    private function calculateColumnWidths()
    {
        $this->columnWidths = [];
        foreach ($this->headers as $i => $header) {
            $this->columnWidths[$i] = strlen($header);
            foreach ($this->rows as $row) {
                $this->columnWidths[$i] = max($this->columnWidths[$i], strlen($row[$i]));
            }
        }
    }

    private function renderTopBorder(): void
    {
        echo EnumsOutPut::CORNER_CHAR->value;
        foreach ($this->columnWidths as $w) {
            echo str_repeat(EnumsOutPut::BORDER_CHAR->value, $w + 2) . EnumsOutPut::CORNER_CHAR->value; 
        }
        echo EnumsOutPut::NEW_LINE->value;
    }

    private function renderHeader(): void
    {
        echo '| ';
        foreach ($this->headers as $i => $header) {
            echo str_pad($header, $this->columnWidths[$i]) . EnumsOutPut::SEPARATOR->value;
        }
        echo EnumsOutPut::NEW_LINE->value;
    }

    private function renderSeparator(): void
    {
        echo EnumsOutPut::CORNER_CHAR->value;
        foreach ($this->columnWidths as $w) {
            echo str_repeat(EnumsOutPut::BORDER_CHAR->value, $w + 2) . EnumsOutPut::CORNER_CHAR->value;
        }
        echo EnumsOutPut::NEW_LINE->value;
    }

    private function renderRows(): void
    {
        foreach ($this->rows as $row) {
            echo '| ';
            foreach ($row as $i => $cell) {
                echo str_pad($cell, $this->columnWidths[$i]) . EnumsOutPut::SEPARATOR->value;
            }
            echo EnumsOutPut::NEW_LINE->value;
        }
    }

    private function renderBottomBorder(): void
    {
        echo EnumsOutPut::CORNER_CHAR->value;
        foreach ($this->columnWidths as $w) {
            echo str_repeat(EnumsOutPut::BORDER_CHAR->value, $w + 2) . EnumsOutPut::CORNER_CHAR->value;
        }
        echo EnumsOutPut::NEW_LINE->value;
    }
}
