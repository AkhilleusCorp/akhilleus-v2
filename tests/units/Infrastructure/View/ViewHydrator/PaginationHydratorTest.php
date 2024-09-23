<?php

namespace App\Tests\units\Infrastructure\View\ViewHydrator;

use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use PHPUnit\Framework\TestCase;

final class PaginationHydratorTest extends TestCase
{
    /**
     * @dataProvider countHigherThan0DataProvider
     */
    public function testCountHigherThan0(int $count, int $page, int $limit, int $expectedLastPage): void
    {
        $hydrator = new PaginationHydrator($count, $page, $limit);
        $pagination = $hydrator->hydrate()['pagination'];


        $this->assertEquals($count, $pagination->count);
        $this->assertEquals(PaginationViewModel::DEFAULT_FIRST_PAGE, $pagination->firstPage);
        $this->assertEquals($page, $pagination->currentPage);
        $this->assertEquals($expectedLastPage, $pagination->lastPage);
    }

    public function testCountEqual0()
    {
        $hydrator = new PaginationHydrator(0, 1, 100);
        $pagination = $hydrator->hydrate()['pagination'];

        $this->assertEquals(0, $pagination->count);
        $this->assertEquals(PaginationViewModel::DEFAULT_FIRST_PAGE, $pagination->firstPage);
        $this->assertEquals(PaginationViewModel::DEFAULT_FIRST_PAGE, $pagination->currentPage);
        $this->assertEquals(PaginationViewModel::DEFAULT_FIRST_PAGE, $pagination->lastPage);
    }

    public function countHigherThan0DataProvider(): array
    {
        return [
            [10, 1, 10, 1],
            [39, 3, 10, 4],
            [123, 2, 25, 5],
            [1465, 10, 100, 15],
        ];
    }
}