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
    public function deleteRecordFromTable($table, $params): void
    {
        /** @var \Codeception\Lib\Driver\Db $db */
        $db = $this->getDbDriver();
//        $sql = "DELETE from lc_customers where firstname = 'Фредд'";
//        $db->executeQuery($sql);
        $db->deleteQueryByCriteria($table, $params);
    }

//    public function getDbDataTest($params)
//    {
//        /** @var \Codeception\Lib\Driver\Db $db */
//        $db = $this->getDbDriver();
//        $db->load(['SELECT * from lc_customers']);
////        $db->select('firstname', 'lc_customers', $params);
//    }

}