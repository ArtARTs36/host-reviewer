<?php

namespace App\Service;

use App\Models\DbConnection;

class DbConnectionService
{
    /**
     * @param DbConnection $connection
     * @param string $error
     * @return bool
     */
    public function checkRealConnection(DbConnection $connection, string &$error)
    {
        try {
            $this->createPdo($connection);

            return true;
        } catch (\Exception $exception) {
            $error = $exception->getMessage();

            return false;
        }
    }

    /**
     * @param DbConnection $con
     * @return \PDO
     */
    private function createPdo(DbConnection $con): \PDO
    {
        $access = $con->toAccess();

        return new \PDO($access->toDsn($con->system->toEntity()), $access->user, $access->password);
    }
}
