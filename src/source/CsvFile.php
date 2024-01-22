<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\source;

    use Coco\dataMigration\abstracts\DataSource;
    use League\Csv\Reader;
    use League\Csv\Statement;

class CsvFile extends DataSource
{
    public ?Reader    $csv  = null;
    public ?Statement $stmt = null;

    public function __construct($file)
    {
        $this->csv  = Reader::createFromPath($file, 'r');
        $this->stmt = Statement::create();
    }

    /**
     * @param Statement|null $stmt
     */
    public function setStmt(?Statement $stmt): void
    {
        $this->stmt = $stmt;
    }

    /**
     * @return Statement|null
     */
    public function getStmt(): ?Statement
    {
        return $this->stmt;
    }

    public function getIterator(): iterable
    {
        return $this->stmt->process($this->csv);
    }
}
