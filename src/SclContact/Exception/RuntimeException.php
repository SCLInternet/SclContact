<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContact\Exception;

/**
 * RuntimeException
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class RuntimeException extends \RuntimeException implements
    ExceptionInterface
{
    /**
     * @param  string $file
     * @param  string $method
     * @param  int    $line
     * @return RuntimeException
     */
    public static function fileDoesNotExist($file, $method, $line)
    {
        return new self(
            sprintf(
                'File "%s" does not exists in %s (%d).',
                $file,
                $method,
                $line
            )
        );
    }

    /**
     * @param  mixed  $variable
     * @param  string $method
     * @param  int    $line
     * @return RuntimeException
     */
    public static function countriesExpectedArray($variable, $method, $line)
    {
        return new self(
            sprintf(
                '$countries is expected to be an array; got "%s" in %s (%d).',
                is_object($variable) ? get_class($variable) : gettype($variable),
                $method,
                $line
            )
        );
    }

    /**
     * @param  mixed  $variable
     * @param  string $method
     * @param  int    $line
     * @return RuntimeException
     */
    public static function invalidType($expected, $variable, $method, $line)
    {
        return new self(
            sprintf(
                'Expected "%s"; got "%s" in %s (%d).',
                $expected,
                is_object($variable) ? get_class($variable) : gettype($variable),
                $method,
                $line
            )
        );
    }

    /**
     * @param  string $method
     * @param  int    $line
     * @return RuntimeException
     */
    public static function countryManagerNotSet($method, $line)
    {
        return new self(
            sprintf(
                'Country manager was not set in %s (%d).',
                $method,
                $line
            )
        );
    }
}
