<?php
namespace Tests\Http\Controllers;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Person;

function add($a, $b) {
    return $a + $b;
}

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider provideAdditionTestParams
     */
    public function testAdd($expected, $a, $b)
{
    $this->assertEquals($expected, add($a, $b));
}

  //...
    public function provideAdditionTestParams() {
        return [
            [5, 2, 3],
            [0, -1, 1],
            [-5, -2, -3],
        ];
    }
}
