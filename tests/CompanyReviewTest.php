<?php

use PHPUnit\Framework\TestCase;
use CompanyReview\CompanyReview;

class CompanyReviewTest extends TestCase {

	private $review;

	protected function setUp(){
		$this->review = new CompanyReview();
	}

	public function testGetFileThrowsException(){
		$file = "db.json";
		$this->expectException(FileNotFoundException::class);
		$this->review->getData($file);
	}

}
