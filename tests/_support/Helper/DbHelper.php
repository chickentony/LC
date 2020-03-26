<?php

declare(strict_types=1);

namespace Helper;

use Codeception\Module;

class DbHelper extends Module
{
    /**
     * @return Module
     * @throws \Codeception\Exception\ModuleException
     */
    private function getDbModule(): Module
    {
        return $this->getModule('Db');
    }

    /**
     * @return mixed
     * @throws \Codeception\Exception\ModuleException
     */
    private function getDbDriver()
    {
        return $this->getDbModule()->_getDriver();
    }

    /**
     * @param string $table
     * @param array $params
     * @throws \Codeception\Exception\ModuleException
     */
    public function deleteRecordFromTable(string $table, array $params): void
    {
        /** @var \Codeception\Lib\Driver\Db $db */
        $db = $this->getDbDriver();
        $db->deleteQueryByCriteria($table, $params);
    }
}
