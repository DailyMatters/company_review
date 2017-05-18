<?php

use PHPUnit\Framework\TestCase;
use CompanyReview\CompanyReview;

class CompanyReviewTest extends TestCase {

	private $review;

	protected function setUp(){
		$this->review = new CompanyReview();
	}

	public function testGetFileThrowsException(){
		$this->expectException(\Exception::class);
		$file = "db.json";
		$this->review->getData($file);
	}

	public function testDBFileExists(){
		$path="./db/data.json";
		$this->assertFileExists($path);
	}

}
