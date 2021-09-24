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

use Fan\PDOExceptionChecker;
use Hyperf\Database\ConnectionInterface;
use Hyperf\Database\Connectors\ConnectionFactory;
use Hyperf\Database\Connectors\MySqlConnector;
use Hyperf\Utils\Reflection\ClassInvoker;
use PDO;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * Class AbstractTestCase.
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * @var PDOExceptionChecker
     */
    protected $checker;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $connector = new MySqlConnector();
        $this->pdo = $connector->connect($config = [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'hyperf',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $factory = new ClassInvoker(new ConnectionFactory(\Mockery::mock(ContainerInterface::class)));
        $this->connection = $factory->createConnection('mysql', $this->pdo, 'hyperf', '', $config);
        $this->checker = new PDOExceptionChecker();
    }
}
