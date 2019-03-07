<?php

namespace Test\Unit;

use Laravel\Lumen\Testing\TestCase;

class BookTest extends TestCase
{
    public function createApplication()
    {
        return require __DIR__ . '/../../bootstrap/app.php';
    }

    public function testShouldGetBooks()
    {
        $this->get('api/books');
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' =>
                [
                    "id",
                    "title",
                    "author",
                    "publication_date",
                    "created_at",
                    "updated_at"
                ]
        ]);
    }//end function

    public function testShouldFailToGetBook()
    {
        $this->get('app/book/0');
        $this->seeStatusCode(404);
    }

    public function testShouldFailToCreateBook()
    {
        $postData = [
          'failure' => "data"
        ];
        $this->post('api/book', $postData, []);
        $this->seeStatusCode(422);
        $this->seeJsonStructure([
            "title",
            "author",
            "publication_date"
        ]);
    }

}//end class

