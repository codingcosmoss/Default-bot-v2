<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Status
{

    /**
     * Holati nofaol hiosblanadi
     * @var int
     */
    public static int $status_inactive = 0;

    /**
     * Holati faol
     * @var int
     */
    public static int $status_active = 1;

    /**
     * Holati kutish hiosblanadi
     * @var int
     */
    public static int $status_waiting = 2;


    /**
     * Holati o'chirilgan hiosblanadi
     * @var int
     */
    public static int $status_deleted = 3;
    public static int $woman = 4;
    public static int $male = 5;
    public static int $cash = 6;

    /**
     * @return string[]
     */
    public static function statuses()
    {
        return [
            self::$status_active => 'Faol',
            self::$status_inactive => 'Nofaol',
            self::$status_waiting => "Kutish holatida",
            self::$status_deleted => "O'chirilgan",
        ];
    }

    /**
     * @return array|\ArrayAccess|mixed|string
     */
    public function getStatusName()
    {
        return Arr::get(self::statuses(), $this->status);
    }

    /**
     * @return string
     */
    public function getStatusBadgeName()
    {
        if ($this->status == self::$status_inactive) {

            return "<span class='badge badge-danger'>{$this->getStatusName()}</span>";
        }

        if ($this->status == self::$status_waiting) {

            return "<span class='badge badge-warning'>{$this->getStatusName()}</span>";
        }

        if ($this->status == self::$status_deleted) {

            return "<span class='badge badge-secondary'>{$this->getStatusName()}</span>";
        }

        return "<span class='badge badge-success'>{$this->getStatusName()}</span>";
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->status == self::$status_active ? 'checked' : '';
    }
}
