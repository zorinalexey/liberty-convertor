<?php

declare(strict_types = 1);

namespace Liberty\Convertor;

/**
 * Трейт CovertorTrait
 * @version 0.0.1
 * @package Liberty\Convertor
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
trait CovertorTrait
{

    private function parseString($size)
    {
        $matches = [];
        preg_match('~^(?<size>[\d\.,]+)(\s+)?(?<type>\w+)~ui', $size, $matches);
        if (isset($matches['size']) && isset($matches['type'])) {
            $method = (string)$this->getMethod($matches['type']);
            if (method_exists($this, $method)) {
                $this->$method((float)str_replace([',', ' '], ['.', ''], $matches['size']));
            }
        }
    }

    private function getMethod(string $type): string|false
    {
        $setMethod = strtolower($type);
        if (isset(self::$convertMethods[$setMethod])) {
            $method = self::$convertMethods[$setMethod];
            return $method;
        }
        return false;
    }

}
