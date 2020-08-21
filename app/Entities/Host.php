<?php

namespace App\Entities;

use App\Concerns\Entity;

class Host implements Entity
{
    protected $attributes;

    protected $blackIps = [];

    protected $whiteIps = [];

    /**
     * Host constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;

        if (!empty($attributes['ips'])) {
            $onlyIp = function (array $item) {
                return $item['ip'];
            };

            $this->blackIps = array_map($onlyIp, array_filter($attributes['ips'], function (array $item) {
                return (bool)$item['access'] === false;
            }));

            $this->whiteIps = array_map($onlyIp, array_filter($attributes['ips'], function (array $item) {
                return (bool)$item['access'] === true;
            }));
        }
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function isAccess(string $ip): bool
    {
        return $this->isIpAccess($ip);
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function isIpAccess(string $ip): bool
    {
        return !in_array($ip, $this->blackIps);
    }

    /**
     * @param string $json
     * @return Host
     */
    public static function createFromJson(string $json): Host
    {
        return new static(json_decode($json, true));
    }
}
