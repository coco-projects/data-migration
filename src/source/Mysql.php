<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\source;

    use Coco\dataMigration\abstracts\DataSource;
    use Coco\webuploader\Db;
    use think\db\BaseQuery;
    use think\db\ConnectionInterface;
    use think\DbManager;

class Mysql extends DataSource
{
    protected ?ConnectionInterface $dbConnect = null;
    protected ?string              $table     = null;
    protected static ?Db           $ins       = null;

    protected array $dbConfig = [
        'hostname' => '127.0.0.1',
        'password' => 'root',
        'username' => 'root',
        'charset'  => 'utf8mb4',
    ];

    //    https://www.kancloud.cn/manual/think-orm/1257999
    public function __construct($dbName, $table, $config = [])
    {
        foreach ($config as $k => $v) {
            if (isset($this->dbConfig[$k])) {
                $this->dbConfig[$k] = $v;
            }
        }

        $this->dbConfig['type']     = 'mysql';
        $this->dbConfig['database'] = $dbName;
        $this->table                = $table;

        $dbManager = new DbManager();

        $dbManager->setConfig([
            'default'     => 'webuploader',
            'connections' => [
                'webuploader' => $this->dbConfig,
            ],
        ]);

        $this->dbConnect = $dbManager->connect('webuploader');
    }

    public function getDbHandler(): BaseQuery
    {
        return $this->dbConnect->table($this->table);
    }

    /**
     * @return ConnectionInterface|null
     */
    public function getDbConnect(): ?ConnectionInterface
    {
        return $this->dbConnect;
    }

    public function getIterator(): iterable
    {
        return $this->getDbHandler()->cursor();
    }
}
