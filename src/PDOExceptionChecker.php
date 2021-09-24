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
namespace Fan;

use PDOException;
use Throwable;

class PDOExceptionChecker
{
    public function isDuplicateEntryForPrimaryKey(Throwable $throwable): bool
    {
        return $throwable instanceof PDOException
            && $throwable->getCode() == 23000
            && $this->match(
                "/Duplicate entry \\'\\w+\\' for key \\'[\\w\\.]*PRIMARY\\'/",
                $throwable->getMessage()
            );
    }

    private function match(string $pattern, string $message): bool
    {
        preg_match($pattern, $message, $matches);

        if (! $matches) {
            return false;
        }

        return true;
    }
}
