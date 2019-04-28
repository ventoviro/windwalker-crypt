<?php declare(strict_types=1);
/**
 * Part of Windwalker project Test files.  @codingStandardsIgnoreStart
 *
 * @copyright  Copyright (C) 2019 LYRASOFT Taiwan, Inc.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Crypt\Test\Cipher;

use PHPUnit\Framework\TestCase;
use Windwalker\Crypt\Cipher\SodiumCipher;

/**
 * Test class of Cipher3DES
 *
 * @since 2.0
 */
class SodiumCipherTest extends TestCase
{
    /**
     * Test instance.
     *
     * @var SodiumCipher
     */
    protected $instance;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        if (!function_exists('sodium_crypto_secretbox_open')) {
            $this->markTestSkipped('libsodium extension or compat not available.');
        }

        $this->instance = new SodiumCipher();

        if (!$this->instance->canMemzero()) {
            $this->instance->ignoreMemzero(true);
        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown(): void
    {
    }

    /**
     * Method to test encrypt().
     *
     * @return void
     *
     * @covers \Windwalker\Crypt\Cipher\AbstractCipher::encrypt
     */
    public function testEncrypt()
    {
        $data = $this->instance->encrypt('windwalker');

        $data = $this->instance->decrypt($data);

        $this->assertEquals('windwalker', $data);
    }
}
