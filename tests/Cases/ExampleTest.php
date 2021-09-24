<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

/**
 * @internal
 * @coversNothing
 */
class ExampleTest extends AbstractTestCase
{
    public function testIsDuplicateEntryForPrimaryKey()
    {
        try {
            $this->connection->insert('INSERT INTO `hyperf`.`user_ext`(`id`) VALUES(1);');
        } catch (\Throwable $exception) {
            $this->assertTrue($this->parser->isDuplicateEntryForPrimaryKey($exception));
        }
    }
}
