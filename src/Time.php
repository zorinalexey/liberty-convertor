<?php

declare(strict_types = 1);

namespace Liberty\Convertor;

use Liberty\Convertor\CovertorTrait;

/**
 * Класс Time
 * @version 0.0.1
 * @package Liberty\Convertor
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
final class Time
{

    use CovertorTrait;

    /**
     * Количество веков
     * @var float
     */
    public float $century = 0;

    /**
     * Количество лет
     * @var float
     */
    public float $year = 0;

    /**
     * Количество месяцев
     * @var float
     */
    public float $month = 0;

    /**
     * Количество недель
     * @var float
     */
    public float $week = 0;

    /**
     * Количество дней
     * @var float
     */
    public float $day = 0;

    /**
     * Количество часов
     * @var float
     */
    public float $hour = 0;

    /**
     * Количество минут
     * @var float
     */
    public float $minute = 0;

    /**
     * Количество секунд
     * @var float
     */
    public float $second = 0;

    /**
     * Количество миллисекунд
     * @var int
     */
    public int $millisecond = 0;
    private static $convertMethods = [
        'ms' => 'setMillisecond',
        'мил.сек' => 'setMillisecond',
        'миллисекунда' => 'setMillisecond',
        'миллисекунд' => 'setMillisecond',
        'millisecond' => 'setMillisecond',
        'milliseconds' => 'setMillisecond',
        'сек' => 'setSecond',
        'секунд' => 'setSecond',
        'секунды' => 'setSecond',
        'секунда' => 'setSecond',
        'сек.' => 'setSecond',
        'second' => 'setSecond',
        'seconds' => 'setSecond',
        's' => 'setSecond',
        'мин' => 'setMinute',
        'мин.' => 'setMinute',
        'минута' => 'setMinute',
        'минут' => 'setMinute',
        'минуты' => 'setMinute',
        'i' => 'setMinute',
        'minute' => 'setMinute',
        'minutes' => 'setMinute',
        'hour' => 'setHour',
        'h' => 'setHour',
        'ч' => 'setHour',
        'ч.' => 'setHour',
        'час' => 'setHour',
        'часов' => 'setHour',
        'day' => 'setDay',
        'days' => 'setDay',
        'd' => 'setDay',
        'д' => 'setDay',
        'д.' => 'setDay',
        'день' => 'setDay',
        'дня' => 'setDay',
        'дней' => 'setDay',
        'week' => 'setWeek',
        'w' => 'setWeek',
        'weeks' => 'setWeek',
        'н' => 'setWeek',
        'н.' => 'setWeek',
        'недель' => 'setWeek',
        'неделя' => 'setWeek',
        'month' => 'setMonth',
        'months' => 'setMonth',
        'm' => 'setMonth',
        'месяц' => 'setMonth',
        'месяцев' => 'setMonth',
        'м' => 'setMonth',
        'м.' => 'setMonth',
        'year' => 'setYear',
        'years' => 'setYear',
        'y' => 'setYear',
        'год' => 'setYear',
        'лет' => 'setYear',
        'г' => 'setYear',
        'century' => 'setCentury',
        'c' => 'setCentury',
        'centuryes' => 'setCentury',
        'век' => 'setCentury',
        'веков' => 'setCentury',
        'в' => 'setCentury'
    ];

    public function __construct(int|string $size)
    {
        if (is_int($size)) {
            $this->setSecond($size);
        } else {
            $this->parseString($size);
        }
    }

    private function setCentury(float $size): void
    {
        $this->century = $size;
        $this->setYear((float)($this->century * 100));
    }

    private function setYear(float $size): void
    {
        $this->year = $size;
        $this->setMonth((float)($this->year * 12));
    }

    private function setMonth(float $size): void
    {
        $this->month = $size;
        $this->setDay((float)($this->month * (365 / 12)));
    }

    private function setWeek(float $size): void
    {
        $this->week = $size;
        $this->setDay((float)($this->week * 7));
    }

    private function setDay(float $size): void
    {
        $this->day = $size;
        $this->setHour((float)($this->day * 24));
    }

    protected function setHour(float $size): void
    {
        $this->hour = $size;
        $this->setMinute((float)($this->hour * 60));
    }

    private function setMinute(float $size): void
    {
        $this->minute = $size;
        $this->setSecond((int)($this->minute * 60));
    }

    private function setSecond(float $size): void
    {
        $this->second = (int)$size;
        $this->setMillisecond((int)($this->second * 1000));
        $this->minute = round(($this->second / 60), 1);
        $this->hour = round(($this->second / 60 / 60), 2);
        $this->day = round(($this->second / 60 / 60 / 24), 1);
        $this->week = round(($this->day / 7), 2);
        $this->month = round(($this->day * (12 / 365)), 2);
        $this->year = round(($this->day / 365), 6);
        $this->century = round(($this->day / (365 * 100)), 7);
    }

    private function setMillisecond(int $size): void
    {
        $this->millisecond = $size;
    }

}
