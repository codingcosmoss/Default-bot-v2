<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ServiceAnketa extends Model
{
    use HasFactory;

    /**
     * 1 Глуб.кариес+леч.прокл.+СИЦ 100%
     * @var int
     */
    public static int $anketa_1 = 1;

    /**
     * 2. Депульп-е под ортопедию 100%
     * @var int
     */
    public static int $anketa_2 = 2;

    /**
     * 3. Детский пульпит 100%
     * @var int
     */
    public static int $anketa_3 = 3;

    /**
     * 4.Кариес дентина+СИЦ 100%
     * @var int
     */
    public static int $anketa_4 = 4;

    /**
     * 5. Кариес дентина 100%
     * @var int
     */
    public static int $anketa_5 = 5;

    /**
     * 6.Кариес цемента+СИЦ 100%
     * @var int
     */
    public static int $anketa_6 = 6;

    /**
     * 7.Кариес цемента 100%
     * @var int
     */
    public static int $anketa_7 = 7;

    /**
     * 8.Кариес эмали. 100 %
     * @var int
     */
    public static int $anketa_8 = 8;

    /**
     * 9.Консультаия 100%
     * @var int
     */
    public static int $anketa_9 = 9;

    /**
     * 10.МЗП 100%
     * @var int
     */
    public static int $anketa_10 = 10;

    /**
     * 11.МК 100%
     * @var int
     */
    public static int $anketa_11 = 11;

    /**
     * 12.мост МЗП 100 %
     * @var int
     */
    public static int $anketa_12 = 12;

    /**
     * 13. мост МК без депульпации 100%
     * @var int
     */
    public static int $anketa_13 = 13;

    /**
     * 14 мост МК депульпация 100%
     * @var int
     */
    public static int $anketa_14 = 14;

    /**
     * 15.Периодонтит нелеч.100%
     * @var int
     */
    public static int $anketa_15 = 15;

    /**
     * 16.Периодонтит реэндо 100%
     * @var int
     */
    public static int $anketa_16 = 16;

    /**
     * 17.протез в верхней челюсти 100 %
     * @var int
     */
    public static int $anketa_17 = 17;

    /**
     * 18.Пульпит_однокорн_и_многокорн_100_%
     * @var int
     */
    public static int $anketa_18 = 18;

    /**
     * 19.Цирконий 100%
     * @var int
     */
    public static int $anketa_19 = 19;

    /**
     * 20.Чистка(Острый гингивит) 100%
     * @var int
     */
    public static int $anketa_20 = 20;

    /**
     * 21.Чистка(хронический гингивит) 100%
     * @var int
     */
    public static int $anketa_21 = 21;

    /**
     * @return string[]
     */
    public static function getAnkets()
    {
        return [
            self::$anketa_1 => '1.Глуб.кариес+леч.прокл.+СИЦ 100%',
            self::$anketa_2 => '2.Депульп-е под ортопедию 100%',
            self::$anketa_3 => '3.Детский пульпит 100%',
            self::$anketa_4 => '4.Кариес дентина+СИЦ 100%',
            self::$anketa_5 => '5.Кариес дентина 100%',
            self::$anketa_6 => '6.Кариес цемента+СИЦ 100%',
            self::$anketa_7 => '7.Кариес цемента 100%',
            self::$anketa_8 => '8.Кариес эмали. 100 %',
            self::$anketa_9 => '9.Консультаия 100%',
            self::$anketa_10 => '10.МЗП 100%',
            self::$anketa_11 => '11.МК 100%',
            self::$anketa_12 => '12.мост МЗП 100 %',
            self::$anketa_13 => '13.мост МК без депульпации 100%',
            self::$anketa_14 => '14.мост МК депульпация 100%',
            self::$anketa_15 => '15.Периодонтит нелеч.100%',
            self::$anketa_16 => '16.Периодонтит реэндо 100%',
            self::$anketa_17 => '17.протез в верхней челюсти 100 %',
            self::$anketa_18 => '18.Пульпит_однокорн_и_многокорн_100_%',
            self::$anketa_19 => '19.Цирконий 100%',
            self::$anketa_20 => '20.Чистка(Острый гингивит) 100%',
            self::$anketa_21 => '21.Чистка(хронический гингивит) 100%',
        ];
    }

    /**
     * @return mixed
     */
    public function getAnketaName()
    {
        return Arr::get(self::getAnkets(), $this->anketa_number);
    }
}
