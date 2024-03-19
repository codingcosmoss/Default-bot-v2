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

    // Treatments
    public static int $new = 7;
    public static int $doctorFinished = 8;
    public static int $finished = 9;
    public static int $unpaid = 10;
    public static int $notFullyPaid = 11;
    public static int $Closed = 12;
    public static int $saved = 13;
    public static int $notSaved = 14;
    public static int $clinic = 15; // klinika
    public static int $doctor = 16; // doctor

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
            self::$new => "Yangi",
            self::$doctorFinished => "Shifokor tomonidan tugatildi",
            self::$finished => "Tugatilgan",
            self::$unpaid => "To'lanmagan",
            self::$notFullyPaid => "To'liq to'lanmagan",
            self::$Closed => "Yopilgan",
            self::$male => "Erkak",
            self::$woman => "Ayol",
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
