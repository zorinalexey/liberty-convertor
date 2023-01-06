<?php

declare(strict_types = 1);

namespace Liberty\Convertor;

/**
 * Класс DataSize
 * @version 0.0.1
 * @package Liberty\Convertor
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
final class DataSize
{

    /**
     * размер данных в байтах
     * @var float
     */
    public int $byte = 0;

    /**
     * размер данных в килобайтах
     * @var float
     */
    public float $kilobyte = 0;

    /**
     * размер данных в мегабайтах
     * @var float
     */
    public float $megabyte = 0;

    /**
     * размер данных в гигабайтах
     * @var float
     */
    public float $gigabyte = 0;

    /**
     * размер данных в терабайтах
     * @var float
     */
    public float $terabyte = 0;

    /**
     * размер данных в петабайтах
     * @var float
     */
    public float $petabyte = 0;

    public function __construct(int|string $size)
    {
        if (is_int($size)) {
            $this->setByte($size);
        } else {
            $this->parseString($size);
        }
    }

    private static array $convertMethods = [
        'b' => 'setByte',
        'б' => 'setByte',
        'байт' => 'setByte',
        'byte' => 'setByte',
        'kb' => 'setKByte',
        'кб' => 'setKByte',
        'килобайт' => 'setKByte',
        'kilobyte' => 'setKByte',
        'mb' => 'setMByte',
        'мб' => 'setMByte',
        'мегабайт' => 'setMByte',
        'megabyte' => 'setMByte',
        'gb' => 'setGByte',
        'гб' => 'setGByte',
        'гигабайт' => 'setGByte',
        'gigabyte' => 'setGByte',
        'tb' => 'setTByte',
        'тб' => 'setTByte',
        'терабайт' => 'setTByte',
        'terabyte' => 'setTByte',
        'pb' => 'setPByte',
        'пт' => 'setPByte',
        'петабайт' => 'setPByte',
        'petabyte' => 'setPByte',
    ];

    private function parseString($size)
    {
        $matches = [];
        preg_match('~^(?<size>[\d\.,]+)(\s+)?(?<type>\w+)~ui', $size, $matches);
        if (isset($matches['size']) && isset($matches['type'])) {
            $setMethod = strtolower($matches['type']);
            if (isset(self::$convertMethods[$setMethod])) {
                $method = self::$convertMethods[$setMethod];
                if (method_exists($this, $method)) {
                    $this->$method((float)str_replace(',', '.', $matches['size']));
                }
            }
        }
    }

    private function setByte(float $size)
    {
        $this->byte = (int)$size;
        $this->kilobyte = round(($this->byte / 1024), 2);
        $this->megabyte = round(($this->kilobyte / 1024), 2);
        $this->gigabyte = round(($this->megabyte / 1024), 2);
        $this->terabyte = round(($this->gigabyte / 1024), 2);
        $this->petabyte = round(($this->terabyte / 1024), 2);
    }

    private function setKByte(float $size): void
    {
        $this->kilobyte = $size;
        $this->megabyte = round(($this->kilobyte / 1024), 2);
        $this->gigabyte = round(($this->megabyte / 1024), 2);
        $this->terabyte = round(($this->gigabyte / 1024), 2);
        $this->petabyte = round(($this->terabyte / 1024), 2);
        $this->byte = (int)ceil(($this->kilobyte * 1024));
    }

    private function setMByte(float $size): void
    {
        $this->megabyte = $size;
        $this->gigabyte = round(($this->megabyte / 1024), 2);
        $this->terabyte = round(($this->gigabyte / 1024), 2);
        $this->petabyte = round(($this->terabyte / 1024), 2);
        $this->kilobyte = round(($this->megabyte * 1024), 2);
        $this->byte = (int)ceil(($this->kilobyte * 1024));
    }

    private function setGByte(float $size): void
    {
        $this->gigabyte = $size;
        $this->terabyte = round(($this->gigabyte / 1024), 2);
        $this->petabyte = round(($this->terabyte / 1024), 2);
        $this->megabyte = round(($this->gigabyte * 1024), 2);
        $this->kilobyte = round(($this->megabyte * 1024), 2);
        $this->byte = (int)ceil(($this->kilobyte * 1024));
    }

    private function setTByte(float $size): void
    {
        $this->terabyte = $size;
        $this->petabyte = round(($this->terabyte / 1024), 2);
        $this->gigabyte = round(($this->terabyte * 1024), 2);
        $this->megabyte = round(($this->gigabyte * 1024), 2);
        $this->kilobyte = round(($this->megabyte * 1024), 2);
        $this->byte = (int)ceil(($this->kilobyte * 1024));
    }

    private function setPByte(float $size): void
    {
        $this->petabyte = $size;
        $this->terabyte = round(($this->petabyte * 1024), 2);
        $this->gigabyte = round(($this->terabyte * 1024), 2);
        $this->megabyte = round(($this->gigabyte * 1024), 2);
        $this->kilobyte = round(($this->megabyte * 1024), 2);
        $this->byte = (int)ceil(($this->kilobyte * 1024));
    }

}
