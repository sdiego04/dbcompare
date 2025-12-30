<?php


use PHPUnit\Framework\TestCase;

class DataBaseHelperTest extends TestCase
{
    use \DBCompare\Helpers\DataBaseHelper;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testInstanceOfDataBaseHelperTrait()
    {
        $this->assertTrue(in_array(\DBCompare\Helpers\DataBaseHelper::class, class_uses($this)));
    }
    
    public function testGetFirstDataBaseDsn()
    {
        $dto = $this->getFirstDataBaseDsn();
        $this->assertInstanceOf(\DBCompare\Infrastructure\DataBase\DataBaseDto::class, $dto);
        $this->assertEquals(getenv('DB_COMPARE_DB_HOST'), $dto->host);
        $this->assertEquals(getenv('DB_COMPARE_DB_NAME'), $dto->database);
        $this->assertEquals(getenv('DB_COMPARE_DB_USER'), $dto->username);
        $this->assertEquals(getenv('DB_COMPARE_DB_PASSWORD'), $dto->password);
        $this->assertEquals('utf8', $dto->charset);
    }

    public function testGetSecondDataBaseDsn()
    {
        $dto = $this->getSecondDataBaseDsn();
        $this->assertInstanceOf(\DBCompare\Infrastructure\DataBase\DataBaseDto::class, $dto);
        $this->assertEquals(getenv('DB_COMPARE_DB_HOST_SECONDARY'), $dto->host);
        $this->assertEquals(getenv('DB_COMPARE_DB_NAME_SECONDARY'), $dto->database);
        $this->assertEquals(getenv('DB_COMPARE_DB_USER_SECONDARY'), $dto->username);
        $this->assertEquals(getenv('DB_COMPARE_DB_PASSWORD_SECONDARY'), $dto->password);
        $this->assertEquals('utf8', $dto->charset);
    }
}