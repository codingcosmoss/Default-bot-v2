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
    public static int $main_panel = 2;
    public static int $admin_panel = 3;
    public static int $change_role = 4;
    public static int $saved = 5;
    public static int $notSaved = 6;
    public static int $import = 7;
    public static int $returned = 8;
    public static int $default = 9;
    public static int $selling = 10;
    public static int $invoiceReturned = 11;


    /**
     * @return string[]
     */
    public static function statuses()
    {
        return [
            self::$status_active => 'Faol',
            self::$status_inactive => 'Nofaol',
            self::$main_panel => "Main main panel",
            self::$admin_panel => "Admin panel",
            self::$change_role => "Change role",
            self::$saved => "Saqlangan",
            self::$notSaved => "Saqlanmagan",
            self::$import => "Olib kelingan",
            self::$admin => "Admin",
            self::$user => "User",
            self::$returned => "Qaytarilgan dori",
            self::$default => "Default standart",
            self::$selling => "Sotildi",

        ];
    }

    /**
     * @return array|\ArrayAccess|mixed|string
     */
    public static function getStatusName($status)
    {
        return Arr::get(self::statuses(), $status);
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
