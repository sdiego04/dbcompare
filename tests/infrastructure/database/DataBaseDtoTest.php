<?php


class DataBaseDtoTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        echo "Setting up test DataBaseDtoTest" . PHP_EOL;
        parent::setUpBeforeClass();
    }
    
    public function testCanCreateDataBaseDto(): void
    {
        $dto = new \DBCompare\Infrastructure\DataBase\DataBaseDto(
            'localhost',
            'test_db',
            'user',
            'password',
            'utf8mb4',
            '/path/to/cert.pem'
        );

        $this->assertInstanceOf(\DBCompare\Infrastructure\DataBase\DataBaseDto::class, $dto);
        $this->assertEquals('localhost', $dto->host);
        $this->assertEquals('test_db', $dto->database);
        $this->assertEquals('user', $dto->username);
        $this->assertEquals('password', $dto->password);
        $this->assertEquals('utf8mb4', $dto->charset);
        $this->assertEquals('/path/to/cert.pem', $dto->pathSSLCertificate);
    }

    public function testConvertToArray(): void
    {
        $dto = new \DBCompare\Infrastructure\DataBase\DataBaseDto(
            'localhost',
            'test_db',
            'user',
            'password',
            'utf8mb4',
            '/path/to/cert.pem'
        );

        $array = $dto->convertToArray();

        $this->assertIsArray($array);
        $this->assertEquals([
            'host' => 'localhost',
            'database' => 'test_db',
            'username' => 'user',
            'password' => 'password',
            'charset' => 'utf8mb4',
            'pathSSLCertificate' => '/path/to/cert.pem',
        ], $array);
    }
}