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
    public static int $user = 2;
    public static int $bot = 3;
    public static int $saved = 4;
    public static int $notSaved = 6;

    // types
    public static string $question = 'question'; // so'roq gap
    public static string $tree = 'tree'; // darak gap
    public static string $command = 'command'; // buyruq gap
    public static string $desire = 'desire'; // istak gap
    public static string $feelingExcited = 'feelingExcited'; //  His hayajon




    /**
     * @return string[]
     */
    public static function statuses()
    {
        return [
            self::$status_active => 'Faol',
            self::$status_inactive => 'Nofaol',
            self::$user => "Oddiy foydalanuvchi",
            self::$bot => "Bot",
            self::$saved => "Saqlangan",
            self::$notSaved => "Saqlanmagan",

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
