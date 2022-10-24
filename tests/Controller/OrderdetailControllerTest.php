<?php

namespace App\Test\Controller;

use App\Entity\Orderdetail;
use App\Repository\OrderdetailRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderdetailControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private OrderdetailRepository $repository;
    private string $path = '/orderdetail/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Orderdetail::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Orderdetail index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'orderdetail[orderid]' => 'Testing',
            'orderdetail[bookid]' => 'Testing',
        ]);

        self::assertResponseRedirects('/orderdetail/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Orderdetail();
        $fixture->setOrderid('My Title');
        $fixture->setBookid('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Orderdetail');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Orderdetail();
        $fixture->setOrderid('My Title');
        $fixture->setBookid('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'orderdetail[orderid]' => 'Something New',
            'orderdetail[bookid]' => 'Something New',
        ]);

        self::assertResponseRedirects('/orderdetail/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getOrderid());
        self::assertSame('Something New', $fixture[0]->getBookid());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Orderdetail();
        $fixture->setOrderid('My Title');
        $fixture->setBookid('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/orderdetail/');
    }
}
